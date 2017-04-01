<?php

namespace derekisbusy\contact\backend\modules\contact;

use derekisbusy\contact\BaseModule;

/**
 * contact module definition class
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\contact\backend\modules\contact\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public static function getModuleId()
    {
        if (defined('YII2_CONTACT_BACKEND')) {
            return YII2_CONTACT_BACKEND;
        }
        return 'contact';
    }
    
}
