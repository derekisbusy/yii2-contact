<?php

namespace derekisbusy\contact\frontend\modules\contact;

/**
 * contact module definition class
 */
class Module extends \yii\base\Module
{
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

        // custom initialization code goes here
    }
}
