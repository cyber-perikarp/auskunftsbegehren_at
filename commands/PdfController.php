<?php
namespace app\commands;
use yii\console\Controller;
use app\models\Auskunft;
use app\models\Reminders;
use app\models\Adressdaten;
use app\models\Statistik;
use Ramsey\Uuid\Uuid;
use AdamBrett\ShellWrapper\Command;
use AdamBrett\ShellWrapper\Command\Param;
use AdamBrett\ShellWrapper\Runners\Exec;

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
			$targetFolder = $this->createFolder();

            foreach ($targets as $target) {
            	$this->saveStats($target);
				$this->generatePdf(Adressdaten::findOne(["id" => $target]), $dataSet, $targetFolder);
            }


            if($dataSet["reminder"]) {
            	$this->addReminder($dataSet["email"], $dataSet["targets"]);
            }
        }
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
		$reminder->save();
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

	private function createFolder() {
		$targetFolder = \Yii::$app->params["outputBaseDir"] . "/" . $this->generateHash();
		mkdir($targetFolder);
		copy(\Yii::$app->params["baseDir"] . "/templates/brief/base.tex", $targetFolder . "/base.tex");

		return $targetFolder;
	}

	private function generateHash () {
		return hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
	}

	private function generatePdf ($target, $dataSet, $targetFolder) {
    	$templateFile = $targetFolder . "/template.lco";

		copy(\Yii::$app->params["baseDir"] . "/templates/brief/template.lco", $templateFile);
		$template = file_get_contents($templateFile);

		// Alle Nutzerdaten ersetzen
		$template = str_replace("@@vorname@@", $dataSet["firstName"], $template);
		$template = str_replace("@@nachname@@", $dataSet["lastName"], $template);
		$template = str_replace("@@strasse@@", $dataSet["street"], $template);
		$template = str_replace("@@hausnummer@@", $dataSet["streetNumber"], $template);
		$template = str_replace("@@plz@@", $dataSet["zip"], $template);
		$template = str_replace("@@ort@@", $dataSet["city"], $template);

		// Daten des Zieles
		$template = str_replace("@@zielname@@", $target["name"], $template);
		$template = str_replace("@@zieladresse@@", $target["adresse"], $template);
		$template = str_replace("@@zielplz@@", $target["plz"], $template);
		$template = str_replace("@@zielort@@", $target["stadt"], $template);

		unlink($templateFile);
		file_put_contents($templateFile, $template);

		$shell = new Exec();
		$command = new Command('pdflatex');
		$command->addParam(new Param("-output-directory " . $targetFolder));
		$command->addParam(new Param("-interaction batchmode"));
		$command->addParam(new Param($targetFolder . "/base.tex"));

		var_dump($shell->run($command));
		die();

	}
}
