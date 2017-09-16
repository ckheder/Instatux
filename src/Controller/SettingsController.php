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

    public function index()
    {
    	$this->set('title', 'Paramètre de compte'); // titre de la page
        $this->viewBuilder()->layout('profil');

        // récupération des paramètres de mon profil

         $settings = $this->Settings->find()
        
        							->where(['user_id' => $this->Auth->user('username')]);

        foreach ($settings as $settings):

$setup_profil = $settings->type_profil;

endforeach;

        $this->set('setup_profil', $setup_profil);
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

}