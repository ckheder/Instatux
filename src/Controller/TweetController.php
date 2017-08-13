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

        $username = $this->request->getParam('username'); // nom en paramètre

        if($this->verif_user($username) == 0)
        {
                    $this->Flash->error(__('Cette page n\'existe pas.'));
                    return $this->redirect('/'.$this->Auth->user('username').'');
                    //die();
        }
        else
        {

        $tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
            'Tweet.id',
            'Tweet.user_id',
            'Tweet.contenu_tweet',
            'Tweet.user_timeline',
            'Tweet.created',
            'Tweet.share',
            'Tweet.other_user',
            'Tweet.nb_commentaire',
            'Tweet.nb_partage',
            ])
         // titre de la page
        ->where(['Tweet.user_timeline' => $username])
        ->order(['Tweet.created' => 'DESC'])
        ->contain(['Users']);

         $nb_tweet =  $tweet->count(); // calcul du nombre de tweet


         if($nb_tweet == 0)
         {
             $this->set('nb_tweet', $nb_tweet);
         }
         
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

        $test_tweet = $tweet->count();

                 if($test_tweet == 0) // test de l'existence du tweet
         {
             $this->set('test_tweet', $test_tweet);
         }
         else
         {


        $this->set('tweet', $tweet);
        }
      
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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tweet = $this->Tweet->newEntity();
        if ($this->request->is('post')) {

            // vérification du user_timeline si je tweet ou si je tweet qulqu'un d'autre
            if(!empty($this->request->data('user_timeline')))
            {
                $user_timeline = $this->request->data('user_timeline');// l'autre
                $other = 1;
                if(!preg_match('/@'.$user_timeline.'/', $this->request->data('contenu_tweet')))
                {
                    $this->Flash->error(__('Le nom de la personne que vous tweetez doit figurer dans votre tweet.'));
                    return $this->redirect($this->referer());
                    die();
                }
            }
            else
            {
                $user_timeline = $this->Auth->user('username'); // moi
                $other = 0;
            }
            // fin vérification
                   $data = array(
            'id' => rand(5, 15),
            'user_id' => $this->Auth->user('username'),
            'user_timeline' => $user_timeline,
            'contenu_tweet' => $this->linkify_tweet($this->request->data('contenu_tweet')),
            'other_user' => $other,
                        //evenement username
            'avatar_session' => $this->Auth->user('avatarprofil'),
            'auth_name' => $this->Auth->user('username')
            );
            $tweet = $this->Tweet->patchEntity($tweet, $data);

           

            if ($this->Tweet->save($tweet)) {
                // évènement hashtag/username


                 $event = new Event('Model.Tweet.afterAdd', $this, ['tweet' => $tweet]);
                
                $this->eventManager()->dispatch($event);
            
                //fin évènement hashtag
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect($this->referer());
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

    // partage d'un tweet
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
            'share' => 1,
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

        private function verif_user($username) // on vérifie si l'utilisateur existe
    {
        $this->loadModel('Users');
        $check_user = $this->Users->find()->where(['username' => $username ])->count();
        return $check_user;
    }


}
