<?php

use yii\db\Migration;

/**
 * Class m171113_075604_cron_test
 */
class m171113_075604_cron_test extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%cron_test}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%cron_test}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171113_075604_cron_test cannot be reverted.\n";

        return false;
    }
    */
}
