<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContactReason */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contact Reason',
]) . ' ' . $model->reason;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Reasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reason, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contact-reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
