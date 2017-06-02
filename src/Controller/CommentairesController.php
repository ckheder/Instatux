<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Commentaires Controller
 *
 * @property \App\Model\Table\CommentairesTable $Commentaires
 */
class CommentairesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tweets']
        ];
        $commentaires = $this->paginate($this->Commentaires);

        $this->set(compact('commentaires'));
        $this->set('_serialize', ['commentaires']);
    }

    /**
     * View method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentaire = $this->Commentaires->get($id, [
            'contain' => ['Tweets']
        ]);

        $this->set('commentaire', $commentaire);
        $this->set('_serialize', ['commentaire']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

      
        $commentaire = $this->Commentaires->newEntity();
        if ($this->request->is('post')) {
            $data = array(
            'comm' =>  $this->request->data['comm'],
            'user_id' => $this->Auth->user('id'),
            'tweet_id' => $this->request->data['id'], // id du tweet
            // pour évènement
            'userosef' => $this->request->data['userosef'], // auteur du tweet
            'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );
            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);
            
           //debug($commentaire);
            //die();
            
            if ($this->Commentaires->save($commentaire)) {

              if( $this->request->data['userosef'] != $this->Auth->user('id'))
                  {
              // évènement
              $event = new Event('Model.Commentaires.afterAdd', $this, ['commentaire' => $commentaire]);
                $this->eventManager()->dispatch($event);

                //fin évènement
              }

                $this->Flash->success(__('The commentaire has been saved.'));

                //return $this->redirect(['action' => 'index']);

                return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
$this->request->data['id']
        
]);
            } else {
                $this->Flash->error(__('The commentaire could not be saved. Please, try again.'));
            }
        }
        //$tweets = $this->Commentaires->Tweet->find('list', ['limit' => 200]);
        //$this->set(compact('commentaire', 'tweet'));
        //$this->set('_serialize', ['commentaire']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $tweet = null)
    {
        $this->viewBuilder()->layout('profil');


        $commentaire = $this->Commentaires->get($id, [
            'contain' => []
        ]);

        // vérif auteur
        $auteur_verif = $this->Commentaires->find();
        $auteur_verif->where([

'auteur' =>  $this->Auth->user('id')

            ])
        ->where(['id'=>$id]);

      
        // fin vérif auteur

  if (!$auteur_verif->isEmpty())
        {

        if ($this->request->is(['post', 'put'])) {

// tableau de données

            $data = array(
            'id'=>$id, // id du comm
            'comm' =>  $this->request->data['comm'], // commentaire
            'tweet_id' => $tweet, // id du tweet
            'user_id' => $this->Auth->user('id') // utilisateur
            );


            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);
            if ($this->Commentaires->save($commentaire)) {
                $this->Flash->success(__('Commentaire modifié avec succès !.'));

                        return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
    '?' => [
        'id' => $tweet
        
]]);
                    }
            }
            } else {
                $this->Flash->error(__('Modification impossible.'));
            }
        
        
        $this->set(compact('commentaire'));
        $this->set('_serialize', ['commentaire']);
    
}
    /**
     * Delete method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $tweet = null)
    {

        // vérif auteur

        $auteur_verif = $this->Commentaires->find();
        $auteur_verif->where([

'user_id' =>  $this->Auth->user('id')

            ])
        ->where(['id'=>$id]);

        // vérif si c'est l'auteur du tweet

        $auteur_tweet = $this->Commentaires->Tweet->find();

        $auteur_tweet->where([

'id' =>  $tweet

            ])
         ->where(['user_id'=>$this->Auth->user('id')]);
       
        
        if (!$auteur_verif->isEmpty() or !$auteur_tweet->isEmpty()) // si résultat on supprime
        {
       //$this->request->allowMethod(['post', 'delete']);
        $commentaire = $this->Commentaires->get($id);
        if ($this->Commentaires->delete($commentaire)) 
        {
            $this->Flash->success(__('The commentaire has been deleted.'));
        } 

        return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
    
        $tweet
        
]);
    }

    else 
    {
            $this->Flash->error(__('The commentaire could not be deleted. Please, try again.'));
        }
}
}
