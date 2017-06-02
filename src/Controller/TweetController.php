<?php
namespace App\Controller;

use App\Controller\AppController;
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
        $tweet = $this->Tweet->find();
         // titre de la page
        $tweet->where(['Users.username' => $this->request->getParam('username')]);
        $tweet->order(['Tweet.created'=> 'DESC']);
         $tweet->contain(['Users']);
        $this->set(compact('tweet'));
        //$this->set('_serialize', ['tweet']);

       
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
        $tweet = $this->Tweet->find('all');
        $tweet->where(['Tweet.id' => $this->request->getParam('id')]);


        $tweet->contain(['Users']);
        $tweet->contain(['Commentaires'=> function($q) { // appliquer un order by sur un contain
              return $q->order(['Commentaires.created' => 'DESC']);
          }]);
        $tweet->contain(['Commentaires.Users']);

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
            $tweet = $this->Tweet->patchEntity($tweet, $this->request->data);
            if ($this->Tweet->save($tweet)) {
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['controller'=> 'tweet', 'action' => 'index', $this->Auth->user('username')]);
            } else {
                $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Tweet->Users->find('list');
        $this->set(compact('tweet', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tweet = $this->Tweet->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tweet = $this->Tweet->patchEntity($tweet, $this->request->data);
            if ($this->Tweet->save($tweet)) {
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Tweet->Users->find('list', ['limit' => 200]);
        $this->set(compact('tweet', 'users'));
        $this->set('_serialize', ['tweet']);
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

'user_id' =>  $this->Auth->user('id') // id de la personne connecté

            ])
        ->where(['id' => $this->request->getParam('id')]);
       
        //$tweet = $this->Tweet->get($id);
        //if ($this->Tweet->delete($tweet)) {
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

    // tweet sur l'accueuil

    public function accueuil($id = null)
    {
                $this->viewBuilder()->layout('profil');
                $this->set('title', 'Actualités'); // titre de la page
                $abonnement = $this->Tweet->find('all');
                
        $abonnement->where([

        'Abonnement.user_id' =>  $this->Auth->user('id')

            ]);

        $abonnement->contain(['Users']);
        $abonnement->contain(['Abonnement']);
 
     
     $this->set(compact('abonnement'));

    }


}
