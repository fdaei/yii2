<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_created_data
 * @property string $company_status
 *
 * @property Branches[] $branches
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_created_data', 'company_status'], 'required'],
            [['company_created_data'], 'safe'],
            ['company_created_data','check'],
            [['company_status'], 'string'],
            [['file'],'file'],
            [['company_name','logo','company_email'], 'string', 'max' => 100],
            [['company_address'], 'string', 'max' => 255],
        ];
    }

    public function check($attribute,$params){
        $today = date('Y-m-d');
        $selectDate = date($this->company_created_data);
        if($selectDate > $today){
            $this->addError($attribute,'Company Created Data Must be smailer');
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_created_data' => 'Company Created Data',
            'company_status' => 'Company Status',
            'file'=>'logo',
        ];
    }

    /**
     * Gets query for [[Branches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['companies_company_id' => 'company_id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['department_company_id' => 'company_id']);
    }
}
