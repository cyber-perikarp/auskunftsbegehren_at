<?php

namespace app\controllers;
use Yii;
use app\models\Auskunft;
use app\models\Adressdaten;
use app\models\IdTypes;
use yii\helpers\ArrayHelper;


class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Auskunft();
        $idTypes = IdTypes::find()->all();

        $branchen = Adressdaten::find()->select(["branche"])->groupBy("branche")->asArray()->all();
        $ziele = Adressdaten::find()->select(["id", "typ", "branche", "name", "stadt"])->orderBy("branche")->addOrderBy("typ")->addOrderBy("name")->asArray()->all();

//        $adressdaten = Adressdaten::find()->all();

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
            'branchen' => $branchen,
            'ziele' => $ziele
        ]);
    }

	public function actionSucess()
	{
		return $this->render('sucess');
	}

	public function actionDownload($id)
	{
		$path = $this->buildPath($id);

		if (!file_exists($path)) {
			throw new \yii\web\NotFoundHttpException("Link abgelaufen.");
		}

		return $this->render('download', [
			'id' => $id,
			'path' => $path
		]);
	}

	public function actionDownloadstart($id) {
		$path = $this->buildPath($id);
		Yii::$app->response->sendFile($path, "auskunftsbegehren.zip", array("mimeType" => "application/zip", "inline" => false));
	}

	private function buildPath ($id) {
    	return \Yii::$app->params["outputBaseDir"] . "/" . $id . "/download.zip";
	}
}
