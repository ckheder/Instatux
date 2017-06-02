<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class NotificationupdateListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'View.afterRender.indexnotif' => 'updatenotif',
        );
    }

    public function updatenotif($event, $authuser) {

   
    $entity = TableRegistry::get('Notifications');

    $query = $entity->updateAll(
        ['statut' => 1], // champs
        ['statut' => 0, 'user_id' => $authuser ]); // conditions 

 
}
}