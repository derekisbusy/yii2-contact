<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use derekisbusy\growl\FlashGrowlWidget;
use yii\helpers\Html;
use kartik\dropdown\DropdownX;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;

\derekisbusy\contact\backend\modules\contact\assets\ContactCommonAsset::register($this);

$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

echo FlashGrowlWidget::widget();
echo Dialog::widget();

$columns = [
    [
        'class'=>'kartik\grid\CheckboxColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
    ],
    [
        'class' => 'yii\grid\SerialColumn',
        'visible' => false
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    ['attribute' => 'id', 'visible' => false],
    [
        'attribute' => 'assignedTo',
        'value' => function ($model, $key, $index, $column) {
            return $model->assignedTo->username;
        }
    ],
    [
        'attribute' => 'reason',
        'value' => function ($model, $key, $index, $column) {
            return $model->reason->reason;
        }
    ],
    'name',
    'email:email',
    'phone',
//        'body:ntext',
//        'url:ntext',
//        'referer:ntext',
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];

echo Html::beginTag('div', ['class'=>'contact-requests-index']);
$gridId = 'geo-alias-grid';
echo DynaGrid::widget([
    'columns' => $columns,
    'options' => ['id' => 'contact-requests-dynagrid'],
    'allowThemeSetting' => false,
    'gridOptions'=>[
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-contact-requests']],
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => [
            'position' => 'absolute'
        ],
        'resizableColumns' => true,
        'resizableColumnsOptions' => ['resizeFromBody' => true],
        'persistResize' => true,
        'hideResizeMobile' => true,
        'toolbar' => [
            [
                'content' => 
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default', 
                        'title' => Yii::t('backend', 'Reset')
                    ]),
            ],
            '{dynagrid}',
            '{dynagridFilter}',
            '{dynagridSort}',
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]),
            '{toggleData}'
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('contact', 'New Request'), ['create'], ['class' => 'btn btn-success']), 
            'showFooter' => true,
            'after' => 
                Html::beginTag('div', ['class'=>' pull-left gridview-after-text']) .
                Yii::t('contact', 'With selected: ').
                Html::endTag('div') .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete-multiple'], [
                    'class' => 'pull-left clear btn btn-danger btn-delete-items',
                    'data-confirm-message' => Yii::t('contact', 'Are you sure you want to delete these {item}?', ['item' => Yii::t('contact', ' contact requests')]),
                    'data-grid' => $gridId,
                    'data-csrf-param' => yii::$app->request->csrfParam,
                    'data-csrf-token' => yii::$app->request->csrfToken
                ]) .
                Html::beginTag('div', ['class'=>' pull-left dropdown', 'style' => 'margin-left:20px']) .
                Html::button('Status <span class="caret"></span></button>', 
                    ['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']) . 
//                DropdownX::widget([
//                    'items' => [
//                        ['label' => Yii::t('contact','Active'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#contact-requests-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCity::STATUS_ACTIVE,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                        ['label' => Yii::t('contact','Inactive'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#contact-requests-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCity::STATUS_INACTIVE,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                        ['label' => Yii::t('contact','Deleted'), 'url' => 'javascript:;', 
//                            'linkOptions' => [
//                                'class' => 'btn-update-status',
//                                'data-pjax-container' => '#contact-requests-dynagrid-pjax',
//                                'data-url' => Url::toRoute(['mark-multiple']),
//                                'data-status' => GeoCity::STATUS_DELETED,
//                                'data-grid' => $gridId,
//                                'data-csrf-param' => yii::$app->request->csrfParam,
//                                'data-csrf-token' => yii::$app->request->csrfToken
//                            ]
//                        ],
//                    ],
//                ]) .
                Html::endTag('div') . 
                Html::beginTag('div', ['class'=>' clearfix']) .
                Html::endTag('div') 
        ],
    ],
]);
echo Html::endTag('div');