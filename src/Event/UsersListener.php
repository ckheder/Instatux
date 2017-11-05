<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class UsersListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Users.createentity' => 'createsettings',
        );
    }


}