<?php

use yii\db\Migration;

/**
 * Class m171201_082209_idType
 */
class m171201_082209_idType extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable("idTypes", [
            "id" => $this->primaryKey(),
            "name" => $this->string(64)->notNull(),
            "nameForText" => $this->string(64)->notNull(),
        ]);

        // Liste der amtlichen Lichtbildausweise laut https://www.help.gv.at/Portal.Node/hlpd/public/content/99/Seite.990001.html und https://www.buergerkarte.at/ausweisliste.html
        $toInsert = array(
           "reisepass" => array(
                "name" => "Reisepass",
                "nameForText" => "Reisepasses"
           ),
           "perso" => array(
                "name" => "Personalausweis",
                "nameForText" => "Personalausweises"
           ),
           "fuehrerschein" => array(
                "name" => "Führerschein",
                "nameForText" => "Führerscheins"
           ),
           "ident" => array(
                "name" => "Identitätsausweis",
                "nameForText" => "Identitätsausweises"
           ),
           "amtl" => array(
                "name" => "Amtlicher Dienstausweis",
                "nameForText" => "amtlichen Dienstausweises"
           ),
           "waffenpass" => array(
                "name" => "Waffenpass",
                "nameForText" => "Waffenpasses"
           ),
           "apo" => array(
                "name" => "Apothekerausweis",
                "nameForText" => "Apothekerausweises"
           ),
           "notar" => array(
                "name" => "Notarausweis",
                "nameForText" => "Notarausweises"
           ),
           "rechtsanw" => array(
                "name" => "Rechtsanwaltsausweis",
                "nameForText" => "Rechtsanwaltsausweises"
           ),
           "dolm" => array(
                "name" => "Dolmetscherausweis",
                "nameForText" => "Dolmetscherausweises"
           ),
           "zivit" => array(
                "name" => "Ziviltechnikerausweis",
                "nameForText" => "Ziviltechnikerausweises"
           ),
           "sachv" => array(
                "name" => "Sachverständigenausweis",
                "nameForText" => "Sachverständigenausweises"
           ),
           "studi" => array(
                "name" => "Studierendenausweis (mit Foto!)",
                "nameForText" => "Studierendenausweises"
           ),
           "behipa" => array(
                "name" => "Behindertenpass",
                "nameForText" => "Behindertenpasses"
           ),
           "edarepl" => array(
                "name" => "eDA Dienstausweis Republik Österreich",
                "nameForText" => "eDA Dienstausweises der Republik Österreich"
           ),
           "educard" => array(
                "name" => "EDU-Card",
                "nameForText" => "Schülerausweises in Form der EDU-Card"
           ),
           "gemeinde" => array(
                "name" => "Gemeindeausweis",
                "nameForText" => "Gemeindeausweises"
           ),
        );

        // Array nach dem Alphabet sortieren, aber nach subkeys
        function sortByOption($a, $b) {
            return strcmp($a['name'], $b['name']);
        }
        usort($toInsert, 'sortByOption');
       

        foreach ($toInsert as $key => $value) {
            $this->insert("idTypes",array(
                "name" => $value["name"],
                "nameForText" => $value["nameForText"]
            ));
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171201_082209_idType cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171201_082209_idType cannot be reverted.\n";

        return false;
    }
    */
}
