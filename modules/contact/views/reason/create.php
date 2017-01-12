<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContactReason */

$this->title = Yii::t('app', 'Create Contact Reason');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Reasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-reason-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
