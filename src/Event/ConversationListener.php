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


class ConversationListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Conversation.invit' => 'addnotifinvitconv',
        );
    }

/**
     * Méthode addnotifinvitconv
     *
     * Ajout d'une notification d'invitation à rejoindre une conversation
     *
     * Paramètres : $invit -> tableau contenant le nom de la persone à inviter et la conversation correspondante
     *
*/

    public function addnotifinvitconv($event, $invit) {


            $notif = '<img src="/instatux/img/avatar/'.$invit['sender'].'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$invit['sender'].'" >'.$invit['sender'].'</a> vous à invité à rejoindre une conversation : <a href="#" class="joinconv" data-idconv = "'.$invit['conv'].'">Rejoindre</a>';

            $entity = TableRegistry::get('Notifications');

            $notif_conv = $entity->newEntity();

            $notif_conv->username = $invit['user'];

            $notif_conv->notification = $notif;

            $notif_conv->created =  Time::now();

            $notif_conv->statut = 0;

            $entity->save($notif_conv);
        
    }
}
