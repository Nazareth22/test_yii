<?php

use yii\db\Migration;

/**
 * Class m190226_090358_application
 */
class m190226_090358_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190226_090358_application cannot be reverted.\n";

        return false;
    }


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'text' => $this->string(1024)->notNull(),
            'city' => $this->string()->notNull(),
            'address' =>$this->string()->notNull(),
            'lat' => $this->float()->notNull(),
            'lon' => $this->float()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%application}}');
    }
}
