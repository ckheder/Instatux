<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class SettingsListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Settings.afterPrivate' => 'updatetweetprivate',
            'Model.Settings.afterPublic' => 'updatetweetpublic',
        );
    }

    public function updatetweetprivate($event, $authname) {

   
    $entity = TableRegistry::get('Tweet');

    $query = $entity->updateAll(
        ['private' => 1], // champs
        ['user_id' => $authname ]); // conditions 

 
}
    public function updatetweetpublic($event, $authname) {

   
    $entity = TableRegistry::get('Tweet');

    $query = $entity->updateAll(
        ['private' => 0], // champs
        ['user_id' => $authname ]); // conditions 

 
}
}