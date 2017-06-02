<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class MessageListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Messagerie.afterAdd' => 'addnotifmsg',
        );
    }

    public function addnotifmsg($event, $message) {

        
    
 
    $notif = '<img src="/instatux/img/'.$message->avatar_session.'" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/'.$message->nom_session.'">'.$message->nom_session.'</a> vous à envoyé un <a href="/instatux/conversation-'.$message->conv.'">message</a> !';
   
    $entity = TableRegistry::get('Notifications');

    $notif_msg = $entity->newEntity();

    $notif_msg->user_id = $message->destinataire; // auteur du tweet

    $notif_msg->notification = $notif;

    $notif_msg->created =  Time::now();

    $notif_msg->statut = 0;

    $entity->save($notif_msg);   

 
}
}

