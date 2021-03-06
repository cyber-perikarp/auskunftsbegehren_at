<?php
namespace app\commands;
use app\models\IdTypes;
use function var_dump;
use yii\console\Controller;
use app\models\Auskunft;
use app\models\Reminders;
use app\models\Adressdaten;
use app\models\Statistik;
use app\models\Generated;
use Ramsey\Uuid\Uuid;

class GenerationController extends Controller
{
    private $error; // Die Variable wird true wenn pro Nutzer ein kritischer Fehler auftritt aka ein pdf konnte nicht generiert werden oder das zippen hat nicht funktioniert
	private $now;

	public function __construct(string $id, $module, array $config = []) {
		$this->now = new \DateTime();
		parent::__construct($id, $module, $config);
	}

	public function actionIndex()
    {
	    $allDatasets = Auskunft::find()->all();

        foreach ($allDatasets as $dataSet) {
			$dataSet = $this->latexEscapeDataSet($dataSet);

            \Yii::debug("Processing entry for " . $dataSet["email"]);
        	$this->error = false;

        	$targetFolderHash = $this->generateHash();
			$targetFolder = \Yii::$app->params["outputBaseDir"] . "/" . $targetFolderHash;

			if (!$this->createFolder($targetFolder)) {
				\Yii::error("Oh noes! Folder Creation failed");
				$this->error = true;
				continue;
			}

			$dataSet["idType"] = IdTypes::findOne(["id" => $dataSet["idType"]])["nameForText"];
			
			if (!$this->generateAndSavePdf($dataSet, $targetFolder)){
				\Yii::error("Oh noes! PDF Creation failed");
				$this->error = true;
			}

			// Die Logdateien sollen nur gelöscht und die Erinnerungen nur gespeichert werden wenn die pdf generierung erfolgreich war.
			if (!$this->error) {
				\Yii::debug("Deleting log files from generation");
				$this->deleteTempFiles($targetFolder);
			}

	        // Wenn das zip nicht erstellt werden konnte ist das ein fehler
	        if (!$this->generateZipFile($targetFolder)) {
		        \Yii::error("Oh noes! ZIP Creation failed");
		        $this->error = true;
		        continue;
	        }

	        $this->addGeneratedDate($targetFolderHash);

			// Wenn bis jetzt alles gut war können wir die Erinnerung speichern und die Email verschicken :)
			if($dataSet["reminder"]) {
				$this->addReminder($dataSet["email"], $dataSet["targets"]);
			}

			if (!$this->error) {
				$this->sendDownloadEmail($targetFolderHash, $dataSet["email"]);
			}

			// Wenn wir nicht im dev modus sind lösche den Datensatz
			if (!\Yii::$app->params["cli_dev"]) {
				try {
					$dataSet->delete();
				} catch (\Exception $e) {
					\Yii::error("Could not delete entry: " . $e);
				}
			}
        }
    }

	private function latexEscapeDataSet($dataSet) {
		$dataSet["firstName"] = $this->latexEscape($dataSet["firstName"]);
		$dataSet["lastName"] = $this->latexEscape($dataSet["lastName"]);
		$dataSet["street"] = $this->latexEscape($dataSet["street"]);
		$dataSet["zip"] = $this->latexEscape($dataSet["zip"]);
		$dataSet["city"] = $this->latexEscape($dataSet["city"]);
		$dataSet["email"] = $this->latexEscape($dataSet["email"]);
		$dataSet["additional"] = $this->latexEscape($dataSet["additional"]);
		return $dataSet;
	}

	private function generateAndSavePdf($dataSet, $targetFolder) {
		$targets = json_decode($dataSet["targets"]);
		$ret = true;
		foreach ($targets as $target) {
			\Yii::info("Target: " . $target);
			$this->saveStats($target);
			if (!$this->generatePdf(Adressdaten::findOne(["id" => $target]), $dataSet, $targetFolder)) {
				$ret = false;
			}
		}
		return $ret;
	}

    private function addGeneratedDate ($id) {
		$model = new Generated();

		$model->id = $id;
		$model->generated_at = $this->now->format("Y-m-d H:i:s");
		$model->todelete_at = $this->now->add(
			\DateInterval::createFromDateString("72 hours")
		)->format("Y-m-d H:i:s"); // + 72 Stunden

		\Yii::info("This record is going to be deleted at: " . $model->todelete_at);

		$model->save();

	}

	private function addReminder($email, $targets) {
		\Yii::info("Adding Reminder");
    	$reminder = new Reminders();

		$reminder->created_at = $this->now->format("Y-m-d");;

		$reminder->due_at = $this->now->add(
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
					\Yii::debug("Deleting file: " . $file);
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
		\Yii::debug("Adding file to zip: " . $zipFile);

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
					\Yii::debug("Deleting file: " . $file);
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

	private function latexEscape ($text) {
	    // https://github.com/mike42/web-pdf/blob/master/LatexTemplate.php
        // Prepare backslash/newline handling
        $text = str_replace("\n", "\\\\", $text); // Rescue newlines
        $text = str_replace("\\\\", "\n", $text); // Re-insert newlines and clear \\
        $text = str_replace("\\", "\\\\", $text); // Use double-backslash to signal a backslash in the input (escaped in the final step).

        // Symbols which are used in LaTeX syntax
        $text = str_replace("{", "\\{", $text);
        $text = str_replace("}", "\\}", $text);
        $text = str_replace("$", "\\$", $text);
        $text = str_replace("&", "\\&", $text);
        $text = str_replace("#", "\\#", $text);
        $text = str_replace("^", "\\textasciicircum{}", $text);
        $text = str_replace("_", "\\_", $text);
        $text = str_replace("~", "\\textasciitilde{}", $text);
        $text = str_replace("%", "\\%", $text);

        // Brackets & pipes
        $text = str_replace("<", "\\textless{}", $text);
        $text = str_replace(">", "\\textgreater{}", $text);
        $text = str_replace("|", "\\textbar{}", $text);

        // Quotes
        $text = str_replace("\"", "\\textquotedbl{}", $text);
        $text = str_replace("'", "\\textquotesingle{}", $text);
        $text = str_replace("`", "\\textasciigrave{}", $text);

        // Clean up backslashes from before
        $text = str_replace("\\\\", "\\textbackslash{}", $text); // Substitute backslashes from first step.
        $text = str_replace("\n", "\\\\", trim($text)); // Replace newlines (trim is in case of leading \\)

        return $text;
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

		\Yii::debug("Command pdflatex returned error code " . $returnCode);

		if ($returnCode == 0) {
			return true;
		}

		echo $output;

		return false;
	}

	private function sendDownloadEmail ($folder, $email) {
    	$template = file_get_contents(\Yii::$app->params["baseDir"] . "/templates/email/download.txt");
    	$downloadUrl = \Yii::$app->params["host"] . "/auskunft/download/" . $folder;

		$template = str_replace("@@url@@", $downloadUrl, $template);

		\Yii::debug("Mail to: " . $email);

		$mailStatus = \Yii::$app->mailer->compose()
			->setFrom(\Yii::$app->params["email_from"])
			->setTo($email)
			->setSubject("Deine Datenauskunftsbegehren stehen zum Download bereit!")
			->setTextBody($template)
			->send();

		\Yii::debug("Email status: " . $mailStatus);
	}
}
