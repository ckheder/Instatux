<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Listener MessageListener
 *
 * Création de notification de nouveau message et création d 2 entités de conversation si besoin
 *
 */


class MessageListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Messagerie.afterAdd' => 'addnotifmsg',
        );
    }

/**
     * Méthode addnotifmsg
     *
     * Ajout d'une notification de nouveau message et création d 2 entités de conversation si besoin
     *
     * Paramètres : $message -> tableau contenant le nom de la persone qui vient de commenter et le nom de l'auteur du tweet
     *
*/

    public function addnotifmsg($event, $message, $notif, $statut) {

        $entity = TableRegistry::get('Notifications');

        $table_conv = TableRegistry::get('Conversation');


            if($notif == 'oui')
        {    

            // création d'une notification de nouveau message dans une conversation en duo

            $notif = '<img src="/instatux/img/avatar/'.$message->user_id.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$message->user_id.'">'.$message->user_id.'</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "'.$message->conv.'">message.</a>';
        

            $notif_msg = $entity->newEntity();

            $notif_msg->username = $message->destinataire;

            $notif_msg->notification = $notif;

            $notif_msg->created =  Time::now();

            $notif_msg->statut = 0;

            $entity->save($notif_msg);

        }
        


            // création d'une nouvelle entité conversation si besoin pour les deux participants

            if($message->new_conv == 0)
        {

            
            // participant 1

            $new_conv = $table_conv->newEntity();

            $new_conv->conv =  $message->conv;

            $new_conv->user_conv = $message->user_id;

            $new_conv->type_conv = 'duo';

            $new_conv->statut = 0;

            $table_conv->save($new_conv);

            // participant 2

            $new_conv = $table_conv->newEntity();

            $new_conv->conv =  $message->conv;

            $new_conv->user_conv = $message->destinataire;

            $new_conv->type_conv = 'duo';

            $new_conv->statut = 0;

            $table_conv->save($new_conv);
        }

        //activation conversation si envoi d'un message vers une conversation supprimée

            if($statut)
        {
            $query = $table_conv->query()
                                ->update()
                                ->set(['statut' => 0])
                                ->where(['conv' => $message->conv])
                                ->where(['user_conv' => $message->user_id])
                                ->execute();
        }
    }
}
