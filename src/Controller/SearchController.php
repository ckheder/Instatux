<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
//use App\Controller\Component\AuthComponent;

/**
 * Tweet Controller
 *
 * @property \App\Model\Table\TweetTable $Tweet
 */
class SearchController extends AppController
{
var $uses = array(); // se passer d'un modèle

        public $paginate = [
        'limit' => 8,
        
    ];

    public $components = array('RequestHandler');

            public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','redirectsearch','searchusers']); // on autorise les gens non identifiés à accéder au moteur de recherche

    }


    public function index($search = null)
    {

        $this->viewBuilder()->layout('search');

        $this->set('title', 'Résultat de recherche'); // titre de la page
      
        $keyword = $this->request->GetParam('string');

        $search = str_replace('#', '%23', $keyword);// on remplace le dièse par le truc qui marche

// recherche dans les tweets

 $this->loadModel('Tweet');


$query_tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
            'Users.description',
            'Tweet.id',
            'Tweet.user_id',
            'Tweet.contenu_tweet',
            'Tweet.created',
            'Tweet.nb_commentaire',
            'Tweet.nb_partage',
            'Tweet.nb_like',
            'Tweet.allow_comment',
            ])
    ->where([
        "MATCH(Tweet.contenu_tweet) AGAINST(:search)" 
    ])
    ->orWhere(['Tweet.user_id = :search'])
    ->where(['Tweet.share' => 0]) // on ne cherche que les tweets non partagés
    ->where(['private' => 0]) // on ne cherche que les tweets publics
    ->bind(':search',$search)
    ->contain(['Users']);

$nb_resultat_tweet = $query_tweet->count(); // décompte du nombre de résultat

$this->set('nb_resultat_tweet', $nb_resultat_tweet);

$this->set('resultat_tweet', $this->paginate($query_tweet, ['limit' => 8]));
        
$this->set('search',$search); // on renvoi la requete 

         // recherche dans les users
   $this->loadModel('Users');
$query_user = $this->Users->find()->select([
            'Users.username',
            'Users.avatarprofil',
            'Users.description',
            ])
                            ->where([
        "MATCH(Users.username) AGAINST(:search)" 
    ])
                            ->bind(':search', $search);

$nb_resultat_users = $query_user->count(); // décompte du nombre de résultat

$this->set('nb_resultat_users', $nb_resultat_users);

    $this->set('resultat_users',$query_user);

        // recherche dans les hashtag
       $this->loadModel('Hashtag');
$query_hash = $this->Hashtag->find()
                            ->where([
        "MATCH(Hashtag.tag) AGAINST(:search)" 
    ])
                            ->bind(':search', $search);

$nb_resultat_hashtag = $query_hash->count(); // décompte du nombre de résultat

$this->set('nb_resultat_hashtag', $nb_resultat_hashtag);

    $this->set('resultat_hash',$query_hash);

    }

    public function searchusers() // utilisé pour la suggestion de recherche
    {

         if ($this->request->is('ajax')) {
         // recherche dans les users
   $this->loadModel('Users');
   $this->autoRender = false;            
            $name = $this->request->query('term');
$query_user = $this->Users->find()->select(['username','avatarprofil'])
                            
                           ->where(['username LIKE '  => ''.$name.'%']);


            foreach($query_user as $result) 
            {


               $resultUsers[] =  array(
                
                    
                    'value' => $result->username,
                    'avatar' => $result->avatarprofil
                    );
                
               
            }
            echo json_encode($resultUsers);
    }

}

public function redirectsearch()//redirection formulaire
{
    if(!empty($this->request->data['search']))
    {

        $keyword = $this->request->data['search'];

        $search = str_replace('#', '%23', $keyword);

        return $this->redirect('/search-'.$search.'');
    }
}

}