<?php
namespace app\commands;
use app\models\IdTypes;
use yii\console\Controller;
use app\models\Auskunft;
use app\models\Reminders;
use app\models\Adressdaten;
use app\models\Statistik;
use Ramsey\Uuid\Uuid;

class GenerationController extends Controller
{
    private $error; // Die Variable wird true wenn pro Nutzer ein kritischer Fehler auftritt aka ein pdf konnte nicht generiert werden oder das zippen hat nicht funktioniert

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
	    $allDatasets = Auskunft::find()->all();

        foreach ($allDatasets as $dataSet) {
        	\Yii::trace("Processing entry for " . $dataSet["email"]);
        	$this->error = false;

        	$targets = json_decode($dataSet["targets"]);

        	$targetFolderHash = $this->generateHash();
			$targetFolder = \Yii::$app->params["outputBaseDir"] . "/" . $targetFolderHash;

			if (!$this->createFolder($targetFolder)) {
				\Yii::error("Oh noes! Folder Creation failed");
				$this->error = true;
				continue;
			}

			$dataSet["idType"] = IdTypes::findOne(["id" => $dataSet["idType"]])["nameForText"];

			foreach ($targets as $target) {
				\Yii::info("Target: " . $target);
				$this->saveStats($target);
				if (!$this->generatePdf(Adressdaten::findOne(["id" => $target]), $dataSet, $targetFolder)) {
					\Yii::error("Oh noes! PDF Creation failed");
					$this->error = true;
				}
			}

			// Die Logdateien sollen nur gelöscht und die Erinnerungen nur gespeichert werden wenn die pdf generierung erfolgreich war.
			if (!$this->error) {
				\Yii::trace("Deleting log files from generation");
				$this->deleteTempFiles($targetFolder);
			}

	        // Wenn das zip nicht erstellt werden konnte ist das ein fehler
	        if (!$this->generateZipFile($targetFolder)) {
		        \Yii::error("Oh noes! ZIP Creation failed");
		        $this->error = true;
		        continue;
	        }

			// Wenn bis jetzt alles gut war können wir die Erinnerung speichern und die Email verschicken :)
			if($dataSet["reminder"]) {
				$this->addReminder($dataSet["email"], $dataSet["targets"]);
			}

			$this->sendDownloadEmail($targetFolderHash, $dataSet["email"]);

//			try {
//				$dataSet->delete();
//			} catch (\Exception $e) {
//				\Yii::error("Could not delete entry: " . $e);
//			}
        }
    }

	private function addReminder($email, $targets) {
		\Yii::info("Adding Reminder");
    	$now = new \DateTime();
    	$reminder = new Reminders();

    	$reminder->created_at = $now->format("Y-m-d");
    	$reminder->due_at = $now->add(
		    \DateInterval::createFromDateString(\Yii::$app->params["frist"] . " weeks")
	    )->format("Y-m-d"); // Wochen dazu laut config

		$reminder->email = $email;
		$reminder->targets = $targets;
		$reminder->save();
	}

	private function saveStats($target) {
		\Yii::info("Saving Statistik");
		$statistik = new Statistik();
		$targetEntry = Statistik::findOne(["identifier" => $target]);
		if (!$targetEntry) {
			$statistik->identifier = $target;
			$statistik->counter = 1;
			$statistik->save();
		} else {
			$targetEntry->counter++;
			$targetEntry->save();
		}
	}

	private function deleteTempFiles ($targetFolder) {
		// Alle von Latex generierten Daten löschen außer die PDFs. Mehrere foreach because fuck it
		$extensionsToDelete = array("aux", "log", "lco", "tex");

		// Weil wir nur bestimmte Endungen und das nicht rekursiv löschen ist die Gefahr gering, aber lieber zu viel Vorsicht
		if ($targetFolder) {
			foreach ($extensionsToDelete as $extension) {
				foreach( glob($targetFolder . "/*." . $extension) as $file ) {
					\Yii::trace("Deleting file: " . $file);
					unlink($file);
				}
			}
		}

	}

	private function createFolder($targetFolder) {
		\Yii::info("Target Folder: " . $targetFolder);
		mkdir($targetFolder);
		copy(\Yii::$app->params["baseDir"] . "/templates/brief/base.tex", $targetFolder . "/base.tex");

		return $targetFolder;
	}

	private function generateHash () {
		return hash("sha512", \Yii::$app->params["salt"] . Uuid::uuid4()->toString());
	}

	private function generateZipFile ($path) {
    	$zipFile = $path . "/download.zip";
		\Yii::trace("Adding file to zip: " . $zipFile);

    	try {
			$zip = new \ZipArchive();
			$zip->open($zipFile, \ZipArchive::CREATE);
			$zip->addGlob($path . "/*.pdf", GLOB_NOSORT, array('add_path' => '/','remove_all_path' => TRUE));
			$zip->close();
		} catch (\Exception $e) {
    		return false;
		}

    	if (file_exists($zipFile)) {
			if ($path) {
				foreach( glob($path . "/*.pdf") as $file ) {
					\Yii::trace("Deleting file: " . $file);
					unlink($file);
				}
			}

			return true;
		}
		return false;
	}

	private function generateFilename($oldName) {
		$umlauts = array(
			"ö" => "oe",
			"ä" => "ae",
			"ü" => "ue",
			"Ö" => "oe",
			"Ä" => "ae",
			"Ü" => "ue",
			"ß" => "ss"
		);

		$nameLowercase = strtolower($oldName);
		$nameWithoutMarks = preg_replace("#[[:punct:]]#", "", $nameLowercase);
		$nameWithoutSpaces = str_replace(" ", "_", $nameWithoutMarks);
		$nameWithoutUmlauts = str_replace(array_keys($umlauts), $umlauts, $nameWithoutSpaces);

		return $nameWithoutUmlauts;

	}

	private function generatePdf ($target, $dataSet, $targetFolder) {
    	$filename = $this->generateFilename($target["name"]);
    	$templateFile = $targetFolder . "/template.lco";

		copy(\Yii::$app->params["baseDir"] . "/templates/brief/template.lco", $templateFile);
		$template = file_get_contents($templateFile);

		// Alle Nutzerdaten ersetzen
		$template = str_replace("@@vorname@@", $dataSet["firstName"], $template);
		$template = str_replace("@@nachname@@", $dataSet["lastName"], $template);
		$template = str_replace("@@strasse@@", $dataSet["street"], $template);
		$template = str_replace("@@hausnummer@@", $dataSet["streetNumber"], $template);
		$template = str_replace("@@plz@@", $dataSet["zip"], $template);
		$template = str_replace("@@ort@@", $dataSet["city"], $template);
		$template = str_replace("@@ausweistext@@", $dataSet["idType"], $template);

		// Hier ersetzen wir einen Parameter durch eine ganze Funktion
		if($dataSet["additional"]) {
			$template = str_replace("%@@zusatzinfo@@", "\\newcommand{\zusatzinfo}{" . $dataSet["additional"] . "}", $template);
		}

		// Daten des Zieles
		$template = str_replace("@@zielname@@", $target["name"], $template);
		$template = str_replace("@@zieladresse@@", $target["adresse"], $template);
		$template = str_replace("@@zielplz@@", $target["plz"], $template);
		$template = str_replace("@@zielort@@", $target["stadt"], $template);

		unlink($templateFile);
		file_put_contents($templateFile, $template);

		$command = "pdflatex --output-directory " . $targetFolder . " --interaction batchmode --jobname " . $filename . " " . $targetFolder . "/base.tex";

		exec($command, $output, $returnCode);

		\Yii::trace("Command pdflatex returned error code " . $returnCode);

		if ($returnCode == 0) {
			return true;
		}
		return false;
	}

	private function sendDownloadEmail ($folder, $email) {
    	$template = file_get_contents(\Yii::$app->params["baseDir"] . "/templates/email/download.txt");
    	$downloadUrl = \Yii::$app->params["host"] . "/auskunft/download/" . $folder;

		$template = str_replace("@@url@@", $downloadUrl, $template);

		\Yii::trace("Mail to: " . $email);

		$mailStatus = \Yii::$app->mailer->compose()
			->setFrom(\Yii::$app->params["email_from"])
			->setTo($email)
			->setSubject("Deine Datenauskunftsbegehren stehen zum Download bereit!")
			->setTextBody($template)
			->send();

		\Yii::trace("Email status: " . $mailStatus);
	}
}
