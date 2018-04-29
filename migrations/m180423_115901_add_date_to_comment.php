<?php

use yii\db\Migration;

/**
 * Class m180423_115901_add_date_to_comment
 */
class m180423_115901_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
   /* public function safeUp()
    {
        $this->addColumn('comment', 'date', $this->date());
    }*/

    /**
     * {@inheritdoc}
     */
   /* public function safeDown()
    {
        echo "m180423_115901_add_date_to_comment cannot be reverted.\n";

        return false;
    }*/

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('comment', 'date', $this->date());
    }

    public function down()
    {
        $this->dropColumn('comment', 'date');
    }
    
}
