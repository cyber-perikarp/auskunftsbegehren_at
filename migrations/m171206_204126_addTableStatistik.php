<?php

use yii\db\Migration;

/**
 * Class m171206_204126_addTableStatistik
 */
class m171206_204126_addTableStatistik extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable("statistik", [
            "id" => $this->primaryKey(),
            "quelldatei" => $this->string(64)->notNull(),
            "idfile" => $this->integer(4)->notNull(),
            "counter" => $this->integer(8)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171206_204126_addStatsTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_204126_addStatsTable cannot be reverted.\n";

        return false;
    }
    */
}
