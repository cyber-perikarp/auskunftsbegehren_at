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
        $model = new Auskunft();
        $idTypes = IdTypes::find()->all();
        $adressdaten = Adressdaten::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
	            // Weil Relationen hier unnötig viel Aufwand wären speichern wir alle Ziele als Json
	            $model->targets = json_encode($model->targets);

	            if ($model->save()) {
		            return $this->redirect('auskunft/success');
	            }
            }
        }

        return $this->render('daten', [
            'model' => $model,
            'idTypes' => $idTypes,
            'adressdaten' => $adressdaten
        ]);
    }

	public function actionSucess()
	{
		return $this->render('suceess');
	}

	public function actionDownload()
	{
		return $this->render('download');
	}

}
