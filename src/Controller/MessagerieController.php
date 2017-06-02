<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Messagerie Controller
 *
 * @property \App\Model\Table\MessagerieTable $Messagerie
 */
class MessagerieController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('profil');
        $this->set('title', 'Messagerie'); // titre de la page

        // on recherche toutes les conversations non masquées, statut = 1 de l'utilisateur courant

        $this->loadModel('Conversation');

        $conv = $this->Conversation->find()

        ->select(['conv'])
        //->select(['conv' => $conv->func()->count('conv')])
        ->where(['participant1' => $this->Auth->user('id')])
        ->where(['statut' => 1]);

        $nb_conv = $conv->count(); // calcul du nombre de conversations actives

        $this->set('nb_conv',$nb_conv);

        // requête des conversations, on recherche tous les id de derniers messages reçu ou envoyés par moi et on les regroupe par conv
        // $conv regroupe toutes les conversations non masquées 

    $matchingComment = $this->Messagerie->find();
    $matchingComment->select(['Messagerie_id' => $matchingComment->func()->max('Messagerie.id')])
    ->where(['destinataire' => $this->Auth->user('id')])
    ->orwhere(['user_id'=>$this->Auth->user('id')])
    ->where(['Messagerie.conv IN' => $conv])
    ->group('conv');
    
        // requête des messages, on affiche tous ces messages

        $message = $this->Messagerie->find()

       ->where(['Messagerie.id IN' =>   $matchingComment]);
    
        $this->set(compact('message'));
        

}

// vérification que l'on peut accéder à une conversation
    
    private function verifconv($id = null)
    {
        $this->loadModel('Conversation');
        $verif = $this->Conversation->find();
       
        $verif->where(['participant1' => $this->Auth->user('id')])
        ->orwhere(['participant2'=>$this->Auth->user('id')])
        ->where(['conv' => $this->request->getParam('id')]);

        if ($verif->isEmpty())
        {
            return 0; // pas le droit
        }
        else
        {
            return 1; // autorisé
        }
    }

    /**
     * View method
     * voir les messages d'une conversation
     * @param string|null $id Messagerie id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('profil');
         $this->set('title', 'Conversation'); // titre de la page

         $verif_user = $this->verifconv($this->Auth->user('id'));

         if($verif_user == 0)
         {
            $this->Flash->error(__('Vous n\'avez l\'autorisation de voir cette conversation.'));
                return $this->redirect([
                    'controller' => 'messagerie',
    'action' => 'index'
        
]);

                 
                die();
         }
         else
         {

        $message = $this->Messagerie->find('all')
        ->where(['conv' => $this->request->getParam('id')])
        ->order(['Messagerie.created' => 'DESC'])


        ->contain(['Users']);
$this->set('verif_user',1);
 $this->set(compact('message'));
}
  
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() // ajouter un message à une conversation
    {
$message = $this->Messagerie->newEntity();
        if ($this->request->is('post')) {
            $data = array(
            'user_id' => $this->Auth->user('id'), // expediteur
            'destinataire' => $this->request->data['user_id'],
            'message' =>  $this->request->data['message'], // message
            'conv' => $this->request->data['conversation'],
            'statut' => 1,
            //evenement abonnement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );
            $message = $this->Messagerie->patchEntity($message, $data);
            
            if ($this->Messagerie->save($message)) 
            {

                    //évènenement

                 $event = new Event('Model.Messagerie.afterAdd', $this, ['message' => $message]);
                $this->eventManager()->dispatch($event);

                // fin évènement
                $this->Flash->success(__('Message envoyé.'));

              

                return $this->redirect([
    'controller' => 'messagerie',
    'action' => 'view',
    $this->request->data['conversation']
        
]);
            } else {
                $this->Flash->error(__('Message non envoyé.'));
                return $this->redirect([
                    'controller' => 'messagerie',
    'action' => 'view',
    $this->request->data['conversation']
        
]);
            }
        }
    }

    public function addprofil() // envoyer message depuis profil
    {

// récupération de conversation : tabel conversation

    $this->loadModel('Conversation');

$checkconv = $this->Conversation
        ->find()
        ->select(['conv'])
        ->where([

'participant1' =>  $this->Auth->user('id') // moi

            ])
        ->where(['participant2' => $this->request->data['destinataire']]);


 if ($checkconv->isEmpty()) // si pas de résultat, on crée
        {

            $conversation = rand();

            }
            else
            {
                foreach ($checkconv as $row)
                {
                $conversation = $row['conv'];
                }

            }

// fin récupération conversation

        
            $data = array(
            'user_id' => $this->Auth->user('id'), // expediteur
            'destinataire' => $this->request->data['destinataire'],
            'message' =>  $this->request->data['message'], // message
            'conv' => $conversation,
            'statut' => 1,
            //evenement abonnement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );

            $username = $this->request->data['user_message']; // nom du destinataire
            $message = $this->Messagerie->newEntity();
            $message = $this->Messagerie->patchEntity($message, $data);

           
            
            if ($this->Messagerie->save($message)) {
                $this->Flash->success(__('Message envoyé à '.$username.''));

                  $event = new Event('Model.Messagerie.afterAdd', $this, ['message' => $message]);
                $this->eventManager()->dispatch($event);

                // fin évènement

                return $this->redirect([
    'controller' => 'tweet',
    'action' => 'index',
    $username
        
]);
            } else {
                $this->Flash->error(__('Message non envoyé.'));
                                return $this->redirect([
    'controller' => 'tweet',
    'action' => 'index',
    $username
        
]);
            }
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Messagerie id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messagerie = $this->Messagerie->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messagerie = $this->Messagerie->patchEntity($messagerie, $this->request->data);
            if ($this->Messagerie->save($messagerie)) {
                $this->Flash->success(__('The messagerie has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The messagerie could not be saved. Please, try again.'));
            }
        }
        $users = $this->Messagerie->Users->find('list', ['limit' => 200]);
        $this->set(compact('messagerie', 'users'));
        $this->set('_serialize', ['messagerie']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Messagerie id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messagerie = $this->Messagerie->get($id);
        if ($this->Messagerie->delete($messagerie)) {
            $this->Flash->success(__('The messagerie has been deleted.'));
        } else {
            $this->Flash->error(__('The messagerie could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
