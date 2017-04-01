<?php

use yii\db\Schema;

class m170110_000101_create_contact_notify_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'contact_notify', $tables))  { 
            $this->createTable('{{%contact_notify}}', [
                'id' => $this->primaryKey(11)->unsigned(),
                'email' => $this->string(255)->notNull(),
            ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%contact_notify}}');
    }
}
