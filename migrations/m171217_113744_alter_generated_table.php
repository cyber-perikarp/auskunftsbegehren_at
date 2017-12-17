<?php

use yii\db\Migration;

/**
 * Class m171217_113744_alter_generated_table
 */
class m171217_113744_alter_generated_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->addPrimaryKey("id", "generated", "id");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171217_113744_alter_generated_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171217_113744_alter_generated_table cannot be reverted.\n";

        return false;
    }
    */
}
