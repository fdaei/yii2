<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%companies}}`.
 */
class m220815_185434_create_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%companies}}', [
            'company_id' => $this->primaryKey(),
            'company_name' => $this->string(),
            'company_email' => $this->string(),
            'company_address' => $this->string(),
            'company_created_data' => $this->date(),
            'company_status' => $this->tinyInteger(),
            'logo'=>$this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%companies}}');
    }
}
