<?php

use yii\db\Schema;

class m170112_010101_create_contact_notify_reason_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%contact_notify_reason}}', [
            'contact_notify_id' => $this->integer(11)->notNull(),
            'contact_reason_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%contact_notify_reason}}');
    }
}
