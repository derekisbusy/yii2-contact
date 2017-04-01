<?php

namespace derekisbusy\contact;

use Yii;


/**
 * Base module for frontend and backend modules.
 */
abstract class BaseModule extends \yii\base\Module
{
    
    public $backendRoles = [];
    public $frontendRoles = [];
    
    const MODEL_CONTACT = 1;
    const MODEL_CONTACT_NOTIFY = 2;
    const MODEL_CONTACT_NOTIFY_QUERY = 3;
    const MODEL_CONTACT_NOTIFY_SEARCH = 4;
    const MODEL_CONTACT_QUERY = 5;
    const MODEL_CONTACT_REASON = 6;
    const MODEL_CONTACT_REASON_QUERY = 7;
    const MODEL_CONTACT_REASON_SEARCH = 8;
    const MODEL_CONTACT_SEARCH = 9;
    
    
    public $modelSettings = [];
    
    public $db = 'db';
    public $userClass = 'app\models\User';
    public $username = 'username';
    public $userTableIdColumn = 'id';
    
    
    public static abstract function getModuleId();
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->modelSettings = array_merge([
            self::MODEL_CONTACT => 'derekisbusy\contact\models\Contact',
            self::MODEL_CONTACT_NOTIFY => 'derekisbusy\contact\models\ContactNotify',
            self::MODEL_CONTACT_NOTIFY_QUERY => 'derekisbusy\contact\models\ContactNotifyQuery',
            self::MODEL_CONTACT_NOTIFY_SEARCH => 'derekisbusy\contact\models\ContactNotifySearch',
            self::MODEL_CONTACT_QUERY => 'derekisbusy\contact\models\ContactQuery',
            self::MODEL_CONTACT_REASON => 'derekisbusy\contact\models\ContactReason',
            self::MODEL_CONTACT_REASON_QUERY => 'derekisbusy\contact\models\ContactReasonQuery',
            self::MODEL_CONTACT_REASON_SEARCH => 'derekisbusy\contact\models\ContactReasonSearch',
            self::MODEL_CONTACT_SEARCH => 'derekisbusy\contact\models\ContactSearch',
        ], $this->modelSettings);
    }
    
    public static function getUserClassname()
    {
        if (defined('YII2_USER_CLASSNAME')) {
            return YII2_USER_CLASSNAME;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userClass;
        }
        return 'common\models\User';
    }
    
    
    public static function getUserTableName()
    {
        return call_user_func(self::getUserClassname().'::tableName');
    }
    
    public static function getUserIdColumnName()
    {
        if (defined('YII2_USER_ID_COLUMN')) {
            return YII2_USER_ID_COLUMN;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userClass;
        }
        return 'id';
    }
    
    public static function getUsernameColumnName()
    {
        
        if (defined('YII2_USER_USERNAME_COLUMN')) {
            return YII2_USER_USERNAME_COLUMN;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userClass;
        }
        return 'username';
    }
    
    public function isBackendUser()
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($roles as $role) {
            if (in_array($role->name, $this->backendRoles)) {
                return true;
            }
        }
        return false;
    }
    
    public function isFrontendUser()
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($roles as $role) {
            if (in_array($role->name, $this->frontendRoles)) {
                return true;
            }
        }
        return false;
    }
}
