<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Request;
use Cake\Event\Event;
/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() // mes notifications
    {
      $this->viewBuilder()->layout('profil');
       $this->set('title', 'Notifications'); // titre de la page
                $notification = $this->Notifications->find();
                
        $notification->where([

'user_name' =>  $this->Auth->user('username')

            ]);
        $notification->order(['created'=> 'DESC']);

        $nb_notif =  $notification->count(); // calcul du nombre de tweet

         if($nb_notif == 0)
         {
             $this->set('nb_notif', $nb_notif);
         }
         else
         {
            $this->set('notification', $notification);
         }      
             
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('notification', $notification);
        $this->set('_serialize', ['notification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        


       // vérif 
        $notif_verif = $this->Notifications->find();
        $notif_verif->where([

'user_name' =>  $this->Auth->user('username') // id de la personne connecté

            ])
        ->where(['id_notif' => $this->request->getParam('id')]);

         if (!$notif_verif->isEmpty()) // si tout est bon
        { 
            $id_notif = $this->request->getParam('id');
            $entity = $this->Notifications->get($id_notif); // création de l'entité abonnement
            $result = $this->Notifications->delete($entity); // suppression de l'entité
 
            if ($result) 
            {
                $this->Flash->success(__('Notification supprimée.'));

                return $this->redirect(['action' => 'index']);
            }
             else 
            {

                $this->Flash->error(__('Impossible de supprimer cette notification.'));
            }

        return $this->redirect(['action' => 'index']);
    }
    else
    {
        $this->Flash->error(__('Vous ne pouvez supprimer cette notification.'));
        return $this->redirect(['action' => 'index']);
    }
}

public function nbnotif()
{
        //$this->viewBuilder()->setLayout() = false;
        $nb_notif = $this->Notifications->find()->where(['user_name' => $this->Auth->user('username')])->where(['statut' => 0])->count();
        

        if($nb_notif == 0)
        {
            $this->set('nb_notif', 0);
        }
        else
        {
        $this->set('nb_notif', $nb_notif);
    }
       
}

}