<?php

use yii\db\Migration;

/**
 * Class m171207_164837_adaptIdentifiers
 */
class m171207_164837_adaptIdentifiers extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
	    $this->dropColumn("reminders", "idfile");
	    $this->dropColumn("reminders", "quelldatei");
	    $this->dropColumn("statistik", "idfile");
	    $this->dropColumn("statistik", "quelldatei");

	    $this->addColumn("reminders", "targets", "text not null");
	    $this->addColumn("statistik", "identifier", "varchar(64) not null");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171207_164837_adaptIdentifiers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171207_164837_adaptIdentifiers cannot be reverted.\n";

        return false;
    }
    */
}
