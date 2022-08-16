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
        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-auth_item_child-child',
            'auth_item_child',
            'child',
            'auth_item',
            'name',
            'CASCADE'
        );
        // add foreign key for table `tag`
        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-auth_item_child-parent',
            'auth_item_child',
            'parent',
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
        $this->dropTable('{{%auth_item_child}}');
    }
}
