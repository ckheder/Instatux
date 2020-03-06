<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Utility\Text;

/**
 * Listener CommentaireListener
 *
 * Création de notification de commentaire
 *
 */

class CommentaireListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Commentaires.afterAdd' => 'addnotifcomm',
        );
    }

/**
     * Méthode addnotifcomm
     *
     * Ajout d'une notification de commentaire
     *
     * Paramètres : $commentaire -> tableau contenant le nom de la persone qui vient de commenter et le nom de l'auteur du tweet
     *
*/

        public function addnotifcomm($event, $commentaire)
    {

        $notif = '<img src="/instatux/img/avatar/'.$commentaire->nom_session.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$commentaire->nom_session.'">'.$commentaire->nom_session.'</a> à commenté votre <a href="" data-idtweet="'.$commentaire->tweet_id.'" data-toggle="modal" data-target="#viewtweet" data-remote="false">publication.</a>';

        $entity = TableRegistry::get('Notifications');

        $notif_comm = $entity->newEntity();

        $notif_comm->username = $commentaire->auttweet; // auteur du tweet

        $notif_comm->notification = $notif; // notification

        $notif_comm->created =  Time::now();

        $notif_comm->statut = 0;

        $entity->save($notif_comm);
    }
}
