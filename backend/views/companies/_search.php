<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'globalSearch',  [
        'inputOptions' => [
            'onkeyup' => "showResult(this.value)",
        ],
    ]) ?>
    <h1>Suggestion :</h1>
    <div id="livesearch" style="margin: 5px;padding: 10px"></div>
    <?php // echo $form->field($model, 'company_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
