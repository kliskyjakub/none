<?php

use yii\db\Migration;

/**
 * Class m180706_090940_users_table
 */
class m180706_090940_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function safeUp()
     {
       $this->createTable('users',
           [
             'id' => $this->primaryKey(),
             'username' => $this->string()->notNull()->unique(),
             'password' => $this->string()->notNull(),
           ]);
       $this->insert('users',[
         'username' => 'test',
         'password' => Yii::$app->getSecurity()->generatePasswordHash('test123')
       ]);
     }

     /**
      * {@inheritdoc}
      */
     public function safeDown()
     {
         $this->dropTable('users');
     }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180706_090940_users_table cannot be reverted.\n";

        return false;
    }
    */
}
