<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContactNotify */

$this->title = Yii::t('app', 'Create Contact Notify');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Notifies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-notify-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
