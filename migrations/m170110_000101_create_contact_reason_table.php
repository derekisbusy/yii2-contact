<?php

use yii\db\Schema;

class m170110_000101_create_contact_reason_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'contact_reason', $tables))  { 
            $this->createTable('{{%contact_reason}}', [
                'id' => $this->primaryKey()->unsigned(),
                'created_at' => $this->datetime(),
                'updated_at' => $this->datetime(),
                'created_by' => $this->integer(11)->unsigned()->null(),
                'updated_by' => $this->integer(11)->unsigned()->null(),
                'reason' => $this->string(255),
            ], $tableOptions);


            // Created By
            $this->createIndex(
                'idx-contact_reason-created_by',
                '{{%contact_reason}}',
                'created_by'
            );

            $this->addForeignKey(
                'fk-contact_reason-created_by',
                '{{contact_reason}}',
                'created_by',
                '{{%user}}',
                'id',
                'SET NULL',
                'CASCADE'
            );

            // Updated By
            $this->createIndex(
                'idx-contact_reason-updated_by',
                '{{%contact_reason}}',
                'updated_by'
            );

            $this->addForeignKey(
                'fk-contact_reason-updated_by',
                '{{contact_reason}}',
                'updated_by',
                '{{%user}}',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%contact_reason}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}
