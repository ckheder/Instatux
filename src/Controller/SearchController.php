<?php
namespace App\Controller;

use App\Controller\AppController;
//use App\Controller\Component\AuthComponent;

/**
 * Tweet Controller
 *
 * @property \App\Model\Table\TweetTable $Tweet
 */
class SearchController extends AppController
{
var $uses = array(); // se passer d'un modèle


    public function search($search = null)
    {
        $this->viewBuilder()->layout('profil');
        $this->set('title', 'Résultat de recherche'); // titre de la page

        

// recherche dans les tweets

        $search = $this->request->data['search'];

 $this->loadModel('Tweet');


$query_tweet = $this->Tweet->find()
    ->where([
        "MATCH(Tweet.contenu_tweet) AGAINST(:search)" 
    ])
    ->bind(':search', $search);
    $query_tweet->contain(['Users']);



            if ($query_tweet->isEmpty()) 
        {
   $this->set('resultat_tweet',0);
}
else
{
	$this->set('resultat_tweet',$query_tweet);

}

 // recherche dans les users

  

 $this->loadModel('Users');

$query_user = $this->Users->find()
    ->where([
        "MATCH(Users.username) AGAINST(:search)" 
    ])
    ->bind(':search', $search);



            if ($query_user->isEmpty()) 
        {
   $this->set('resultat_users',0);
}
else
{
    $this->set('resultat_users',$query_user);
    
}  
$this->set('search',$search); // on renvoi la requete   
    }


}