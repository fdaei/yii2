<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%emails}}`.
 */
class m220815_192011_create_emails_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%emails}}', [
            'id' => $this->primaryKey(),
            'receiver_name' => $this->string(),
            'receiver_email' => $this->string(),
            'subject' => $this->string(),
            'content' => $this->text(),
            'attachment' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%emails}}');
    }
}
