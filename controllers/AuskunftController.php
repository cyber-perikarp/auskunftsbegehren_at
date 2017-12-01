<?php

use Yii;
namespace app\controllers;
use \app\Models\Auskunft;
use \app\Models\Adressdaten;

class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTargets() {
        $model = new Adressdaten;
        return $this->render('targets');
    }
}
