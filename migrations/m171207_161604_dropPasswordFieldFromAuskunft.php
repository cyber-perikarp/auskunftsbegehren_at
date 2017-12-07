<?php

use yii\db\Migration;

/**
 * Class m171207_161604_dropPasswordFieldFromAuskunft
 */
class m171207_161604_dropPasswordFieldFromAuskunft extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
    	$this->dropColumn("auskunft", "downloadPassword");
	    $this->dropColumn("auskunft", "downloadId");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171207_161604_dropPasswordFieldFromAuskunft cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171207_161604_dropPasswordFieldFromAuskunft cannot be reverted.\n";

        return false;
    }
    */
}
