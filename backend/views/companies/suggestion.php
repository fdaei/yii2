<?php
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'company_name'
    ],
]) ?>
<h1>uruuru</h1>