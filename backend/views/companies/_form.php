<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Companies */
/* @var $form yii\widgets\ActiveForm */
/* @var $branch backend\models\Branches */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(/*['enableAjaxValidation' => true]*/);?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'company_created_data')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'file')->fileInput()?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',  ], ['prompt' => 'status']) ?>

    <!-- Create Branch For this company  -->
    <h1 class="my-5">Create Branch For this company</h1>

    <?= $form->field($branch, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($branch,'branch_created_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);?>

    <?= $form->field($branch, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($branch, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive'], ['prompt' => 'status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
