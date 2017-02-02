<?php

use derekisbusy\contact\models\Contact;
use derekisbusy\contact\models\ContactReason;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model Contact */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="contact-form">
    
    <?php $form = ActiveForm::begin(['action' => ['/contact']]); ?>
    <div class="row">
    <?= $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'contact_reason_id')
        ->dropDownList(
            ArrayHelper::map(ContactReason::find()->all(), 'id', 'reason'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        ); ?>
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
    <?php if ($message) : ?>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <?php endif; ?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit') , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
