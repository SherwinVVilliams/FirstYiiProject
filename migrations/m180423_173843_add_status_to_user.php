<?php

use yii\db\Migration;

/**
 * Class m180423_173843_add_status_to_user
 */
class m180423_173843_add_status_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    /*public function safeUp()
    {

    }*/

    /**
     * {@inheritdoc}
     */
   /* public function safeDown()
    {
        echo "m180423_173843_add_status_to_user cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    */
    public function up()
    {
        $this->addColumn('user', 'status', $this->smallInteger());
    }

    public function down()
    {
       $this->dropColumn('user', 'status');
    }
    
}
