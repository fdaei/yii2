<?php

namespace backend\modules\settings\models;

use Yii;
use backend\models\Departments;
/**
 * This is the model class for table "employees".
 *
 * @property int $employee_id
 * @property string $employee_name
 * @property string $employee_email
 * @property string $employee_address
 * @property int $departments_department_id
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
            [['employee_name', 'employee_email', 'employee_address', 'departments_department_id'], 'required'],
            [['departments_department_id'], 'integer'],
            [['employee_name', 'employee_email'], 'string', 'max' => 100],
            [['employee_address'], 'string', 'max' => 255],
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
