<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class UserListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.User.afteradd' => 'addentity',
            'Model.User.afterdelete' => 'deleteaccount',
        );
    }

        public function addentity($event, $user) // création de la ligne Settings pour un utilisateur nouvellement enregistré
    {

    $entity = TableRegistry::get('Settings');

    $query = $entity->query();
$query->insert(['user_id'])
    ->values([
        'user_id' => $user->username
    ])
    ->execute();
    //creation du dossier utilisateur

        $dir = new Folder('/var/www/html/instatux/webroot/img/media/'.$user->username.'', true, 0755);

// copie de l'avatar par defaut
        $srcfile='/var/www/html/instatux/webroot/img/default.png';
        $dstfile='/var/www/html/instatux/webroot/img/avatar/'.$user->username.'.jpg';
        copy($srcfile, $dstfile);
        
// copie du background

             $srcfile='/var/www/html/instatux/webroot/img/default_background.jpg';
        $dstfile='/var/www/html/instatux/webroot/img/media/'.$user->username.'/cover_'.$user->username.'.jpg';
        copy($srcfile, $dstfile);   

    }

    public function deleteaccount($event, $user) // suppression des informations utilisateurs
    {

        // suppression avatar

        $avatar = new File(WWW_ROOT.'img/avatar/'.$user->username.'.jpg');
        $avatar->delete();

        // suprresioon dossier media

        $dir = new Folder('img/media/'.$user->username.'');
        $dir->delete();

         // suppression des tweets postés et des partages
        $tweet = TableRegistry::get('Tweet');
                     
            $conditionsuser = array(
        'OR' => array(
        'user_id' => $user->username,
        'user_timeline' => $user->username
    )
);

$tweet->deleteAll($conditionsuser);

        // suppression de la ligne settings

$settings = TableRegistry::get('Settings');
            $query = $settings->query();
          $query->delete()
   ->where(['user_id' => $user->username])
   ->execute();

    // suppression des abonnements

 $abonnement = TableRegistry::get('Abonnement');

    $conditionabo = array(
    'OR' => array(
        'user_id' => $user->username,
        'suivi' => $user->username
    )
);
$abonnement->deleteAll($conditionabo);

    // suppression notification

$notification = TableRegistry::get('Notifications');

$notification->deleteAll(['user_name' => $user->username]);

    // suppression conversation

$conversation = TableRegistry::get('Conversation');

      $conditionconv = array(
    'OR' => array(
        'participant1' => $user->username,
        'participant2' => $user->username
    )
);
$conversation->deleteAll($conditionconv);

// suppression like

$aime = TableRegistry::get('Aime');

$aime->deleteAll(['username' => $user->username]);
    }
}