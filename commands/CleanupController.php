<?php
namespace app\commands;
use yii\console\Controller;
use app\models\Generated;

class CleanupController extends Controller
{
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
			try {
				$entry->delete();
			} catch (\Exception $e) {
				\Yii::error("Could not delete entry: " . $e);
			}
		}
	}
}