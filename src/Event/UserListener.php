<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class UserListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.User.afteradd' => 'addentity',
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
// copie de l'avatar par defaut
$srcfile='/var/www/html/instatux/webroot/img/avatars/default/default.png';
$dstfile='/var/www/html/instatux/webroot/img/avatars/'.$user->username.'.jpg';
copy($srcfile, $dstfile);
chmod($dstfile,0755);
    }

    


}