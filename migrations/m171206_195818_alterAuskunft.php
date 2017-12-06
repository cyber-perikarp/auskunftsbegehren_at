<?php

use yii\db\Migration;

/**
 * Class m171206_195818_alterAuskunft
 */
class m171206_195818_alterAuskunft extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn('auskunft', 'sessionId', 'downloadId');
        $this->alterColumn("auskunft", "downloadId", "varchar(128) not null");
        $this->addColumn("auskunft", "downloadPassword", "varchar(128) not null");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171206_195818_alterAuskunft cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_195818_alterAuskunft cannot be reverted.\n";

        return false;
    }
    */
}
