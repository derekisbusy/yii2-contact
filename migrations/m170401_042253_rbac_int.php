<?php

use yii\db\Migration;
use derekisbusy\contact\BaseModule as Module;

class m170401_042253_rbac_int extends Migration
{
    public function safeUp()
    {
        
        $auth = Yii::$app->authManager;
        
        $manageOwnContacts = $auth->createPermission(Module::PERM_MANAGE_OWN);
        $manageOwnContacts->description = 'Manage own contacts';
        $auth->add($manageOwnContacts);
        
        $manageAssignedContacts = $auth->createPermission(Module::PERM_MANAGE_ASSIGNED);
        $manageAssignedContacts->description = 'Manage contacts assigned to them';
        $auth->add($manageAssignedContacts);
        
        $manageContacts = $auth->createPermission(Module::PERM_MANAGE);
        $manageContacts->description = 'Manage all contacts';
        $auth->add($manageContacts);
        

        $user = $auth->createRole(Module::ROLE_USER);
        $user->description = 'User can manage contacts that they created.';
        $auth->add($user);
        $auth->addChild($user, $manageOwnContacts);
           
        $moderator = $auth->createRole(Module::ROLE_MODERATOR);
        $moderator->description = 'User can manage contacts that are assigned to them.';
        $auth->add($moderator);
        $auth->addChild($moderator, $manageAssignedContacts);
        
        $admin = $auth->createRole(Module::ROLE_ADMIN);
        $admin->description = 'User can adminstrate all contacts.';
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $manageContacts);
    }

    public function safeDown()
    {
        
        $auth = Yii::$app->authManager;
        
        $auth->remove(Module::PERM_MANAGE_OWN);
        $auth->remove(Module::PERM_MANAGE_ASSIGNED);
        $auth->remove(Module::PERM_MANAGE);
        $auth->remove(Module::ROLE_USER);
        $auth->remove(Module::ROLE_MODERATOR);
        $auth->remove(Module::ROLE_ADMIN);
    }
}
