<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
//use App\Controller\Component\AuthComponent;

/**
 * Tweet Controller
 *
 * @property \App\Model\Table\TweetTable $Tweet
 */
class SettingsController extends AppController
{

public $components = array('RequestHandler');

    public function index()
    {
            $this->viewBuilder()->layout('profil');
        
    	$this->set('title', 'Paramètre de compte'); // titre de la page
    

        // récupération des paramètres de mon profil

         $settings = $this->Settings->find()->select(['type_profil','notif_message','notif_cite','notif_partage','notif_comm','notif_abo'])
        
        							->where(['user_id' => $this->Auth->user('username')]);

        foreach ($settings as $settings):

$setup_profil = $settings->type_profil;
$notif_message = $settings->notif_message;
$notif_cite = $settings->notif_cite;
$notif_partage = $settings->notif_partage;
$notif_comm = $settings->notif_comm;
$notif_abo = $settings->notif_abo;

endforeach;

        $this->set('setup_profil', $setup_profil);
        $this->set('notif_message', $notif_message);
        $this->set('notif_cite', $notif_cite);
        $this->set('notif_partage', $notif_partage);
        $this->set('notif_comm', $notif_comm);
        $this->set('notif_abo', $notif_abo);

    }

    // paramètre de profil : 0 -> profil public par défaut, 1 -> profil privé

    public function setupProfilPrive() // définition du profil à privé
    {
    	        $query = $this->Settings->query()
                            ->update()
                            ->set(['type_profil' => 1])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                 if($query)
                 {
                 	$this->Flash->success(__('Votre profil est désormais privé.'));

                $event = new Event('Model.Settings.afterPrivate', $this, ['authname' => $this->Auth->user('username')]);

                $this->eventManager()->dispatch($event);

                
            } else {
                $this->Flash->error(__('Impossible de mettre à jour votre profil.'));
            }
        

        return $this->redirect($this->referer());
                 
    }

        public function setupProfilPublic() // définition du profil à public
    {
    	        $query = $this->Settings->query()
                            ->update()
                            ->set(['type_profil' => 0])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                             if($query)
                 {
                 	$this->Flash->success(__('Votre profil est désormais public.'));

                $event = new Event('Model.Settings.afterPublic', $this, ['authname' => $this->Auth->user('username')]);

                $this->eventManager()->dispatch($event);

                
            } else {
                $this->Flash->error(__('Impossible de mettre à jour votre profil.'));
            }
        

        return $this->redirect($this->referer());
    }

    public function notifmessage() // mise à jour des paramètres de notifications de message 0  = non, 1 = oui
    {

        if ($this->request->is('ajax')) {

            $notifmessage = $this->request->data['notifmessage'];

        $query = $this->Settings->query()
                            ->update()
                            ->set(['notif_message' => $notifmessage])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

        $this->response->body($notifmessage);
       return $this->response;

             
            }
        }


            public function notifcite() // mise à jour des paramètres de notifications de citation 0  = non, 1 = oui
            {

                $notifcite = $this->request->data('notifcite');

                if ($this->request->is('ajax')) {

        $query_cite = $this->Settings->query()
                            ->update()
                            ->set(['notif_cite' => $notifcite])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                             $this->response->body($notifcite);
       return $this->response;
   }
            }

public function notifpartage() // mise à jour des paramètres de notifications de partage 0  = non, 1 = oui
            {
                $notifpartage = $this->request->data('notifpartage');

                if ($this->request->is('ajax')) {

        $query_partage = $this->Settings->query()
                            ->update()
                            ->set(['notif_partage' => $notifpartage])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                             $this->response->body($notifcite);
       return $this->response;
            }
        }

                        public function notifabo() // mise à jour des paramètres de notifications d'abonnement  0  = non, 1 = oui
            {

$notifabo = $this->request->data('notifabo');

if ($this->request->is('ajax')) {


        $query_abo = $this->Settings->query()
                            ->update()
                            ->set(['notif_abo' => $notifabo])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                            
                             $this->response->body($notifabo);
       return $this->response;
                        }
            }

public function notifcomm()
            {

$notifcomm = $this->request->data('notifcomm');

if ($this->request->is('ajax')) {


        $query_comm = $this->Settings->query()
                            ->update()
                            ->set(['notif_comm' => $notifcomm])
                            ->where(['user_id' => $this->Auth->user('username') ])                            
                            ->execute();

                                                       
                             $this->response->body($notifcomm);
       return $this->response;
            }
        }
    

    

}