<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class PartageListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Partage.afterAdd' => 'addnotifpartage',
        );
    }

    public function addnotifpartage($event, $partage) {

        
    // création d'une notification de nouveau message
 
    $notif = '<img src="/instatux/img/'.$partage->avatar_session.'" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/'.$partage->nom_session.'">'.$partage->nom_session.'</a> à partagé votre <a href="/instatux/post/'.$partage->tweet_partage.'">post</a> !';
   
    $entity = TableRegistry::get('Notifications');

    $notif_partage = $entity->newEntity();

    $notif_partage->user_id = $partage->auteur; // auteur du tweet

    $notif_partage->notification = $notif;

    $notif_partage->created =  Time::now();

    $notif_partage->statut = 0;

    $entity->save($notif_partage);
 
}
}
