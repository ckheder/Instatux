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
            if($this->allow_see_profil($username) == 0) // profil privé et non abonné
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

    private function allow_see_profil($username) // $username = $this->request->getPram('username')
    {

        // 1) on vérifie si je suis bloqué : bloqueur -> l'autre et bloqué -> moi

        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $username])->where(['bloquer' => $this->Auth->user('username')]);

        $result_blocage = $verif_blocage->count();

        if($result_blocage == 1) // je suis bloqué
        {
            return $voir = 0; // interdiction de voir le profil
        }
        else 
        {
        // récupération du profil courant 1) profil prive 0/ profil public

        $this->loadModel('Settings');

        $type_profil = $this->Settings->find()->select(['type_profil'])->where(['user_id' => $username]);

        foreach($type_profil as $type_profil)

            $type_profil = $type_profil->type_profil;

            if($type_profil == 1) // profil privé
            {

        // on vérifie si je suis abonné

        $this->loadModel('Abonnement');

        $verif_abo = $this->Abonnement->find()->where(['user_id' => $this->Auth->user('username')])

                                                            ->where(['suivi' => $username])
                                                            ->where(['etat' => 1]);
        $result_abo = $verif_abo->count();

        if($result_abo == 0) // je ne suis pas abonné
        {
            $voir = 0; // interdiction de voir
        }
         else
        {
            $voir = 1; // autorisation de voir
        }

}

    else // profil public et non bloqué je peut voir les tweets
        {
            $voir = 1;
        }
            } 

            return $voir;
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
            if($this->allow_view_tweet($this->Auth->user('username')) == 0) // pas le droit de voir le tweet
        {
            $no_follow = 0;
            $this->set('no_follow', $no_follow);

        }
        
        $this->set('tweet', $tweet);
        }

    }

        /**
     * allow-view_tweet method
     * test des autorisations de voir un tweet
     * @param string| $username $this->Auth->user('username').
     */

        private function allow_view_tweet($username)
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

        // 1) on vérifie si je suis bloqué : bloqueur -> l'autre et bloqué -> moi

        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $auteur_tweet])->where(['bloquer' => $this->Auth->user('username')]);

        $result_blocage = $verif_blocage->count();

        if($result_blocage == 1) // je suis bloqué
        {
            return $voir = 0; // interdiction de voir le tweet
        }
        else 
        {
        // vérification si c'est un tweet privé

            if($private == 1) // tweet privé
            {

                if($auteur_tweet != $this->Auth->user('username') AND $share == 0) // je ne suis pas l'auteur et que ce n'est pas un tweet partagé

                {

        // on vérifie si je suis abonné

        $this->loadModel('Abonnement');

        $verif_abo = $this->Abonnement->find()->where(['user_id' => $this->Auth->user('username')])

                                                            ->where(['suivi' => $auteur_tweet])
                                                            ->where(['etat' => 1]);
        $result_abo = $verif_abo->count();



        if($result_abo == 0) // je ne suis pas abonné
        {
            $voir = 0; //interdiction de voir le tweet
        }
        else
        {
            $voir = 1;
        }

            }

            }
            else // tweet public, on peut le voir
            {
                $voir = 1;
            }
            
    }

    return $voir;
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
                $this->Flash->success(__('Nouveau tweet ajouté.'));


            } else {
                $this->Flash->error(__('Impossible d\'ajouter ce tweet.'));
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
            $this->Flash->success(__('Tweet supprimé.'));
        }
        }
         else {
            $this->Flash->error(__('Impossible de supprimer ce tweet.'));
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

    public function accueuil()
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

        $nb_tweet_accueuil = $abonnement->count();

        if($nb_tweet_accueuil == 0)
        {
            $this->set('nb_tweet_accueuil', $nb_tweet_accueuil);
        }


     $this->set(compact('abonnement'));

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

    
        private function verif_user($username) // on vérifie si l'utilisateur existe
    {
        $this->loadModel('Users');
        $check_user = $this->Users->find()->where(['username' => $username ])->count();
        return $check_user;
    }



}
