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

        
    // création d'une notification de nouveau message
 
    $notif = '<img src="/instatux/img/'.$message->avatar_session.'" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/'.$message->nom_session.'">'.$message->nom_session.'</a> vous à envoyé un <a href="/instatux/conversation-'.$message->conv.'">message</a> !';
   
    $entity = TableRegistry::get('Notifications');

    $notif_msg = $entity->newEntity();

    $notif_msg->user_name = $message->destinataire; // auteur du tweet

    $notif_msg->notification = $notif;

    $notif_msg->created =  Time::now();

    $notif_msg->statut = 0;

    $entity->save($notif_msg);

    // mise à jour si conv masqué, réaffichage

    $table_conv = TableRegistry::get('Conversation');

       $query = $table_conv->query()
                            ->update()
                            ->set(['statut' => 1])
                            ->where(['participant1' => $message->user_id, 'participant2' => $message->destinataire ])
                            ->orWhere(['participant2' => $message->user_id, 'participant1' => $message->destinataire])
                            ->execute();
    

     // création d'une nouvelle entité conversation si besoin

    if($message->new_conv === 0)
    {     
     $new_conv = $table_conv->newEntity();

     $new_conv->conv =  $message->conv;

     $new_conv->participant1 = $message->user_id;

     $new_conv->participant2 = $message->destinataire;

     $new_conv->statut = 1;

     $table_conv->save($new_conv);  

        $new_conv = $table_conv->newEntity();

     $new_conv->conv =  $message->conv;

     $new_conv->participant1 = $message->destinataire;

     $new_conv->participant2 = $message->user_id;

     $new_conv->statut = 1;

     $table_conv->save($new_conv);                    
    }
}
}

