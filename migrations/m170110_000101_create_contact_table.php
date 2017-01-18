<?php

use yii\db\Schema;

class m170110_000101_create_contact_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'contact', $tables))  { 
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
            ], $tableOptions);
        
        
            // Created By
            $this->createIndex(
                'idx-contact-created_by',
                '{{%contact}}',
                'created_by'
            );

            $this->addForeignKey(
                'fk-contact-created_by',
                '{{%contact}}',
                'created_by',
                '{{%user}}',
                'id',
                'SET NULL',
                'CASCADE'
            );

            // Updated By
            $this->createIndex(
                'idx-contact-updated_by',
                '{{%contact}}',
                'updated_by'
            );

            $this->addForeignKey(
                'fk-contact-updated_by',
                '{{%contact}}',
                'updated_by',
                '{{%user}}',
                'id',
                'SET NULL',
                'CASCADE'
            );

            // Assigned To
            $this->createIndex(
                'idx-contact-assigned_to',
                '{{%contact}}',
                'assigned_to'
            );

            $this->addForeignKey(
                'fk-contact-assigned_to',
                '{{%contact}}',
                'assigned_to',
                '{{%user}}',
                'id',
                'SET NULL',
                'CASCADE'
            );

            // Contact Reason
            $this->createIndex(
                'idx-contact-contact_reason_id',
                '{{%contact}}',
                'contact_reason_id'
            );

            $this->addForeignKey(
                'fk-contact-contact_reason_id',
                '{{%contact}}',
                'contact_reason_id',
                '{{%contact_reason}}',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%contact}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}
