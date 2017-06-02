<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Conversation Controller
 *
 * @property \App\Model\Table\ConversationTable $Conversation
 */
class ConversationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $conversation = $this->paginate($this->Conversation);

        $this->set(compact('conversation'));
        $this->set('_serialize', ['conversation']);
    }

    /**
     * View method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conversation = $this->Conversation->get($id, [
            'contain' => []
        ]);

        $this->set('conversation', $conversation);
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $conversation = $this->Conversation->newEntity();
        if ($this->request->is('post')) {
            $conversation = $this->Conversation->patchEntity($conversation, $this->request->data);
            if ($this->Conversation->save($conversation)) {
                $this->Flash->success(__('The conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
        }
        $this->set(compact('conversation'));
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) // $id -> id de la conversation
    {

        $query = $this->Conversation->query();
$query->update()
    ->set(['statut' => 0])
    ->where(['participant1' => $this->Auth->user('id')])
    ->where(['conv' => $id ])
    ->execute();
 
            if ($query) 
            {
                $this->Flash->success(__('Conversation supprimée.'));

                return $this->redirect(['controller' => 'Messagerie', 'action' => 'index']);
            }
            $this->Flash->error(__('Impossible de supprimer cette conversation.'));
        
        $this->set(compact('conversation'));
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $conversation = $this->Conversation->get($id);
        if ($this->Conversation->delete($conversation)) {
            $this->Flash->success(__('The conversation has been deleted.'));
        } else {
            $this->Flash->error(__('The conversation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
