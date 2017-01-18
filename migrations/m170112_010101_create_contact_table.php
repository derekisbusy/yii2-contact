<?php

use yii\db\Schema;

class m170112_010101_create_contact_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'assigned_to' => $this->integer(11)->defaultValue(1),
            'contact_reason_id' => $this->integer(11),
            'name' => $this->string(50),
            'email' => $this->string(255),
            'phone' => $this->string(20),
            'body' => $this->text(),
            'url' => $this->text()->notNull(),
            'referrer' => $this->text(),
            'FOREIGN KEY ([[updated_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[contact_reason_id]]) REFERENCES {{%contact_reason}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%contact}}');
    }
}
