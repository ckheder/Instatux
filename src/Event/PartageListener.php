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



    public function addnotifpartage($event, $tweet) {

        
    // création d'une notification de nouveau message
 
    $notif = '<img src="/instatux/img/'.$tweet->avatar_session.'" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/'.$tweet->nom_session.'">'.$tweet->nom_session.'</a> à partagé votre <a href="/instatux/post/'.$tweet->id_tweet.'">post</a> !';
   
    $entity = TableRegistry::get('Notifications');

    $notif_partage = $entity->newEntity();

    $notif_partage->user_name = $tweet->user_id; // auteur du tweet

    $notif_partage->notification = $notif;

    $notif_partage->created =  Time::now();

    $notif_partage->statut = 0;

    $entity->save($notif_partage);

    // mise à jour de la table partage

    $entity_partage = TableRegistry::get('Partage');

    $new_partage = $entity_partage->newEntity();

    $new_partage->tweet_partage = $tweet->id_tweet;

    $entity_partage->save($new_partage);


 
}
}
