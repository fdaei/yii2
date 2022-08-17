<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customers}}`.
 */
class m220815_190512_create_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customers}}', [
            'customer_id' => $this->primaryKey(),
            'customer_name' => $this->string(),
            'zip_code' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string(),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-customers-zip_code',
            'customers',
            'zip_code'
        );

        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-customers-zip_code',
//            'customers',
//            'zip_code',
//            'locations',
//            'zip_code',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customers}}');
    }
}
