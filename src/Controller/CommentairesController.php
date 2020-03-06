<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Controller Commentaires
 *
 * Gestion complète des commentaires
 *
 * @property \App\Model\Table\CommentairesTable
 */
class CommentairesController extends AppController
{

    /**
     * Méthode Add
     *
     * Ajout d'un commentaire
     *
     * Sorties : commdesac -> les commentaires sont désactivés | $data -> tableau contenant les informations du commentaires pour l'afficher
     */
      public function add()
    {

          if ($this->request->is('ajax'))
        {
            // On vérifie si les commentaire sont désactivé | paramètre : $this->request->data('id') -> id du tweet

              if ($this->allowcomm($this->request->data('id')) == 1)
            {
                $reponse = 'commdesac';// commentaire désactivé, renvoi d'une réponse AJAX

                $this->response->body(json_encode($reponse));
            }

              else
            {

            // création d'une nouvelle entité

              $commentaire = $this->Commentaires->newEntity();

            // suppression des balises éventuelles

              $comm = strip_tags($this->request->data('comm'));

            // création manuelle d'un identifiant de commentaire

              $idcomm = $this->idcomm();

            $data = array(
                          'id' => $idcomm, // identifiant commentaire
                          'comm' =>  AppController::linkify_content($comm), // commentaire parsé
                          'tweet_id' => $this->request->data('id'), // id du tweet
                          'user_id' => $this->Auth->user('id'), //posteur du commentaire

            // pour une notification de nouveau commentaire

                          'auttweet' => $this->request->data('auttweet'), // auteur du tweet, pas du comm
                          'nom_session' => $this->Auth->user('username'),// nom de l'auteur du comm
                        );

            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);

              if ($this->Commentaires->save($commentaire)) // insertion de commentaire réussi
            {

                    if($this->request->data['auttweet'] != $this->Auth->user('username')) // si je ne suis pas l'auteur du tweet, on vérifie si j'accepte les notifs de comm
                  {
                        if($this->testnotifcomm($this->request->data['auttweet']) == "oui") // j'accepte
                      {

                        $event = new Event('Model.Commentaires.afterAdd', $this, ['commentaire' => $commentaire]);
                        $this->eventManager()->dispatch($event);
                      }

                   }
                      $this->response->body(json_encode($data)); // réponse AJAX
            }
              else
            {
                $reponse = 'probleme'; // impossible de poster
                $this->response->body(json_encode($reponse));
            }

            }
                return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
  }

    /**
     * Méthode Edit
     *
     * Modification d'un commentaire
     *
     * Sorties : $data -> tableau contenant le commentaires modifié | probleme -> mise à jour impossible
     */
    public function edit()
    {

          if ($this->request->is('ajax'))
        {

          // élimination de balise HTML

            $comm = strip_tags($this->request->data('comm'));

          // Mise à jour commentaire

            $query = $this->Commentaires->query()
                            ->update()
                            ->set(['comm' => AppController::linkify_content($comm), 'edit' => 1]) // edit -> 1  : provoquera l'affichage de la mention "modifié" sur le commentaire
                            ->where(['id' => $this->request->getParam('id')])
                            ->Where(['user_id' => $this->Auth->user('id')])
                            ->execute();

          //mise à jour réussie

              if($query)
            {
                $data = array(
                              'idcomm' => $this->request->getParam('id'),
                              'comm' => AppController::linkify_content($comm),
                              'reponse' => 'Commentaire modifié avec succès'
                              );

            $this->response->body(json_encode($data)); // réponse AJAX

            }
              else
            {
                $reponse = 'probleme';
                $this->response->body($reponse);
            }
              return $this->response;
        }
        // accès à la page hors d'une requête Ajax
          else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

    /**
     * Méthode Delete
     *
     * Suppression d'un commentaire
     *
     * Sorties : suppcommfail -> impossible de supprimer le commentaire | suppcommok -> suppression réussie
     */
      public function delete()
    {

        if ($this->request->is('ajax'))
      {

          // je vérifie si je suis bien le propriétaire du commentaire ou le propriétaire du tweet ou que le tweet figure sur ma timeline

      $query = $this->Commentaires->find()
                                  ->where(['Commentaires.user_id' => $this->Auth->user('id')])
                                  ->orWhere(['Tweet.user_id' => $this->Auth->user('username')])
                                  ->orWhere(['Tweet.user_timeline' => $this->Auth->user('username')])
                                  ->andWhere(['Tweet.id_tweet' => $this->request->data('idtweet')])
                                  ->contain(['Tweet']);

              if($query->isEmpty()) // pas de résultat
            {
              $reponse = 'suppcommfail';
            }
              else
            {

              $entity = $this->Commentaires->get($this->request->data('idcomm')); // on récupère l'entité correspondant a l'id du comm
              $result = $this->Commentaires->delete($entity); // on supprime cette entité

                if ($result)
              {
                $reponse = 'suppcommok'; // suppression réussie
              }
                else
              {
                $reponse = 'suppcommfail'; // échec de la suppression
              }

            }

                $this->response->body(json_encode($reponse)); // réponse AJAX
                return $this->response;
      }
      // accès à la page hors d'une requête Ajax
        else 
      {
        throw new NotFoundException(__('Cette page n\'existe pas.'));
      }

    }
    /**
     * Méthode Testnotifcomm
     *
     * On vérifie si l'auteur du tweet accepte les notifications de commentaire
     *
     * Sorties : oui -> l'auteur accepte les notifications de commentaire | non -> l'auteur n'accepte pas les notifications de commentaire
     */

      private function testnotifcomm($username)
    {
        $this->loadModel('Settings'); // chargement du modèle Settings

        $verif_notif = $this->Settings->find()
                                      ->select(['notif_comm'])
                                      ->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // recupération du paramètre de notification commentaire
      {
          $settings_notif = $verif_notif['notif_comm'];
      }

        return $settings_notif;
    }



    /**
     * Méthode idcomm
     *
     * Calcul d'un nouvel identifiant de commentaire et vérification si il n'existe pas déjà
     *
     * Sorties : $idcomm -> nouvel id de commentaire
     */

      private function idcomm()
    {

      $idcomm = rand();

      // on vérifie si il existe déjà

      $query = $this->Commentaires->find()->select(['id'])->where(['id' => $idcomm]);

        if ($query->isEmpty()) // il n'existe pas
     {
        return $idcomm;
     }
        else // on recalcul
      {
        idcomm();
      }

    }

        /**
     * Méthode Allowcomm
     *
     * On vérifie , pour un tweet donné en paramètre, les commentaires sont activés
     *
     * Paramètre : $idtweet -> identifiant du tweet à tester
     *
     * Sorties : allowcomm -> 1 : commentaire désactivé | 0 : commentaire ctivé
     */

      private function allowcomm($idtweet)
    {
      $this->loadModel('Tweet'); // chargement du modèle Tweet

        $allowcomment = $this->Tweet->find()->select(['allow_comment'])->where(['id_tweet' => $idtweet]);

        foreach ($allowcomment as $allowcomment) // recupération du résultat
      {
        $allowcomm = $allowcomment['allow_comment'];
      }

              if($allowcomm == 0)
            {
              return $allowcomm = 0; // commentaire activé
            }
              else
            {
              return $allowcomm = 1; // commentaire désactivé
            }
    }

}
