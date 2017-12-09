<?php
namespace app\commands;
use Faker\Provider\DateTime;
use yii\console\Controller;
use app\models\Auskunft;
use app\models\Reminders;
use app\models\Adressdaten;
use app\models\Statistik;
use Ramsey\Uuid\Uuid;
use tFPDF;

class PdfController extends Controller
{
    private $allDatasets;
    private $statistik;

    public function __construct($id, $module, $config = array()) {
        $this->allDatasets = Auskunft::find()->all();


        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        foreach ($this->allDatasets as $dataSet) {
        	$targets = json_decode($dataSet["targets"]);

            foreach ($targets as $target) {
            	$this->saveStats($target);
            }

            if($dataSet["reminder"]) {
            	$this->addReminder($dataSet["email"], $dataSet["targets"]);
            }
        }
    }

    private function generateSaltedUUID() {
		return hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
	}

	private function addReminder($email, $targets) {
    	$now = new \DateTime();
    	$reminder = new Reminders();

    	$reminder->created_at = $now->format("Y-m-d");
    	$reminder->due_at = $now->add(
		    \DateInterval::createFromDateString(\Yii::$app->params["frist"] . " weeks")
	    )->format("Y-m-d"); // Wochen dazu laut config

		$reminder->email = $email;
		$reminder->targets = $targets;
	}

	private function saveStats($target) {
		$this->statistik = new Statistik();
		$targetEntry = Statistik::findOne(["identifier" => $target]);
		if (!$targetEntry) {
			$this->statistik->identifier = $target;
			$this->statistik->counter = 1;
			$this->statistik->save();
		} else {
			$targetEntry->counter++;
			$targetEntry->save();
		}
	}

	private function generatePdf () {
		$pdf = new tFPDF\PDF();
		$pdf->AddPage();
		$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
		$pdf->SetFont('DejaVu','',14);
	}

	private function parseTemplate() {

	}
}
