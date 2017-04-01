<?php

namespace derekisbusy\contact;

use Yii;


/**
 * Base module for frontend and backend modules.
 */
abstract class BaseModule extends \yii\base\Module
{
    
    const MODEL_CONTACT = 1;
    const MODEL_CONTACT_NOTIFY = 2;
    const MODEL_CONTACT_NOTIFY_QUERY = 3;
    const MODEL_CONTACT_NOTIFY_SEARCH = 4;
    const MODEL_CONTACT_QUERY = 5;
    const MODEL_CONTACT_REASON = 6;
    const MODEL_CONTACT_REASON_QUERY = 7;
    const MODEL_CONTACT_REASON_SEARCH = 8;
    const MODEL_CONTACT_SEARCH = 9;
    
    const USER_CLASS = 1;
    const USER_ID = 2;
    const USER_USERNAME = 3;
    
    const PERM_MANAGE = 'manageContacts';
    const PERM_MANAGE_OWN = 'manageOwnContacts';
    const PERM_MANAGE_ASSIGNED = 'manageAssignedContacts';
    
    const ROLE_USER = 'contactUser';
    const ROLE_MODERATOR = 'contactModerator';
    const ROLE_ADMIN = 'contactAdmin';
    
    /**
     * The key for the database component of the app.
     * @var string
     */
    public $db = 'db';
    /**
     * Set to `true` to turn on RBAC
     * @var type 
     */
    public $rbac = false;
    /**
     * Model settings for the module.
     * @var array
     */
    public $modelSettings = [];
    /**
     * Settings for integration with user table.
     * @var array 
     */
    public $userSettings = [];
    /**
     * An array of usernames that can access and manage all contacts
     * and contact settings.
     * @var array 
     */
    public $adminSettings = [];
    /**
     * An array of usernames that can access and manage all contacts
     * assigned to them.
     * @var array
     */
    public $moderatorSettings = [];
    
    
    
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
        
        $this->userSettings = array_merge([
            self::USER_CLASS => 'app\models\User',
            self::USER_ID => 'id',
            self::USER_USERNAME => 'username'
        ],$this->userSettings);
    }
    
    public static function getUserClassname()
    {
        if (defined('YII2_USER_CLASSNAME')) {
            return YII2_USER_CLASSNAME;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userSettings[self::USER_CLASS];
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
            return Yii::$app->getModule(self::getModuleId())->userSettings[self::USER_ID];
        }
        return 'id';
    }
    
    public static function getUsernameColumnName()
    {
        
        if (defined('YII2_USER_USERNAME_COLUMN')) {
            return YII2_USER_USERNAME_COLUMN;
        }
        if (Yii::$app) {
            return Yii::$app->getModule(self::getModuleId())->userSettings[self::USER_USERNAME];
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
