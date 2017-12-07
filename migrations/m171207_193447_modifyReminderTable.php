<?php

use yii\db\Migration;

/**
 * Class m171207_193447_modifyReminderTable
 */
class m171207_193447_modifyReminderTable extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
	    $this->alterColumn("reminders", "created_at", "date");
	    $this->alterColumn("reminders", "due_at", "date");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171207_193447_modifyReminderTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171207_193447_modifyReminderTable cannot be reverted.\n";

        return false;
    }
    */
}
