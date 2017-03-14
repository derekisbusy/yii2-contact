<?php

namespace derekisbusy\contact\frontend\modules\contact;

/**
 * contact module definition class
 */
class Module extends \yii\base\Module
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
}
