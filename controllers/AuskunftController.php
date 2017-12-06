<?php

namespace app\controllers;
use Yii;
use app\models\Auskunft;
use app\models\Adressdaten;
use app\models\IdTypes;
use Ramsey\Uuid\Uuid;
class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDaten()
    {
        $model = new Auskunft();
        $idTypes = IdTypes::find()->all();
        $adressdaten = Adressdaten::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->downloadId = hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
                $model->downloadPassword = hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
                $model->targets = json_encode($model->targets);
                $model->save();
                return $this->redirect('');
            }
        }

        return $this->render('daten', [
            'model' => $model,
            'idTypes' => $idTypes,
            'adressdaten' => $adressdaten
        ]);
    }
}
