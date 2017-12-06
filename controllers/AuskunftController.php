<?php

namespace app\controllers;
use Yii;
use app\models\Auskunft;
use app\models\Adressdaten;
use app\models\IdTypes;
use app\models\Reminders;
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
                $this->saveAuskunft($model);
                return $this->redirect('');
            }
        }

        return $this->render('daten', [
            'model' => $model,
            'idTypes' => $idTypes,
            'adressdaten' => $adressdaten
        ]);
    }
    
    private function saveAuskunft($model) {
        // Wir generieren aus unserem Salt und einer zufälligen UID je einen Hash für die DownloadID und das Download Passwort
        $model->downloadId = hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
        $model->downloadPassword = hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
        // Weil Relationen da unnötig viel Aufwand wären speichern wir alle Ziele als Json
        $model->targets = json_encode($model->targets);
        
        if ($model->save()) {
            return true;
        }
        return false;
    }
}
