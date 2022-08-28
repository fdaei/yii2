<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Companies;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'company_name',
            'company_email:email',
            'company_address',
             [
                'attribute'=>'company_created_data',
                'value'=>'company_created_data',
                'format'=>'raw',
//                'filter'=>DatePicker::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'company_created_data',
//                    'template' => '{addon}{input}',
//                    'clientOptions' => [
//                        'autoclose' => true,
//                        'format' => 'yyyy-mm-dd'
//                    ]
//                ])
             ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Companies $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'company_id' => $model->company_id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end();  ?>
</div>
