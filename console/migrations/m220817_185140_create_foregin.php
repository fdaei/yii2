<?php

use yii\db\Migration;

/**
 * Class m220817_185140_create_foregin
 */
class m220817_185140_create_foregin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->addForeignKey(
//            'fk-branches-companies_company_id',
//            'branches',
//            'companies_company_id',
//            'companies',
//            'company_id',
//            'CASCADE'
//        );
        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-customers-zip_code',
//            'customers',
//            'zip_code',
//            'locations',
//            'zip_code',
//            'CASCADE'
//        );
//        $this->addForeignKey(
//            'fk-employees-departments_department_id',
//            'employees',
//            'departments_department_id',
//            'departments',
//            'id',
//            'CASCADE'
//        );
        $this->addForeignKey(
            'fk-departments-branches_branch_id',
            'departments',
            'branches_branch_id',
            'branches',
            'branch_id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-departments-department_company_id',
            'departments',
            'department_company_id',
            'companies',
            'company_id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-auth_item-rule_name',
            'auth_item',
            'rule_name',
            'auth_rule',
            'name',
            'CASCADE'
        );
//         add foreign key for table `tag`
        $this->addForeignKey(
            'fk-auth_item_child-child',
            'auth_item_child',
            'child',
            'auth_item',
            'name',
            'CASCADE'
        );
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
        echo "m220817_185140_create_foregin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220817_185140_create_foregin cannot be reverted.\n";

        return false;
    }
    */
}
