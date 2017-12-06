<?php

use yii\db\Migration;

/**
 * Class m171206_163839_addTableAuskunft
 */
class m171206_163839_addTableAuskunft extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable("auskunft", [
            "id" => $this->primaryKey(),
            "firstName" => $this->string(64)->notNull(),
            "lastName" => $this->string(64)->notNull(),
            "street" => $this->string(64)->notNull(),
            "streetNumber" => $this->string(32)->notNull(),
            "zip" => $this->integer(4)->notNull(),
            "city" => $this->string(64)->notNull(),
            "email" => $this->string(64)->notNull(),
            "additional" => $this->text()->notNull()->defaultValue(""),
            "reminder" => $this->boolean()->notNull(),
            "idType" => $this->integer()->notNull(),
            "targets" => $this->text()->notNull(),
            "sessionId" => $this->string(64)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171206_163839_addTableAuskunft cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_163839_addTableAuskunft cannot be reverted.\n";

        return false;
    }
    */
}
