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
        $adressModel = new Adressdaten;
        $allEntries = $adressModel::findAll(10);
        return $this->render('targets', array(
            "adressdaten" => $allEntries
        ));
    }
}
