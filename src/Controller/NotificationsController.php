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
      $this->viewBuilder()->layout('general');
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

public function allNotiflue()
{

    if ($this->request->is('ajax')) {
   $query = $this->Notifications->updateAll(
        ['statut' => 1], // champs
        ['statut' => 0, 'user_name' => $this->Auth->user('username') ]); // conditions 

                 if($query)
                 {
                    $reponse = 'ok';
                
            } else {
                 $reponse = 'erreur';
            }
        

                    $this->response->body($reponse);
    return $this->response;


    }
}



public function nbnotif()
{

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

