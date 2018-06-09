<?php

use yii\db\Migration;

/**
 * Class m180609_205739_addTableUser
 */
class m180609_205739_addTableUser extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable("user", [
            "id" => $this->primaryKey(),
            "username" => $this->string(64)->notNull(),
            "password" => $this->string(64)->notNull(),
            "authKey" => $this->string(64),
            "accessToken" => $this->string(64),
        ]);

        $this->insert("user",array(
            "username" => "admin",
            "password" => "1337Datenschuetzer",//password_hash("1337Datenschuetzer", PASSWORD_BCRYPT),
            "authKey" => "1337Datenkey",
            "accessToken" => "1337Datentoken"
        ));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180609_205739_addTableUser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180609_205739_addTableUser cannot be reverted.\n";

        return false;
    }
    */
}
