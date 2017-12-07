<?php
namespace app\commands;
use yii\console\Controller;
use app\models\Auskunft;
use app\models\Reminders;
use app\models\Adressdaten;
use Ramsey\Uuid\Uuid;

class GeneratePdfController extends Controller
{
    private $allDatasets;
    public function __construct($id, $module, $config = array()) {
        $this->allDatasets = Auskunft::find()->all();

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        foreach ($this->allDatasets as $dataSet) {
        	$targets = json_decode($dataSet["targets"]);

            var_dump($dataSet["email"]);
            foreach ($targets as $target) {
            	var_dump(Adressdaten::find($target));
            }
        }
    }

    private function generateSaltedUUID() {
		return hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
	}

	private function reminder($email, $targets) {

	}
}
