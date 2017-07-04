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
            'Model.Tweet.afterAdd' => 'hashtag',
        );
    }



    public function hashtag($event, $contenu_tweet) {

    // extraction des hashtag

    function getHashtags($string) {  
    $hashtags= FALSE;  
    preg_match_all("/(#\w+)/u", $string, $matches);  
    if ($matches) {
        $hashtagsArray = array_count_values($matches[0]);
        $hashtags = array_keys($hashtagsArray);
    }
    return $hashtags;
}

$array_hash = getHashtags($contenu_tweet);

$table_hashtag= TableRegistry::get('Hashtag');
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
}
}