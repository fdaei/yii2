<?php

namespace backend\modules\settings\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\settings\models\Employees;

/**
 * EmployeesSearch represents the model behind the search form of `backend\modules\settings\models\Employees`.
 */
class EmployeesSearch extends Employees
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id'], 'integer'],
            [['employee_name', 'employee_email', 'employee_address', 'departments_department_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Employees::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('departmentsDepartment');
        // grid filtering conditions
        $query->andFilterWhere([
            'employee_id' => $this->employee_id
        ]);

        $query->andFilterWhere(['like', 'employee_name', $this->employee_name])
            ->andFilterWhere(['like', 'employee_email', $this->employee_email])
            ->andFilterWhere(['like', 'employee_address', $this->employee_address])
            ->andFilterWhere(['like', 'departments.department_name', $this->departments_department_id]);

        return $dataProvider;
    }
}
