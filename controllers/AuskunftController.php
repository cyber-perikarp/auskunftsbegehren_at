<?php

namespace app\controllers;
use app\models\Auskunft;
use app\models\Adressdaten;

class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTargets() {
        $adressdaten = new Adressdaten;
        return $this->render('targets');
    }
}
