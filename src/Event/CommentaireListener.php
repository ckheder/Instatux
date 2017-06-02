<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CommentaireListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Commentaires.afterAdd' => 'addnotifcomm',
        );
    }

    public function addnotifcomm($event, $commentaire) {

        
        $comme = mb_strimwidth($commentaire->comm, 0, 30, "...");
 
    $notif = '<img src="/instatux/img/'.$commentaire->avatar_session.'" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/'.$commentaire->nom_session.'">'.$commentaire->nom_session.'</a> à commenté votre <a href="/instatux/post/'.$commentaire->tweet_id.'">publication</a><br /><br />'.$comme.'';
   
    $entity = TableRegistry::get('Notifications');

    $article = $entity->newEntity();

    $article->user_id = $commentaire->userosef; // auteur du tweet

    $article->notification = $notif;

    $article->created =  Time::now();

    $article->statut = 0;

    $entity->save($article);   

 
}
}

