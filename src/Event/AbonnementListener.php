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
            'Model.Abonnement.abovalide' => 'notif_abo_valide'
        );
    }
    

    public function addnotifabo($event, $abonnement) {

            $entity = TableRegistry::get('Notifications');

    // abonnement en attente

    if($abonnement->etat == 0)
    {
            $notif = '<img src="/instatux/img/'.$abonnement->avatar_session.'" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$abonnement->nom_session.'">'.$abonnement->nom_session.'</a><span class="alias_tweet">@'.$abonnement->nom_session.'</span> souhaite s\'abonné
            <a href="/instatux/demande">Gérer mes abonnements</a>';

    $notif_abo = $entity->newEntity();

    $notif_abo->user_name = $abonnement->suivi; // auteur du tweet

    $notif_abo->notification = $notif;

    $notif_abo->created =  Time::now();

    $notif_abo->statut = 0;

    $entity->save($notif_abo); 
    }

    else
    {
    $notif = '<img src="/instatux/img/'.$abonnement->avatar_session.'" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$abonnement->nom_session.'">'.$abonnement->nom_session.'</a><span class="alias_tweet">@'.$abonnement->nom_session.'</span> s\'est abonné';

    $notif_abo = $entity->newEntity();

    $notif_abo->user_name = $abonnement->suivi; // auteur du tweet

    $notif_abo->notification = $notif;

    $notif_abo->created =  Time::now();

    $notif_abo->statut = 0;

    $entity->save($notif_abo);   
}
}
// notification de validation de l'abonnement

public function notif_abo_valide($event, $data_event)

{
    $entity = TableRegistry::get('Notifications');

                $notif = '<img src="/instatux/img/'.$data_event['avatar_session'].'" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$data_event['nom_session'].'">'.$data_event['nom_session'].'</a> à accepté votre demande d\'abonnement';

    $notif_abo_valide = $entity->newEntity();

    $notif_abo_valide->user_name = $data_event['destinataire_notif']; // auteur du tweet

    $notif_abo_valide->notification = $notif;

    $notif_abo_valide->created =  Time::now();

    $notif_abo_valide->statut = 0;

    $entity->save($notif_abo_valide); 

 }

}

