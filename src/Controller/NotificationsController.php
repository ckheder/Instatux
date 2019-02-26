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

            public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']); // on empeche l'accès a l'index si je ne suis pas auth
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
                $notification = $this->Notifications->find()->where([

'user_name' =>  $this->Auth->user('username')

            ])
                
                ->order(['created'=> 'DESC']);

        $nb_notif =  $notification->count(); // calcul du nombre de tweet


             $this->set('nb_notif', $nb_notif);

            $this->set('notification', $this->Paginator->paginate($notification, ['limit' => 10]));
              
             
    }

        public function delete($id = null) // id-> id de la notification, 

    {

      if ($this->request->is('ajax')) {
                    $query = $this->Notifications->query();
            $query->delete()
    ->where(['user_name' => $this->Auth->user('username')])
    ->where(['id_notif' => $this->request->getParam('id')])
    ->execute();
 
            if ($query) 
            {
               $reponse = 'suppok';
            }
            else 
            {

                $reponse = 'problème';
            }
                        $this->response->body($reponse);
    return $this->response;

 }



    }

public function allNotiflue() // indiquer que toutes les notifications sont lues
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

public function singleNotiflue() // indiquer que toutes les notifications sont lues
{

    if ($this->request->is('ajax')) {
     $query = $this->Notifications->query();
$query->update()
    ->set(['statut' => 1])
    ->where(['user_name' => $this->Auth->user('username')])
    ->where(['id_notif' => $this->request->getParam('id')])
    ->execute();

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

public function allDeletenotif() // indiquer que toutes les notifications sont lues
{

    if ($this->request->is('ajax')) {
   $query = $this->Notifications->deleteAll(
        ['user_name' => $this->Auth->user('username') ]); // conditions 

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



public function nbnotif()// calcul du nombre de notif non lues
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

