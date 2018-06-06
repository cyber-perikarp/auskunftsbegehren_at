<?php

namespace app\controllers;
use Yii;
use app\models\Auskunft;
use app\models\Adressdaten;
use app\models\AdressdatenSuggest;
use app\models\IdTypes;
use app\models\Generated;

class AuskunftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Auskunft();
        $idTypes = IdTypes::find()->all();

        $branchen = Adressdaten::find()->select(["branche"])->groupBy("branche")->asArray()->all();
        $ziele = Adressdaten::find()->select(["id", "typ", "branche", "name", "stadt", "bundesland", "email", "fax"])->orderBy("branche")->addOrderBy("typ")->addOrderBy("name")->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
				// Weil Relationen hier unnötig viel Aufwand wären speichern wir alle Ziele als Json
				$model->targets = json_encode($model->targets);

	            if ($model->save()) {
					return $this->render('success');
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
	
	public function actionSuggest()
	{
		$model = new AdressdatenSuggest();

		$branchen = Adressdaten::find()->select(["branche"])->groupBy("branche")->asArray()->all();
		$typen = Adressdaten::find()->select(["typ"])->groupBy("typ")->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
			$model['id'] = "xxxINSERTEDxxx";
            if ($model->validate()) {
	            if ($model->save()) {
					return $this->render('suggestSuccess');
	            }
            }
        }

        return $this->render('suggest', [
            'model' => $model,
			'branchen' => $this->buildDict($branchen, 'branche'),
			'typen' => $this->buildDict($typen, 'typ')
        ]);
	}

	public function actionDownload($id)
	{
		$path = $this->buildPath($id);

		if (!file_exists($path)) {
			throw new \yii\web\NotFoundHttpException("Link abgelaufen.");
		}

		$generated = Generated::findOne(["id" => $id]);
		$generated->linkopened = true;
		$generated->save();

		return $this->render('download', [
			'id' => $id
		]);
	}

	public function actionDownloadstart($id) {
		$path = $this->buildPath($id);
		if (file_exists($path)) {
			Yii::$app->response->sendFile($path, "auskunftsbegehren.zip", array("mimeType" => "application/zip", "inline" => false));
		}
	}

	private function buildPath ($id) {
    	return \Yii::$app->params["outputBaseDir"] . "/" . $id . "/download.zip";
	}

	private function buildDict ($arr, $val) {
		$ret = [];
    	foreach ($arr as $key => $value) {
			$ret[] = ['id' => $value[$val], 'name' => $value[$val]];
		}
		return $ret;
	}
}
