<?php

namespace derekisbusy\contact\frontend\modules\contact;

use derekisbusy\contact\BaseModule;

/**
 * contact module definition class
 */
class Module extends BaseModule
{
    const VIEW_CONTACT = 1;
    const VIEW_FORM = 2;
    
    public $viewSettings = [];
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'derekisbusy\contact\frontend\modules\contact\controllers';

    
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'request';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->viewSettings = array_replace_recursive([
            self::VIEW_CONTACT => 'contact',
            self::VIEW_FORM => '_form'
        ], $this->viewSettings);
        
    }
    
    public static function getModuleId()
    {
        if (defined('YII2_CONTACT_FRONTEND')) {
            return YII2_CONTACT_FRONTEND;
        }
        return 'contact';
    }
}
