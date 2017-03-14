<?php

use kartik\date\DatePickerAsset;
use kartik\helpers\Html;
use kartik\select2\Select2Asset;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\widgets\PjaxAsset;
use kartik\grid\GridViewAsset;

GridViewAsset::register($this);
PjaxAsset::register($this);
Select2Asset::register($this);
DatePickerAsset::register($this);

$this->title = Yii::t('app', 'Contact Reasons');
$this->params['breadcrumbs'][] = $this->title;


echo Html::beginTag('div', ['class' => "contact-settings-view"]);
echo TabsX::widget([
    'id' => 'contact-settings-tabs',
    'items' => [
//        [
//            'label' => '<i class="glyphicon glyphicon-user"></i> Reason/Department',
//            'content' => $this->render('_detail', ['model' => $model, 'physicalAddress' => $physicalAddress, 'mailingAddress' => $mailingAddress, 'contact' => $contact]),
//            'active' => true
//        ],
        [
            'label' => Html::icon('file').' Reason/Department</span>',
            'linkOptions' => [
                'id' => 'contact-settings-notify-tab',
                'data-url' => Url::toRoute(['/contact/reason'])]
        ],
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> Receivers</span>',
            'linkOptions' => [
                'id' => 'contact-settings-notify-tab',
                'data-url' => Url::toRoute(['/contact/notify'])]
        ],
    ],
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'pluginOptions' => [
        'enableCache' => false
    ]
]);
echo Html::endTag('div');