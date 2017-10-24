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

        if($username != $this->Auth->user('username')) // si je ne suis pas sur mon profil
    {

            if($this->verif_user($username) == 0) // membre ou page inexistante
        {
                    $this->Flash->error(__('Cette page n\'existe pas.'));
                    return $this->redirect('/'.$this->Auth->user('username').'');
        }
            if($this->check_profil($username) == 0) // profil privé et non abonné
        {
            $no_follow = 0;
            $this->set('no_follow', $no_follow);

        }


    }
        $tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
            'Tweet.id',
            'Tweet.user_id',
            'Tweet.user_timeline',
            'Tweet.contenu_tweet',
            'Tweet.created',
            'Tweet.share',
            'Tweet.nb_commentaire',
            'Tweet.nb_partage',
            'Tweet.allow_comment',
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

        // vérification si on peut

        $tweet = $this->Tweet->find() // récupération des infos du tweet

        ->where(['Tweet.id' => $this->request->getParam('id')])


        ->contain(['Users'])
        ->contain(['Commentaires'=> function($q) { // appliquer un order by sur un contain
              return $q->order(['Commentaires.created' => 'DESC']);
          }])
        ->contain(['Commentaires.Users']);

        $test_tweet = $tweet->count(); // on compte les résultats

        if($test_tweet == 0) // test de l'existence du tweet

         {
             $this->set('test_tweet', $test_tweet);
         }
         else
         {
            if($this->view_tweet($this->Auth->user('username')) == 0) // profil privé et non abonné
        {
            $no_follow = 0;
            $this->set('no_follow', $no_follow);

        }
        elseif ($this->test_blocage($this->Auth->user('username')) == 1) // utilisateur bloqué 
        {
            $this->set('bloquer', 0);
        }

        $this->set('tweet', $tweet);
        }

    }
    // parsage des tweets
    private function linkify_tweet($tweet)
    {
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
            // fin vérification
                   $data = array(
            'id' => rand(5, 15),
            'user_id' => $this->Auth->user('username'),
            'user_timeline' => $this->Auth->user('username'),
            'contenu_tweet' => $this->linkify_tweet($this->request->data('contenu_tweet')),
            'private' =>$this->get_type_profil($this->Auth->user('username')),
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


            } else {
                $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
            }
        }

        return $this->redirect($this->referer());

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

    private function check_profil($username) // autorisations de voir le profil d'un user,0 -> pas le droit, 1 -> le droit
    {
        $this->loadModel('Settings');

        // on récupère d'abord le type de profil de l'utilisateur -> 0 : public, 1 : privé

        $verif_type_profil = $this->Settings->find()->select(['type_profil'])->where(['user_id' => $username]);

        foreach($verif_type_profil as $verif_type_profil)
        {
            $type_profil = $verif_type_profil->type_profil;
        }


        // si le profil est privé , on vérifie si on est abonné

        if($type_profil == 1)
        {

            if($this->test_abo($username) == 0) // pas d'abonnement
            {
                $voir_profil = 0; // interdiction de voir les tweets
            }
            else
            {
                $voir_profil = 1;
            }

        }
        elseif ($type_profil == 0 AND $this->test_blocage($username) == 1) //   bloqué sur un profil public 
        {
            $voir_profil = 0; // interdiction de voir les tweets
        }
        else
        {
            $voir_profil = 1;// autoriser à voir les tweets
        }

        return $voir_profil;
    }

    private function view_tweet($id = null) // 0 -> pas le droit, 1 -> le droit
    {
        $tweet = $this->Tweet->find() // on récupère l'auteur du tweet et si c'est un partage et si il est privé

        ->select(['Tweet.user_id', 'share','private'])

        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($tweet as $tweet)
        {
            $auteur_tweet = $tweet->user_id;
            $share = $tweet->share;
            $private = $tweet->private;
        }

        

    if($private == 1) // on vérifie d'abord si c'est un tweet privé

        {

            if($auteur_tweet != $this->Auth->user('username') AND $share == 0) // si je ne suis pas l'auteur et que ce n'est pas un tweet partagé

        {

                if($this->test_abo($auteur_tweet) == 0) // on test si je suis abonné à l'auteur : 0-> non donc pas de tweet
        {
                $voir_tweet = 0; // interdiction de voir le tweet
            }

                     else
        {
            $voir_tweet = 1; // autorisation de voir le tweet
        }

        }

                 else
        {
            $voir_tweet = 1; // autorisation de voir le tweet
        }

    }
        else // tweet public pas de problème
        {
            $voir_tweet = 1; // autorisation de voir le tweet
        }


    return $voir_tweet;
    }

    private function test_abo($username) // on test l'abonnement dans le cas d'un profil ou d'un tweet privé
    {

            $this->loadModel('Abonnement');

            $verif_abo = $this->Abonnement->find()->where(['user_id' => $this->Auth->user('username')])

                                                            ->where(['suivi' => $username])
                                                            ->where(['etat' => 1]);
             $result_abo = $verif_abo->count();

             return $result_abo;
    }

    private function get_type_profil($username = null) // récupération du type de profil de l'utilisateur pour déterminer si un tweet est privé ou non
    {
        $this->loadModel('Settings');

        $type_profil = $this->Settings->find()->select(['type_profil'])->where(['user_id' => $username]);

        foreach($type_profil as $type_profil)
            $type_profil = $type_profil->type_profil;
        return $type_profil;
    }

    public function allowComment() // activer/désactiver les commentaires
    {
        if($this->request->data('allow_comment') == 1) // si les commentaires sont déjà désactivés
        {
            $allow_comment = 0;
        }
        else
        {
            $allow_comment = 1;
        }

          $query = $this->Tweet->query()
                            ->update()
                            ->set(['allow_comment' => $allow_comment])
                            ->where(['id' => $this->request->data('id_tweet')])
                            ->where(['user_timeline' => $this->Auth->user('username')]) // on vérifie que ce tweet est le tweet courant et que j'en suis le timeline
                            ->execute();

        if($query AND $allow_comment == 0)
        {
              $this->Flash->success(__('Les commentaires sont désormais activés pour ce post.'));
            
            
        }
        elseif($query AND $allow_comment == 1)
        {
              $this->Flash->success(__('Les commentaires sont désormais désactivés pour ce post.'));
            
            
        }
        else
        {
                $this->Flash->error(__('Impossible de désactivés les commentaires pour ce post.'));
        }

        return $this->redirect($this->referer());
    }

    private function test_blocage($username)
    {

        $tweet = $this->Tweet->find() // on récupère l'auteur du tweet et si c'est un partage et si il est privé

        ->select(['Tweet.user_id'])

        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($tweet as $tweet)
        {
            $auteur_tweet = $tweet->user_id;
        }

        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $auteur_tweet])->where(['bloquer' => $username]);

        $result_blocage = $verif_blocage->count();

             return $result_blocage;
    }


}
