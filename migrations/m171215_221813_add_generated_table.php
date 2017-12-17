<?php

use yii\db\Migration;

/**
 * Class m171215_221813_add_generated_table
 */
class m171215_221813_add_generated_table extends Migration
{
    /**
     * @inheritdoc
     */
	public function safeUp()
	{
		$this->createTable("generated", [
			"id" => $this->string(128)->notNull(),
			"generated" => $this->date()->notNull(),
			"todelete" => $this->date()->notNull(),
		]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171215_221813_add_generated_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_221813_add_generated_table cannot be reverted.\n";

        return false;
    }
    */
}