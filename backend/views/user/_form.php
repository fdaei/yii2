<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
/** @var \backend\models\AuthItem $authItems */
/* @var $itemassang \backend\models\AuthAssignment */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id'=>'User']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'active', '9' => 'inactive'],['prompt'=>'Select Option']); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?php
    $authItems= \yii\helpers\ArrayHelper::map($authItems,'name','name')
    ?>
    <?php
    if(isset($itemassang) && $itemassang!=null) {
         echo $form->field($model, 'permissions')->checkboxList($authItems, array('checked' => false, 'value' => \yii\helpers\ArrayHelper::map($itemassang, 'item_name', 'item_name')));
    }
    else{
        echo $form->field($model, 'permissions')->checkboxList($authItems);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
