<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%po}}`.
 */
class m220815_192112_create_po_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%po}}', [
            'id' => $this->primaryKey(),
            'po_no' => $this->string(),
            'description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%po}}');
    }
}
