<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Database\Expression\QueryExpression;
use Cake\Routing\Router;

/**
 * Listener TweetListener
 *
 * Création de notification de citation, mise à jour table média
 *
 */


class TweetListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Tweet.afterAdd' => 'afteradd'
        );
    }

/**
     * Méthode afteradd
     *
     * Extraire les username de mes posts et envoi de notification de citation si accepté pour chacun. Ajout dans la table média si un média par upload est ajouter
     *
     * Paramètres : $tweet -> tableau contenant le nom de la persone qui vient de tweeter si il y'a un nouveau média
     *
*/

    public function afteradd($event, $tweet) {

        // envoi d'une notification a chaque personne cité dans un tweet

        $entity = TableRegistry::get('Notifications');

        // fonction d'extraction des username

            function getUsernames($string)
        {
            $at_username = FALSE;
            preg_match_all("/(^|[^@\w])@(\w{1,15})\b/", $string, $matches);
                if ($matches)
            {
        $atusernameArray = array_count_values($matches[0]);
        $at_username = array_keys($atusernameArray);
            }
                return $at_username;
        }

        $array_username = getUsernames($tweet->contenu_tweet);

        if(count($array_username) != 0) // si le tableau n'est pas vide
    {

        //on parcourt le tableau de résultat et on vérifie pour chaque personne si il accepte les notifications de citation

            foreach ($array_username as $at_username):

                $username = str_replace('>@', '', $at_username);

            if($username != $tweet->user_id)

        {
                if($this->testnotifcite($username) == "oui")
            {

                $notif = '<img src="/instatux/img/avatar/'.$tweet->user_id.'.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/'.$tweet->user_id.'">'.$tweet->user_id.'</a> à vous à cité dans un <a href="" data-idtweet="'.$tweet->id_tweet.'" data-toggle="modal" data-target="#viewtweet" data-remote="false">publication.</a>';

                $notif_cite = $entity->newEntity();

                $notif_cite->username = $username; 

                $notif_cite->notification = $notif;

                $notif_cite->created =  Time::now();

                $notif_cite->statut = 0;

                $entity->save($notif_cite);
            }
        }
            endforeach;
    }

 // ajout dans la table média si nécessaire

                if($tweet->new_media == 1)
            {
    //extraction nom
                $re = '@src="([^"]+)"@';

                preg_match($re, $tweet->contenu_tweet, $match);

                $match = basename($match[1]); // si tro chiant pour faiore la gallerie , utliser url complète donc ne pas utiliser basename

                $entity = TableRegistry::get('Media');

                $new_media = $entity->newEntity();

                $new_media->nom_media = $match;

                $new_media->tweet_media = $tweet->id_tweet;

                $new_media->user_id = $tweet->user_id;

                $new_media->created =  Time::now();

                $entity->save($new_media);
            }

}
/**
     * Méthode testnotifcite
     *
     * Vérifie si le username en paramètre accepte les notifications de citation
     *
     * Paramètres : $username -> nom de la personne
     *
*/
                private function testnotifcite($username)
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
