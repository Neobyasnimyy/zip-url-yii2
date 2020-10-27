<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m201027_133800_short_urls_table
 */
class m201027_133800_short_urls_table extends Migration
{
    /**
     * create table "short_urls"
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%short_urls}}', [
            'id' => Schema::TYPE_PK,
            'long_url' => Schema::TYPE_TEXT . ' NOT NULL',
            'short_code' => Schema::TYPE_STRING . '(8) NOT NULL',
            'time_create' => Schema::TYPE_DATETIME . ' NOT NULL',
            'counter' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createIndex('FK_short_code', '{{%short_urls}}', 'short_code', true);

    }

    /**
     * delete table 'short_urls'
     */
    public function safeDown()
    {
        $this->dropTable('{{%short_urls}}');
    }
}
