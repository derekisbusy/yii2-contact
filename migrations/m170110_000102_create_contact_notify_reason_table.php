<?php

class m170110_000102_create_contact_notify_reason_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'contact_notify_reason', $tables))  { 
            $this->createTable('{{%contact_notify_reason}}', [
                'contact_notify_id' => $this->integer(11)->unsigned()->notNull(),
                'contact_reason_id' => $this->integer(11)->unsigned()->notNull(),
            ], $tableOptions);


            // contact_notify_id
            $this->createIndex(
                'idx-contact_notify_reason-contact_notify_id',
                '{{%contact_notify_reason}}',
                'contact_notify_id'
            );

            $this->addForeignKey(
                'fk-contact_notify_reason-contact_notify_id',
                '{{%contact_notify_reason}}',
                'contact_notify_id',
                '{{%contact_notify}}',
                'id',
                'CASCADE',
                'CASCADE'
            );

            // contact_reason_id
            $this->createIndex(
                'idx-contact_notify_reason-contact_reason_id',
                '{{%contact_notify_reason}}',
                'contact_reason_id'
            );

            $this->addForeignKey(
                'fk-contact_notify_reason-contact_reason_id',
                '{{%contact_notify_reason}}',
                'contact_reason_id',
                '{{%contact_reason}}',
                'id',
                'CASCADE',
                'CASCADE'
            );
        }
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%contact_notify_reason}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
