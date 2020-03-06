<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;


/**
 * Controller Settings
 *
 * Gestion des préférences utilisateurs
 *
 * @property \App\Model\Table\SettingsTable
 */
class SettingsController extends AppController
{

    public $components = array('RequestHandler');

        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']); // on empeche l'accès a l'index si je ne suis pas auth
    }

        /**
     * Méthode Index
     *
     * Récupération des paramètres de mon profil et utlisateurs bloqués
     *
     */

      public function index()
    {
        
      $this->viewBuilder()->layout('settings');

      $this->set('title', 'Paramètre de compte');

        // récupération des paramètres

        $settings = $this->Settings->find()
                                    ->select([
                                                'type_profil',
                                                'notif_message',
                                                'notif_cite',
                                                'notif_partage',
                                                'notif_comm',
                                                'notif_abo'
                                            ])
                      ->where(['user_id' => $this->Auth->user('username')]);

        foreach ($settings as $settings):

                $setup_profil = $settings->type_profil; // type de profil : privé/public
                $notif_message = $settings->notif_message; // accepter ou non les notifications de message
                $notif_cite = $settings->notif_cite; // accepter ou non les notifications de citation
                $notif_partage = $settings->notif_partage; // accepter ou non les notifications de partge de tweets
                $notif_comm = $settings->notif_comm; // accepter ou non les notifications de nouveau commentaire
                $notif_abo = $settings->notif_abo; // accepter ou non les notifications de nouvel abonnement

        endforeach;

                $this->set('setup_profil', $setup_profil);
                $this->set('notif_message', $notif_message);
                $this->set('notif_cite', $notif_cite);
                $this->set('notif_partage', $notif_partage);
                $this->set('notif_comm', $notif_comm);
                $this->set('notif_abo', $notif_abo);

    // fin récupération des paramètres

    // récupération des utilisateurs bloqués

        $this->loadModel('Blocage');

        $listebloques = $this->Blocage->find()

                                        ->select(['Users.username','Users.description'])

                                        ->where(['bloqueur' =>  $this->Auth->user('username') ])

                                        ->order((['Users.username' => 'ASC']))

                                        ->contain(['Users']);

        $nb_bloques = $listebloques->count(); // nombre d'utilisateurs bloqués

      if ($nb_bloques == 0) // aucun résultat
    {
            $this->set('nb_bloques',0);
    }
      else
    {
      $this->set(compact('listebloques'));
    }

}


            /**
     * Méthode setupProfilpublic
     *
     * Définition du profil à public
     *
     * 0 -> profil public par défaut, 1 -> profil privé
     *
     * Sortie : profilpublicok -> mise à jour réussie | probleme : échec de la mise à jour
     */

        public function setupProfil()
    {

            if ($this->request->is('ajax'))
        {

            $action = $this->request->data['action']; // prive/public

                if($action == 'public') // passage d'un profil prive à un profil public
            {

                $setup = 0;

            }
                elseif($action == 'prive')
            {
                $setup = 1;
            } 

         $query = $this->Settings->query()
                                    ->update()
                                    ->set(['type_profil' => $setup])
                                    ->where(['user_id' => $this->Auth->user('username') ])
                                    ->execute();

                    if($query AND $action == 'public')
                 {
                    $reponse = 'profilpublicok';

                    // Passage de tous mes tweets à public

                    $event = new Event('Model.Settings.afterPublic', $this, ['authname' => $this->Auth->user('username')]);

                    $this->eventManager()->dispatch($event);

                }

                    elseif ($query AND $action == 'prive') 
                {
                    $reponse = 'profilpriveok';

                // Passage de tous mes tweets à privé

                    $event = new Event('Model.Settings.afterPrivate', $this, ['authname' => $this->Auth->user('username')]);

                    $this->eventManager()->dispatch($event);
                }
                    else
                {

                $reponse = 'probleme';

                }
            
                    $this->response->body(json_encode($reponse)); // renvoi d'une réponse AJAX
                    return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

/**
     * Méthode notifmessage
     *
     * Mise à jour des paramètres de notifications de message 0  = non, 1 = oui
     *
*/

        public function notifmessage()
            {

                if ($this->request->is('ajax')) {

                                                $query = $this->Settings->query()
                                                                        ->update()
                                                                        ->set(['notif_message' => $this->request->data('choix')])
                                                                        ->where(['user_id' => $this->Auth->user('username') ])
                                                                        ->execute();

                        $this->response->body($notifmessage); // renvoi du choix utilisateur
                        return $this->response;
                                                }
                                                // accès à la page hors d'une requête Ajax
                                                else {
                                                  throw new NotFoundException(__('Cette page n\'existe pas.'));
                                                }
            }

/**
     * Méthode notifcite
     *
     * Mise à jour des paramètres de notifications de citation 0  = non, 1 = oui
     *
*/
        public function notifcite()
            {

                if ($this->request->is('ajax')) {

                                                $query_cite = $this->Settings->query()
                                                                            ->update()
                                                                            ->set(['notif_cite' => $this->request->data('choix')])
                                                                            ->where(['user_id' => $this->Auth->user('username') ])
                                                                            ->execute();

                             $this->response->body($notifcite); // renvoi du choix utilisateur
                            return $this->response;
                                                }
                                                // accès à la page hors d'une requête Ajax
                                                else {
                                                  throw new NotFoundException(__('Cette page n\'existe pas.'));
                                                }
            }

/**
     * Méthode notifpartage
     *
     * Mise à jour des paramètres de notifications de partage 0  = non, 1 = oui
     *
*/

        public function notifpartage()
            {

                if ($this->request->is('ajax')) {

                                                    $query_partage = $this->Settings->query()
                                                                                    ->update()
                                                                                    ->set(['notif_partage' => $this->request->data('choix')])
                                                                                    ->where(['user_id' => $this->Auth->user('username') ])
                                                                                    ->execute();

                             $this->response->body($notifpartage); // renvoi du choix utilisateur
                            return $this->response;
                                                }
                                                // accès à la page hors d'une requête Ajax
                                                else {
                                                  throw new NotFoundException(__('Cette page n\'existe pas.'));
                                                }
            }

/**
     * Méthode notifabo
     *
     * Mise à jour des paramètres de notifications de nouvel abonnement 0  = non, 1 = oui
     *
*/
        public function notifabo()
            {

                if ($this->request->is('ajax')) {

                                                $query_abo = $this->Settings->query()
                                                                            ->update()
                                                                            ->set(['notif_abo' => $this->request->data('choix')])
                                                                            ->where(['user_id' => $this->Auth->user('username') ])
                                                                            ->execute();


                             $this->response->body($notifabo); // renvoi du choix utilisateur
                            return $this->response;
                                                }
            }

/**
     * Méthode notifcomm
     *
     * Mise à jour des paramètres de notifications de nouveau commentaire 0  = non, 1 = oui
     *
*/
        public function notifcomm()
            {

                if ($this->request->is('ajax')) {

                                                $query_comm = $this->Settings->query()
                                                                            ->update()
                                                                            ->set(['notif_comm' => $this->request->data('choix')])
                                                                            ->where(['user_id' => $this->Auth->user('username') ])
                                                                            ->execute();


                             $this->response->body($notifcomm); // renvoi du choix utilisateur
                            return $this->response;
                                                }
                                                // accès à la page hors d'une requête Ajax
                                                else {
                                                  throw new NotFoundException(__('Cette page n\'existe pas.'));
                                                }
            }

}
