<?php

use yii\db\Schema;

class m170112_010101_create_contact_notify_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%contact_notify}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%contact_notify}}');
    }
}
