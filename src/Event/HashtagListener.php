<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Database\Expression\QueryExpression;


class HashtagListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Tweet.afterAdd' => 'hashtag_username',
        );
    }

    // fonction qui va chercher les différends hashtag dans un post et remplir la base de données puis si on a tweeté sur un autre mur, envoyer une notification avec contrôle si la personne accepte les notifications

    public function hashtag_username($event, $tweet) {

        $entity = TableRegistry::get('Notifications');

    // extraction des hashtag

    function getHashtags($string) 
    {  
    $hashtags= FALSE;  
    preg_match_all("/(#\w+)/u", $string, $matches);  
    if ($matches) {
        $hashtagsArray = array_count_values($matches[0]);
        $hashtags = array_keys($hashtagsArray);
    }
    return $hashtags;
    }

$array_hash = getHashtags($tweet->contenu_tweet);

$table_hashtag = TableRegistry::get('Hashtag');

    // vérification de l'existence de hashtag

    foreach ($array_hash as $hashtag):
   
    $hashtag = str_replace('#', '', $hashtag);

    $query = $table_hashtag->find()
                            ->select(['tag'])
                            ->where(['tag' => $hashtag ]);

    if(!$query->isEmpty()) // si il existe on incrémente de 1
    {

    $expression = new QueryExpression('nb_tag = nb_tag + 1');
    $query_update = $table_hashtag->updateAll([$expression], ['tag' => $hashtag]);


    }
    else // on crée une nouvelle entité
    {
        $new_hashtag = $table_hashtag->newEntity();

        $new_hashtag->tag = $hashtag;
        $new_hashtag->nb_tag = 1;

        $table_hashtag->save($new_hashtag);
    }
    

 endforeach;
   
// envoi d'une notification a chaque personne cité dans un tweet

    // extraction des username

    function getUsernames($string) {  
    $at_username = FALSE;  
    preg_match_all("/(^|[^@\w])@(\w{1,15})\b/", $string, $matches);  
    if ($matches) {
        $atusernameArray = array_count_values($matches[0]);
        $at_username = array_keys($atusernameArray);
    }
    return $at_username;
}

$array_username = getUsernames($tweet->contenu_tweet);

    foreach ($array_username as $at_username):

        $username = str_replace('>@', '', $at_username);

        if($username != $tweet->auth_name)

{

     if($this->testnotifcite($username) == "oui")
                {
    

         $notif = '<img src="/instatux/img/'.$tweet->avatar_session.'" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/'.$tweet->user_id.'">'.$tweet->user_id.'</a> à vous à cité dans un <a href="/instatux/post/'.$tweet->id.'">tweet</a>';
   

    $article = $entity->newEntity();

    $article->user_name = $username; 

    $article->notification = $notif;

    $article->created =  Time::now();

    $article->statut = 0;

    $entity->save($article); 
}
}
 endforeach;

}

private function testnotifcite($username)
{
$table_settings = TableRegistry::get('Settings');


    $query = $table_settings->find()
                            ->select(['notif_cite'])
                            ->where(['user_id' => $username ]);

            foreach ($query as $verif_notif) // recupération de la conversation
                {
                $settings_notif = $verif_notif['notif_cite'];
                }

             return $settings_notif;
}
}