<?php

namespace derekisbusy\contact\modules\contact;

use yii\base\Module as BaseModule;

/**
 * contact module definition class
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\contact\modules\contact\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public static function getUserClassname()
    {
        return 'dektrium\user\models\User';
    }
    
    public static function getUserModelIdName()
    {
        return 'id';
    }
}
