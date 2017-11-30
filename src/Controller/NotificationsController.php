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

            public $paginate = [
        'limit' => 10,
        
    ];

            public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }


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
            $this->set('notification', $this->Paginator->paginate($notification, ['limit' => 10]));
         }      
             
    }

public function singleNotifLue($id_notif)
{
                    $query = $this->Notifications->query()
                            ->update()
                            ->set(['statut' => 1])
                            ->where(['id_notif' => $id_notif])
                            ->where(['user_name' => $this->Auth->user('username') ])                            
                            ->execute();

                 if($query)
                 {
                    $this->Flash->success(__('Notification marquée comme lue.'));
                
            } else {
                $this->Flash->error(__('Impossible de marquée cette notification comme lue.'));
            }
        

        return $this->redirect($this->referer());
}

public function allNotiflue()
{
   $query = $this->Notifications->updateAll(
        ['statut' => 1], // champs
        ['statut' => 0, 'user_name' => $this->Auth->user('username') ]); // conditions 

                 if($query)
                 {
                    $this->Flash->success(__('Toutes les notifications sont marquées comme lue.'));
                
            } else {
                $this->Flash->error(__('Impossible de marquée toute les notifications comme lue.'));
            }
        

        return $this->redirect($this->referer());
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

public function delete($id) // suppression d'une notification

{
    $query = $this->Notifications->query()
                                ->delete()
                                ->where(['id_notif' => $id])
                                ->where(['user_name' => $this->Auth->user('username')])
                                ->execute();

    if($query)
    {
         $this->Flash->success(__('Notification supprimée'));
    }
    else
    {
        $this->Flash->error(__('Impossible de supprimée cette notifications.'));
    }

return $this->redirect($this->referer());
}

}

