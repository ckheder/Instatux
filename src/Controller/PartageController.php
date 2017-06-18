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
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partage = $this->Partage->newEntity();
       
            $data = array(
            'user_id' => $this->Auth->user('id'), // moi
            'tweet_partage' => $this->request->getParam('id'), // tweet_partage
            //evenement partage
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil'),
            'auteur' => $this->request->getParam('id_auteur')
            );

        $partage = $this->Partage->patchEntity($partage, $data);
            
            if ($this->Partage->save($partage)) 
            {

                // évènement création de partage

                 $event = new Event('Model.Partage.afterAdd', $this, ['partage' => $partage]);
                $this->eventManager()->dispatch($event);

                // fin évènement création de partage

                $this->Flash->success(__('The partage has been saved.'));

                
            }
            else
            {
            $this->Flash->error(__('The partage could not be saved. Please, try again.'));
        }
            return $this->redirect($this->referer());
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

            $this->Flash->success(__('The partage has been deleted.'));
        } else {
            $this->Flash->error(__('The partage could not be deleted. Please, try again.'));
        }

        return $this->redirect('/'.$this->Auth->user('username').'');
    }
}
