<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Companies;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'companies_company_id')->dropDownList(
        ArrayHelper::map(Companies::find()->all(),'company_id','company_name'),
        ['prompt'=>'Select Company']
    ) ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'branch_created_date')->widget(
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

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive'], ['prompt' => 'status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
