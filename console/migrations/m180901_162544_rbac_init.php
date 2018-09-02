<?php

use yii\db\Migration;

/**
 * Class m180901_162544_rbac_init
 */
class m180901_162544_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

     
        
        $readJournals = $auth->createPermission('readJournals');
        $readJournals->description = 'Read Journals';
        $auth->add($readJournals); 
        
        $apiread = $auth->createPermission('apiread');
        $apiread->description = 'Read api permission';
        $auth->add($apiread);
        
        $editJournals = $auth->createPermission('editJournals');
        $editJournals->description = 'Edit Journals';
        $auth->add($editJournals);        
        
        $apiupdate = $auth->createPermission('apiupdate');
        $apiupdate->description = 'Update over api permission';
        $auth->add($apiupdate);
       
        $manageJournals = $auth->createPermission('manageJournals');
        $manageJournals->description = 'Manage Journals';
        $auth->add($manageJournals);
        
        $apidelete = $auth->createPermission('apidelete');
        $apidelete->description = 'Delete over api permission';
        $auth->add($apidelete);
 
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage users';
        $auth->add($manageUsers);    
        
        
        
        
        
        $guest = $auth->createRole('guest');
        $guest->description = 'All guests or visitors or bots';
        $auth->add($guest);            
        
        $user = $auth->createRole('user');
        $user->description = 'Registered Users';
        $auth->add($user);          
        $auth->addChild($user, $guest);
        $auth->addChild($user, $readJournals);
        
        $api = $auth->createRole('api');
        $api->description = 'Have read access to API ';
        $auth->add($api);        
        $auth->addChild($api, $user);
        $auth->addChild($api, $apiread);
        
        $author = $auth->createRole('author');
        $author->description = 'Author';
        $auth->add($author);
        $auth->addChild($author, $api);
        $auth->addChild($author, $editJournals);
        
        $apiu = $auth->createRole('apiu');
        $apiu->description = 'Have update access to API ';
        $auth->add($apiu);
        $auth->addChild($apiu, $author);
        $auth->addChild($apiu, $apiupdate);
        
        $moderator = $auth->createRole('moderator');
        $moderator->description = 'Moderator';
        $auth->add($moderator);
        $auth->addChild($moderator, $apiu);
        $auth->addChild($moderator, $manageJournals);
        
        $apid = $auth->createRole('apid');
        $apid->description = 'Have delete access to API ';
        $auth->add($apid);
        $auth->addChild($apid, $moderator);
        $auth->addChild($apid, $apidelete);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $apid);
        $auth->addChild($admin, $manageUsers);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->authManager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180901_162544_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
