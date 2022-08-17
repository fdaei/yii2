<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m220816_052654_create_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%departments}}', [
            'department_id' => $this->primaryKey(),
            'branches_branch_id' => $this->integer(),
            'department_name' => $this->string(),
            'department_company_id' => $this->integer(),
            'department_created_date' => $this->dateTime(),
            'department_status' => $this->tinyInteger(),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-departments-branches_branch_id',
            'departments',
            'branches_branch_id'
        );

        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-departments-branches_branch_id',
//            'departments',
//            'branches_branch_id',
//            'branches',
//            'id',
//            'CASCADE'
//        );

        // creates index for column `author_id`
        $this->createIndex(
            'idx-departments-department_company_id',
            'departments',
            'department_company_id'
        );

        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-departments-department_company_id',
//            'departments',
//            'department_company_id',
//            'companies',
//            'id',
//            'CASCADE'
//        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%departments}}');
    }
}
