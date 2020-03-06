<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Request;
use Cake\Event\Event;

/**
 * Controller Notifications
 *
 * Gestion complète des notifications
 *
 * @property \App\Model\Table\NotificationsTable
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
     * Méthode Index
     *
     * Retourne la liste de toute mes notifications lues et non lues
     *
     */
      public function index()
    {
      $this->viewBuilder()->layout('notifications');

      $this->set('title', 'Vos notifications'); // titre de la page

      // Récupération de mes notifications par odre décroissant de date

      $notification = $this->Notifications->find()
                                          ->where(['username' =>  $this->Auth->user('username') ])
                                          ->order(['created'=> 'DESC']);


          $this->set('notification', $this->Paginator->paginate($notification, ['limit' => 10]));
    }
    /**
     * Méthode Delete
     *
     * Suppression d'une notification
     *
     * Sorties : problème -> impossible de supprimer le commentaire | suppok -> suppression réussie
     */
        public function delete()
    {
        if ($this->request->is('ajax'))
      {
            $query = $this->Notifications->query();
            $query->delete()
                  ->where(['username' => $this->Auth->user('username')])
                  ->where(['id_notif' => $this->request->getParam('id')])
                  ->execute();

            if ($query) // suppression réussie
          {
               $reponse = 'suppok';
          }
            else // échec suppression
          {

                $reponse = 'problème';
          }

            $this->response->body($reponse); // renvoi d'une réponse AJAX
            return $this->response;
      }
      // accès à la page hors d'une requête Ajax
        else 
      {
        throw new NotFoundException(__('Cette page n\'existe pas.'));
      }

    }
    /**
     * Méthode allNotiflue
     *
     * Indique que toutes les notifications sont lues
     *
     *Sortie : ok -> mise à jour effectuée | erreur -> problème lors de la mise à jour
     */
        public function allNotiflue()
      {

          if ($this->request->is('ajax'))
        {
          $query = $this->Notifications->updateAll(
                                                    ['statut' => 1], // champs à mettre à jour : passer de 0 à 1 (1 -> notifcation lue)
                                                    ['statut' => 0, 'username' => $this->Auth->user('username') ]); // conditions : statut à 0 (donc non lue) et user_name -> moi
                 if($query)
                {
                  $reponse = 'ok';
                }
                  else
                {
                 $reponse = 'erreur';
                }

          $this->response->body($reponse); // renvoi d'une réponse AJAX
          return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
      }
    /**
     * Méthode singleNotiflue
     *
     * Indique qu'une notification est lue
     *
     *Sortie : ok -> mise à jour effectuée | erreur -> problème lors de la mise à jour
     */
        public function singleNotiflue()
      {
          if ($this->request->is('ajax'))
        {
          $query = $this->Notifications->query();
          $query->update()
                ->set(['statut' => 1])
                ->where(['username' => $this->Auth->user('username')])
                ->where(['id_notif' => $this->request->getParam('id')])
                ->execute();

            if($query)
          {
            $reponse = 'ok';
          }
            else
          {
            $reponse = 'erreur';
          }

              $this->response->body($reponse); // renvoi d'une réponse AJAX
              return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
      }

    /**
     * Méthode allDeletenotif
     *
     * Supprimer toutes les notifications
     *
     *Sortie : ok -> mise à jour effectuée | erreur -> problème lors de la mise à jour
     */
        public function allDeletenotif() // indiquer que toutes les notifications sont lues
      {
          if ($this->request->is('ajax'))
        {
          $query = $this->Notifications->deleteAll(['username' => $this->Auth->user('username')]);

            if($query)
          {
            $reponse = 'ok';
          }

            else
          {
            $reponse = 'erreur';
          }

              $this->response->body($reponse); // renvoi d'une réponse AJAX
              return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
      }

    /**
     * Méthode nbnotif
     *
     * Calcul du nombre de notif non lues -> pour l'indicateur de notif non lue de la brre de menu
     *
     *Sortie : nb_notif : nombre de notif non lue
     */
        public function nbnotif()
      {

        $nb_notif = $this->Notifications->find()
                                        ->where(['username' => $this->Auth->user('username')])
                                        ->where(['statut' => 0])
                                        ->count();
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
