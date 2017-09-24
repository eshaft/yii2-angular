<?php

use yii\db\Migration;

class m170924_192646_oauth extends Migration
{
    public function safeUp()
    {
        $this->createTable('user_auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-user_auth-user_id-user-id', 'user_auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('user_auth');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170924_192646_oauth cannot be reverted.\n";

        return false;
    }
    */
}
