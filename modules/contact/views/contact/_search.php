<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\ContactSearch */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::to(['user/ajax/usernames']);
?>

<div class="form-contact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'assigned_to')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Select a user ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(result) { return result.text; }'),
            'templateSelection' => new JsExpression('function (result) { return result.text; }'),
        ],
    ]) ?>

    <?= $form->field($model, 'reason')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\base\ContactReason::find()->asArray()->all(), 'reason', 'reason'),
        'options' => ['placeholder' => 'Select a reason ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>

    <?php echo $form->field($model, 'body')->textInput() ?>

    <?php echo $form->field($model, 'url')->textInput() ?>

    <?php echo $form->field($model, 'referrer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
