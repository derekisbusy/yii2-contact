<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\ContactNotify */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="contact-notify-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'reasons')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\derekisbusy\contact\models\ContactReason::find()->asArray()->all() ,'id', 'reason'),
            'options' => [
                'placeholder' => 'Select reasons ...',
                'multiple' => true
            ],
        ]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
