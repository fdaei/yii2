<?php

namespace backend\modules\settings\models;

use backend\models\Departments;
use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $employee_id
 * @property string|null $employee_name
 * @property string|null $employee_email
 * @property string|null $employee_address
 * @property int|null $departments_department_id
 *
 * @property Departments $departmentsDepartment
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departments_department_id'], 'integer'],
            [['employee_name', 'employee_email', 'employee_address'], 'string', 'max' => 255],
            [['departments_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['departments_department_id' => 'department_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'employee_name' => 'Employee Name',
            'employee_email' => 'Employee Email',
            'employee_address' => 'Employee Address',
            'departments_department_id' => 'Departments Department ID',
        ];
    }

    /**
     * Gets query for [[DepartmentsDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentsDepartment()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'departments_department_id']);
    }
}
