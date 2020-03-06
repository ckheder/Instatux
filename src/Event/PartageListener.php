<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Listener PartageListener
 *
 * Création de notification de partage et mise à jour de la table Partage
 *
 */

class PartageListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Partage.afterAdd' => 'addnotifpartage',
        );
    }

/**
     * Méthode addnotifpartage
     *
     * Ajout d'une notification de partage et mise à jour de la table Partage
     *
     * Paramètres : $tweet -> tableau contenant le nom de la persone qui vient de partager, l'id du tweet qui vient d'être partagé et si l'auteur du tweet accepte ou non les notifications de partage
     *
*/

    public function addnotifpartage($event, $tweet, $id_tweet) {

                if($tweet->notif == "oui")
            {

                // création d'une notification de partage de tweet uniquement si accepter

                $notif = '<img src="/instatux/img/avatar/'.$tweet->user_timeline.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$tweet->user_timeline.'">'.$tweet->user_timeline.'</a> à partagé votre <a href="" data-idtweet="'.$id_tweet.'" data-toggle="modal" data-target="#viewtweet" data-remote="false">post</a>.';



                $entity = TableRegistry::get('Notifications');

                $notif_partage = $entity->newEntity();

                $notif_partage->username = $tweet->user_id; // auteur du tweet

                $notif_partage->notification = $notif;

                $notif_partage->created =  Time::now();

                $notif_partage->statut = 0;

                $entity->save($notif_partage);
            }

                // mise à jour de la table partage

                $entity_partage = TableRegistry::get('Partage');

                $new_partage = $entity_partage->newEntity();

                $new_partage->sharer = $tweet->user_timeline; // nom partageur

                $new_partage->tweet_partage = $tweet->id;

                $entity_partage->save($new_partage);

    }
}
