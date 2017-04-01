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
    
    public $db = 'db';
    public $userClass = 'app\models\User';
    public $userTableIdColumn = 'id';
    
    
    public static abstract function getModuleId();
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
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
    
    public static function getUserModelIdName()
    {
        if (defined('YII2_USER_ID_COLUMN')) {
            return YII2_USER_ID_COLUMN;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userClass;
        }
        return 'id';
    }
    
    public static function getUserTableName()
    {
        return call_user_func(self::getUserClassname().'::tableName');
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
