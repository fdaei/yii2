<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m220815_192033_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'employee_id' => $this->primaryKey(),
            'employee_name' => $this->string(),
            'employee_email' => $this->string(),
            'employee_address' => $this->string(),
            'departments_department_id' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-employees-departments_department_id',
            'employees',
            'departments_department_id'
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
