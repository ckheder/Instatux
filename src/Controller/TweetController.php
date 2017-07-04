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
class TweetController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('tweet');
        $this->set('title', ''.$this->request->getParam('username').' | Instatux'); // titre de la page

        $username = $this->request->getParam('username');

        $tweet = $this->Tweet->find()->select([
            'Users.id',
            'Users.username',
            'Users.avatarprofil',
            'Tweet.id',
            'Tweet.user_id',
            'Tweet.contenu_tweet',
            'Tweet.created',
            'Tweet.partage',
            'Tweet.nb_commentaire',
            'Tweet.nb_partage',
            ])
         // titre de la page
        ->where(['Tweet.user_timeline' => $username])
        ->order(['Tweet.created' => 'DESC'])
        ->contain(['Users']);

         $nb_tweet =  $tweet->count(); // calcul du nombre de conversations actives

         if($nb_tweet == 0)
         {
             $this->set('nb_tweet', $nb_tweet);
         }
         else
         {
            $this->set(compact('tweet'));
         }      
    }

    /**
     * View method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('profil');
        $this->set('title', 'Commentaires'); // titre de la page
        $tweet = $this->Tweet->find()
        
        ->where(['Tweet.id' => $this->request->getParam('id')])


        ->contain(['Users'])
        ->contain(['Commentaires'=> function($q) { // appliquer un order by sur un contain
              return $q->order(['Commentaires.created' => 'DESC']);
          }])
        ->contain(['Commentaires.Users']);

        $this->set('tweet', $tweet);
        
      
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tweet = $this->Tweet->newEntity();
        if ($this->request->is('post')) {
                   $data = array(
            'tweet_id' => rand(5, 15),
            'user_id' => $this->Auth->user('id'),
            'user_timeline' => $this->Auth->user('username'),
            'contenu_tweet' => $this->request->data('contenu_tweet')
            );
            $tweet = $this->Tweet->patchEntity($tweet, $data);
            if ($this->Tweet->save($tweet)) {
                // évènement hashtag

                if(preg_match('/#([^\s]+)/', $this->request->data('contenu_tweet')))
                {
                 $event = new Event('Model.Tweet.afterAdd', $this, ['contenu_tweet' => $this->request->data('contenu_tweet')]);
                
                $this->eventManager()->dispatch($event);
            }
                //fin évènement hashtag
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['controller'=> 'tweet', 'action' => 'index', $this->Auth->user('username')]);
            } else {
                $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
            }
        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
 $tweet_verif = $this->Tweet->find();
        $tweet_verif->where([

'user_timeline' =>  $this->Auth->user('username') // id de la personne connecté

            ])
        ->where(['id' => $this->request->getParam('id')]);
       
        if(!$tweet_verif->isEmpty())
        {
            $id_tweet = $this->request->getParam('id');
            $entity = $this->Tweet->get($id_tweet); // création de l'entité abonnement
            $result = $this->Tweet->delete($entity);
            if($result)
            {
            $this->Flash->success(__('The tweet has been deleted.'));
        }
        }
         else {
            $this->Flash->error(__('The tweet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=> 'tweet', 'action' => 'index', $this->Auth->user('username')]);
    }

    // partage
    public function share($id = null)
    {
        $tweet = $this->Tweet->newEntity();

        $info_tweet = $this->Tweet->find()
        ->select([
         'user_id',
         'contenu_tweet',     
            ])
        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($info_tweet as $info_tweet)
        {
            $user_tweet = $info_tweet->user_id;
            $contenu_tweet = $info_tweet->contenu_tweet;
        }

        $data = array(
            'tweet_id' => $this->request->getParam('id'),
            'user_id' => $user_tweet,
            'user_timeline' => $this->Auth->user('username'),
            'contenu_tweet' => $contenu_tweet,
            'partage' => 1,
            // évènement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil'),
            'id_tweet' => $this->request->getParam('id')
            );
            $tweet = $this->Tweet->patchEntity($tweet, $data);
            if ($this->Tweet->save($tweet)) {

                 $event = new Event('Model.Partage.afterAdd', $this, ['tweet' => $tweet]);
                $this->eventManager()->dispatch($event);


                $this->Flash->success(__('Tweet partagé'));

                
            } else {
                $this->Flash->error(__('Impossible de partager ce tweet'));
            }
            return $this->redirect($this->referer());
        
    }
    // tweet sur l'accueuil

    public function accueuil($id = null)
    {
                $this->viewBuilder()->layout('profil');
                $this->set('title', 'Actualités'); // titre de la page
                $abonnement = $this->Tweet->find('all')
                
       ->where([

        'Abonnement.user_id' =>  $this->Auth->user('username')

            ])
        ->order(['Tweet.created' => 'DESC'])
        ->contain(['Users'])
        ->contain(['Abonnement']);
 
     
     $this->set(compact('abonnement'));

    }

        private function getid($username) // id de l'utilisateur
    {
        $this->loadModel('Users');
        $id = $this->Users->find();
        $id->select(['id'])
        ->where(['username' => $username ]);
        return $id;
    }


}
