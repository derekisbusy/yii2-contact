<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContactNotify */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contact Notify',
]) . ' ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Notifies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contact-notify-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
