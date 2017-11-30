<?php

use yii\db\Migration;

/**
 * Class m171130_111118_create_inital_tables
 */
class m171130_111118_create_inital_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable("reminders", [
            "id" => $this->primaryKey(),
            "email" => $this->string(64)->notNull(),
            "idfile" => $this->integer(4)->notNull(),
            "quelldatei" => $this->string(64)->notNull(),
            "created_at" => $this->dateTime()->notNull(),
            "due_at" => $this->dateTime()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171130_111118_create_inital_tables cannot be reverted.\n";

        return false;
    }
}
