<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Partage Controller
 *
 * @property \App\Model\Table\PartageTable $Partage
 */
class PartageController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Abonnement', 'Users']
        ];
        $partage = $this->paginate($this->Partage);

        $this->set(compact('partage'));
        $this->set('_serialize', ['partage']);
    }

    /**
     * View method
     *
     * @param string|null $id Partage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partage = $this->Partage->get($id, [
            'contain' => ['Abonnement', 'Users', 'Tweet']
        ]);

        $this->set('partage', $partage);
        $this->set('_serialize', ['partage']);
    }


    

    /**
     * Delete method
     *
     * @param string|null $id Partage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $partage = $this->Partage->get($id); // id du partage

// vérification du droit de supprimer ce partage

     $query = $this->Partage->find()
    ->where(['id_partage' => $partage['id_partage']])
    ->andwhere(['user_id' => $this->Auth->user('id')]);


        if (!$query->isEmpty()) { // si pas de résultat

            $result = $this->Partage->delete($partage);

            $this->Flash->success(__('Partage supprimé.'));
        } else {
            $this->Flash->error(__('Impossible de supprimer ce partage.'));
        }

        return $this->redirect('/'.$this->Auth->user('username').'');
    }
}
