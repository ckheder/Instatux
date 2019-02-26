<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Database\Expression\QueryExpression;
use Cake\Routing\Router;


class TweetListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Tweet.afterAdd' => 'afteradd' // envoi de notifications de citation si nécessaire, ajout dans la table média si média envoyé
        );
    }

    // fonction qui va chercher les différends hashtag dans un post et remplir la base de données puis si on a tweeté sur un autre mur, envoyer une notification avec contrôle si la personne accepte les notifications

    public function afteradd($event, $tweet) {

// envoi d'une notification a chaque personne cité dans un tweet

        $entity = TableRegistry::get('Notifications');

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
    

         $notif = '<img src="/instatux/img/avatar/'.$tweet->user_id.'.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/'.$tweet->user_id.'">'.$tweet->user_id.'</a> à vous à cité dans un <a href="/instatux/post/'.$tweet->id_tweet.'">tweet</a>';
   

    $article = $entity->newEntity();

    $article->user_name = $username; 

    $article->notification = $notif;

    $article->created =  Time::now();

    $article->statut = 0;

    $entity->save($article); 
}
}
 endforeach;
 // fin envoi d'une notification a chaque personne cité dans un tweet

 // ajout dans la table média si nécessaire

 if($tweet->new_media == 1)
 {
    //extraction nom
    $re = '@src="([^"]+)"@';

preg_match($re, $tweet->contenu_tweet, $match);

//dd($match);

$match = basename($match[1]); // si tro chiant pour faiore la gallerie , utliser url complète donc ne pas utiliser basename
    //fin extraction nom
    $entity = TableRegistry::get('Media');

    $new_media = $entity->newEntity();

    $new_media->nom_media = $match;

    $new_media->tweet_media = $tweet->id_tweet;

    $new_media->user_id = $tweet->user_id;

    $new_media->created =  Time::now();

    $entity->save($new_media);
 }

}

private function testnotifcite($username) //on vérifie si les personnes acceptent les notifis de citation
{
$table_settings = TableRegistry::get('Settings');


    $query = $table_settings->find()
                            ->select(['notif_cite'])
                            ->where(['user_id' => $username ]);

            foreach ($query as $verif_notif)
                {
                $settings_notif = $verif_notif['notif_cite'];
                }

             return $settings_notif;
}

}