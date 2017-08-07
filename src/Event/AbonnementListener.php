<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class AbonnementListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Abonnement.afterAdd' => 'addnotifabo',
        );
    }

    public function addnotifabo($event, $abonnement) {

        
    
 
    $notif = '<img src="/instatux/img/'.$abonnement->avatar_session.'" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/'.$abonnement->nom_session.'">'.$abonnement->nom_session.'</a><span class="alias_tweet">@'.$abonnement->nom_session.'</span> s\'est abonné';
   
    $entity = TableRegistry::get('Notifications');

    $notif_abo = $entity->newEntity();

    $notif_abo->user_name = $abonnement->suivi; // auteur du tweet

    $notif_abo->notification = $notif;

    $notif_abo->created =  Time::now();

    $notif_abo->statut = 0;

    $entity->save($notif_abo);   

 
}
}

