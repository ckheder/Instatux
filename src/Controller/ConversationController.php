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
     * Edit method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) // $id -> id de la conversation / 0-> conversation masqué
    {

        $query = $this->Conversation->query();
        $query->update()
    ->set(['statut' => 0])
    ->where(['participant1' => $this->Auth->user('username')])
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

   
}
