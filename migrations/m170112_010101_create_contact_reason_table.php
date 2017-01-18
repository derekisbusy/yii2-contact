<?php

use yii\db\Schema;

class m170112_010101_create_contact_reason_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%contact_reason}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'reason' => $this->string(255),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%contact_reason}}');
    }
}
