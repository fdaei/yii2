<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%po_item}}`.
 */
class m220815_192132_create_po_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%po_item}}', [
            'id' => $this->primaryKey(),
            'po_item_no' => $this->string(),
            'quantity' => $this->float(),
            'po_id' => $this->integer(),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-po_item-po_id',
            'po_item',
            'po_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-po_id',
            'po_item',
            'po_id',
            'po',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%po_item}}');
    }
}
