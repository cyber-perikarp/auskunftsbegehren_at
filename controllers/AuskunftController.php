<?php

namespace app\controllers;
use Yii;
use app\models\Auskunft;
use app\models\Adressdaten;
use app\models\IdTypes;
class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDaten()
    {
        $model = new Auskunft();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('daten', [
            'model' => $model,
        ]);
    }
}
