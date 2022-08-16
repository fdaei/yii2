<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_assignment}}`.
 */
class m220816_094900_create_auth_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_assignment}}', [
            'item_name' => $this->string(64),
            'user_id' => $this->string(64),
            'created_at' => $this->integer(11),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-auth_assignment-item_name',
            'auth_assignment',
            'item_name'
        );
        $this->addForeignKey(
            'fk-auth_assignment-item_name',
            'auth_assignment',
            'item_name',
            'auth_item',
            'name',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_assignment}}');
    }
}
