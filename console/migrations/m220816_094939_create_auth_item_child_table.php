<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item_child}}`.
 */
class m220816_094939_create_auth_item_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item_child}}', [
            'child' => $this->string(64),
            'parent' => $this->string(64),
        ]);
        // creates index for column `post_id`
        $this->createIndex(
            'idx-auth_item_child-child',
            'auth_item_child',
            'child'
        );
        // creates index for column `post_id`
        $this->createIndex(
            'idx-auth_item_child-parent',
            'auth_item_child',
            'parent'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item_child}}');
    }
}
