<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%branches}}`.
 */
class m220815_184217_create_branches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%branches}}', [
            'branch_id' => $this->primaryKey(),
            'branch_name' => $this->string(),
            'branch_address' => $this->string(),
            'branch_created_date' => $this->dateTime(),
            'branch_status' =>"ENUM('active', 'inactive')",
            'companies_company_id' => $this->integer(),

        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-branches-companies_company_id',
            'branches',
            'companies_company_id'
        );

//        // add foreign key for table `user`

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%branches}}');
    }
}
