<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Generated;

class CleanupController extends Controller {
	private $now;

	public function __construct(string $id, $module, array $config = []) {
		$this->now = new \DateTime();
		parent::__construct($id, $module, $config);
	}

	public function actionIndex() {
		$this->delete(
			Generated::findAll(
				[
					"linkopened" => true
				]
			)
		);

		$this->delete(
			Generated::find()->where(
				[
					'<',
					'todelete_at',
					$this->now->format("Y-m-d H:i:s")
				]
			)->all()
		);
	}

	private function delete($allToDelete) {
		foreach ($allToDelete as $entry) {
			if (!\Yii::$app->params["cli_dev"]) {
				try {
					$entry->delete();
					$this->deleteFolder($entry["id"]);
				} catch (\Exception $e) {
					\Yii::error("Could not delete entry: " . $e);
				}
			} else {
				\Yii::info("Would delete entry: " . $entry["id"]);
			}
		}
	}

	private function deleteFolder($id) {
		// We better not delete every file on the system
		
		if (\Yii::$app->params["outputBaseDir"] != "" && $id != "") {
			$path = \Yii::$app->params["outputBaseDir"] . "/" . $id;
			try {
				array_map('unlink', glob($path . "/*"));
				rmdir($path);
			} catch (\Exception $e) {
				\Yii::error("Could not delete folder: " . $e);
			}
		} else {
			\Yii::error("Something very bad happened while deleting a file!");
			return false;
		}
	}
}