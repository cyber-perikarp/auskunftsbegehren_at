<?php
namespace app\commands;
use yii\console\Controller;
use app\models\Auskunft;

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
            var_dump($dataSet["email"]);
        }
    }
}
