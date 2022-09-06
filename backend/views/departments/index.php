<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Departments;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
          'pager' => [

    			'class' => 'yii\bootstrap4\LinkPager',
          ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'branches_branch_id',
                'value'=>'branchesBranch.branch_name'
            ],
            [
                'attribute'=>'department_company_id',
                'value'=>'departmentCompany.company_name'
            ],
            // 'department_id',
            'department_name',
            'department_created_date',
            //'department_status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Departments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'department_id' => $model->department_id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end();  ?>

</div>
