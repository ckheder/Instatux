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



 
    $notif = '<img src="/instatux/img/avatar/'.$commentaire->nom_session.'.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$commentaire->nom_session.'">'.$commentaire->nom_session.'</a> à commenté votre <a href="/instatux/post/'.$commentaire->tweet_id.'" data-toggle="modal" data-target="#viewtweet" data-remote="false">publication.</a>';
   
    $entity = TableRegistry::get('Notifications');

    $article = $entity->newEntity();

    $article->user_name = $commentaire->auttweet; // auteur du tweet

    $article->notification = $notif;

    $article->created =  Time::now();

    $article->statut = 0;

    $entity->save($article);   

        

 
}
}

