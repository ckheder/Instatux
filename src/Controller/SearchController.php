<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;


/**
 * Controller Search
 *
 * Moteur de recherche
 *
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
        $this->loadModel('Users');
        $this->loadModel('Tweet');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','redirectsearch','searchusers','hashtag']); // on autorise les gens non identifiés à accéder au moteur de recherche
    }

        /**
     * Méthode Index
     *
     * Recherche les utilisateurs correspondant au mot-clé ainsi que les tweets contenant ce mot-clé
     *
     */

        public function index($search = null)
    {

        $this->viewBuilder()->layout('search');

        $keyword = $this->request->GetParam('string'); // mot-clé pour la recherche

        $this->set('title', ''.$keyword.' - Recherche sur Instatux'); // titre de la page

        // recherche dans les users

             // chargement du modèle Users

            $query_user = $this->Users->find()->select([
                                                        'Users.username',
                                                        'Users.description',
                                                        ])
                                            ->where(['Users.username LIKE '  => ''.$keyword.'%']);

            $nb_resultat_users = $query_user->count(); // décompte du nombre de résultat

            $this->set('nb_resultat_users', $nb_resultat_users);

            $this->set('resultat_users',$query_user);

        // recherche dans les tweet

            $query_tweet = $this->Tweet->find()->select([
                                                            'Users.username',
                                                            'Users.description',
                                                            'Tweet.id',
                                                            'Tweet.id_tweet',
                                                            'Tweet.user_id',
                                                            'Tweet.contenu_tweet',
                                                            'Tweet.created',
                                                            'Tweet.nb_commentaire',
                                                            'Tweet.nb_partage',
                                                            'Tweet.nb_like',
                                                            'Tweet.allow_comment',
                                                        ])
                                                ->where(["MATCH(Tweet.contenu_tweet) AGAINST(:search)"])
                                                ->orWhere(['Tweet.user_id = :search'])
                                                ->where(['Tweet.share' => 0]) // on ne cherche que les tweets non partagés
                                                ->where(['private' => 0]) // on ne cherche que les tweets publics
                                                ->bind(':search',$keyword)
                                                ->contain(['Users']);

            $nb_resultat_tweet = $query_tweet->count(); // décompte du nombre de résultat

            $this->set('nb_resultat_tweet', $nb_resultat_tweet);

            $this->set('resultat_tweet', $this->paginate($query_tweet, ['limit' => 8]));

            $this->set('search',$keyword); // on renvoi la requete

    }
            /**
     * Méthode hashtag
     *
     * Recherche les tweets contenant le #$keyword
     *
     */

        public function hashtag($search = null)
    {

        $this->viewBuilder()->layout('search');

        $keyword = $this->request->GetParam('string');

        $this->set('title', 'Hashtag #'.$keyword.''); // titre de la page

            $query_tweet = $this->Tweet->find()->select([
                                                            'Users.username',
                                                            'Tweet.id',
                                                            'Tweet.user_id',
                                                            'Tweet.contenu_tweet',
                                                            'Tweet.created',
                                                            'Tweet.nb_commentaire',
                                                            'Tweet.nb_partage',
                                                            'Tweet.nb_like',
                                                            'Tweet.allow_comment',
                                                        ])
                                                ->where(["MATCH(Tweet.contenu_tweet) AGAINST(:search)"])
                                                ->where(['Tweet.share' => 0]) // on ne cherche que les tweets non partagés
                                                ->where(['private' => 0]) // on ne cherche que les tweets publics
                                                ->bind(':search','%23'.$keyword.'')
                                                ->contain(['Users']);

        $nb_resultat_tweet = $query_tweet->count(); // décompte du nombre de résultat

        $this->set('nb_resultat_tweet', $nb_resultat_tweet);

        $this->set('resultat_tweet', $this->paginate($query_tweet, ['limit' => 8]));

        $this->set('search',$keyword); // on renvoi la requete
    }

                /**
     * Méthode searchusers
     *
     * Suggestion de nom d'utilisateur pour l'auto-complétion du moteur de recherche
     *
     */

    public function searchusers()
    {
         if ($this->request->is('ajax'))
        {
            
            $this->autoRender = false;
            $name = $this->request->query('term'); //terme tapé dans le moteur de recherche

                    $query_user = $this->Users->find()->select(['username'])
                                                    ->where(['username LIKE '  => ''.$name.'%']);

            foreach($query_user as $result)
            {

               $resultUsers[] =  array(
                                        'value' => $result->username
                                        );
            }
            echo json_encode($resultUsers); // retourne le résultat en JSON
        }
        // accès à la page hors d'une requête Ajax
            else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

                /**
     * Méthode redirectsearch
     *
     * Redirection vers la page de résultat du moteur de recherche : action du formulaire
     *
     */
    public function redirectsearch()
    {
            if(!empty($this->request->data['search']))
        {
            $keyword = $this->request->data['search'];

            $search = str_replace('#', '%23', $keyword);

        return $this->redirect('/search-'.$search.'');
        }
    }

}
