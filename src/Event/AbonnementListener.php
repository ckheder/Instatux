<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Listener AbonnementListener
 *
 * Création de notifications d'abonnement
 *
 */

class AbonnementListener implements EventListenerInterface {

        public function implementedEvents()
    {
        return array(
            'Model.Abonnement.afterAdd' => 'addnotifabo',
            'Model.Abonnement.abovalide' => 'notif_abo_valide'
                    );
    }

/**
     * Méthode addnotifabo
     *
     * Ajout d'une notification d'abonnement
     *
     * Paramètres : $abonnement -> tableau contenant le nom de la persone souhaitant s'abonner et le nom de celui à qui on veut s'abonner
     *
*/
        public function addnotifabo($event, $abonnement)
    {

            $entity = TableRegistry::get('Notifications');

    // cas  d'une demande d'abonnement -> profil privé

                if($abonnement->etat == 0)
            {

                $notif = '<img src="/instatux/img/avatar/'.$abonnement->user_id.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$abonnement->user_id.'">'.$abonnement->user_id.'</a> souhaite s\'abonné.
                    <a href="/instatux/demande">Gérer mes abonnements</a>';

            }

            // cas  d'un abonnement  à un profil public

                else
            {

                $notif = '<img src="/instatux/img/avatar/'.$abonnement->user_id.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$abonnement->user_id.'">'.$abonnement->user_id.'</a> s\'est abonné.
                <a href="/instatux/abonne/'.$abonnement->suivi.'">Gérer mes abonnements</a>';

            }

                $notif_abo = $entity->newEntity(); // création d'une entité notification

                $notif_abo->username = $abonnement->suivi; // destinataire de la notification

                $notif_abo->notification = $notif; // notification

                $notif_abo->created =  Time::now(); // date de création

                $notif_abo->statut = 0; // statut 0 -> non lue

                $entity->save($notif_abo);  // sauvegarde

    }
/**
     * Méthode notif_abo_valide
     *
     * Ajout d'une notification de validation d'abonnement
     *
     * Paramètres : $data_event -> tableau contenant le nom de la persone qui accepte une demande d'abonnement et le nom de celui à qui on envoi la notification
     *
*/
        public function notif_abo_valide($event, $data_event)

    {
        $entity = TableRegistry::get('Notifications');

                $notif = '<img src="/instatux/img/avatar/'.$data_event['nom_session'].'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$data_event['nom_session'].'">'.$data_event['nom_session'].'</a> à accepté votre demande d\'abonnement';

        $notif_abo_valide = $entity->newEntity();

        $notif_abo_valide->username = $data_event['destinataire_notif']; // auteur du tweet

        $notif_abo_valide->notification = $notif;

        $notif_abo_valide->created =  Time::now();

        $notif_abo_valide->statut = 0;

        $entity->save($notif_abo_valide);

    }

}
