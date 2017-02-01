<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model derekisbusy\contact\models\Contact */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="contact-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <?= $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'contact_reason_id')->textInput(['placeholder' => 'Contact Reason']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit') , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
