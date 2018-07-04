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

            // parsage des tweets
    private function linkify_tweet($tweet) {
    $tweet = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="$2">@$2</a>',
        $tweet);
    return preg_replace('/#([^\s]+)/',
        '<a href="search-%23$1">#$1</a>',
        $tweet);
}

    public function addnotifcomm($event, $commentaire) {

        $comm = $this->linkify_tweet($commentaire->comm);

 
    $notif = '<img src="/instatux/img/'.$commentaire->avatar_session.'" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$commentaire->nom_session.'">'.$commentaire->nom_session.'</a> à commenté votre <a href="/instatux/post/'.$commentaire->tweet_id.'">publication.</a>';
   
    $entity = TableRegistry::get('Notifications');

    $article = $entity->newEntity();

    $article->user_name = $commentaire->userosef; // auteur du tweet

    $article->notification = $notif;

    $article->created =  Time::now();

    $article->statut = 0;

    $entity->save($article);   

        

 
}
}

