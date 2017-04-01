<?php
namespace derekisbusy\contact\backend\modules\contact\assets;

use yii\web\AssetBundle;


class ContactCommonAsset extends AssetBundle
{
    public $sourcePath = '@vendor/derekisbusy/yii2-contact/backend/modules/contact/assets';
    public $css = [
        'css/common.css',
    ];
    public $js = [
        'js/common.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\grid\GridViewAsset',
        'yii\widgets\PjaxAsset'
    ];
}