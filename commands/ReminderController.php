<?php
namespace app\commands;
use yii\console\Controller;
use app\models\Reminders;
use app\models\Adressdaten;

class ReminderController extends Controller
{
	private $now;

	public function __construct(string $id, $module, array $config = []) {
		$this->now = new \DateTime();
		parent::__construct($id, $module, $config);
	}

	public function actionIndex () {
		$dueTodayAll = Reminders::findAll(["due_at" => $this->now->format("Y-m-d")]);

		foreach ($dueTodayAll as $dueToday) {
			$targets = json_decode($dueToday["targets"]);
			$this->sendReminder($dueToday["created_at"], $targets, $dueToday["email"]);

			// Wenn wir nicht im dev modus sind lösche den Datensatz
			if (!\Yii::$app->params["cli_dev"]) {
				try {
					$targets->delete();
				} catch (\Exception $e) {
					\Yii::error("Could not delete entry: " . $e);
				}
			}
		}
	}

	private function sendReminder ($datum, $targets, $email) {
		$targetNames = array();
		foreach ($targets as $target) {
			$targetNames[] = Adressdaten::findOne(["id" => $target])["name"];
		}

		$template = file_get_contents(\Yii::$app->params["baseDir"] . "/templates/email/reminder.txt");
		$template = str_replace("@@datum@@", $datum, $template);
		$template = str_replace("@@ziele@@", '* ' . implode("\n* ", $targetNames), $template);

		\Yii::debug("Mail to: " . $email);
		\Yii::debug("Targets: " . implode(", ", $targetNames));

		$mailStatus = \Yii::$app->mailer->compose()
			->setFrom(\Yii::$app->params["email_from"])
			->setTo($email)
			->setSubject("Die Frist deiner Datenauskunftsbegehren ist heute abgelaufen")
			->setTextBody($template)
			->send();

		\Yii::debug("Email status: " . $mailStatus);
	}
}