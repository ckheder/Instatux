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

            public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','redirectsearch']); // on autorise les gens non identifiés à accéder au moteur de recherche
    }


    public function index($search = null)
    {


        $this->viewBuilder()->layout('profil');

        $this->set('title', 'Résultat de recherche'); // titre de la page
      
        $keyword = $this->request->GetParam('string');

        $search = str_replace('#', '%23', $keyword);// on remplace le dièse par le truc qui marche

// recherche dans les tweets

 $this->loadModel('Tweet');


$query_tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
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
    ->where(['private' => 0]) // on ne cherche que les tweets publics
    ->bind(':search',$search)
    ->order(['Tweet.created' => 'DESC'])
    ->contain(['Users']);



	$this->set('resultat_tweet', $this->Paginator->paginate($query_tweet, ['limit' => 8]));

 // recherche dans les users
   $this->loadModel('Users');
$query_user = $this->Users->find()
                            ->where([
        "MATCH(Users.username) AGAINST(:search)" 
    ])
                            ->bind(':search', $search);


    $this->set('resultat_users',$query_user);
    

$this->set('search',$search); // on renvoi la requete   
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