<?php

use backend\models\Po;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PoItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="po-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'po_item_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'po_id')->dropDownList(
        ArrayHelper::map(Po::find()->all(),'id','po_no'),
        ['prompt'=>'Select Company']
    ) ?>
    <?php $form->field($model, 'po_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(Po::find()->all(),'id','po_no'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
