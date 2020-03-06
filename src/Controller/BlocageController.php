<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Blocage Controller
 *
 * Gestion des blocages
 *
 * @property \App\Model\Table\BlocageTable $Blocage
 *
 */
class BlocageController extends AppController
{

    /**
     * Méthode Add
     *
     * Blocage d'un utilisateur
     *
     * Sortie : réponse JSON sur le résultat de l'opération
     * - alreadyblock -> utilisateur déjà bloqué
     * - addblockok -> blocage réussi
     */
        public function add()
    {

            if ($this->request->is('ajax'))
        {

        // on vérifie si il y'a déjà un blocage

            if($this->check_blocage($this->request->getParam('username')) == 1)
        {
           $reponse = 'alreadyblock'; // déjà bloqué
        }
            else // création d'un nouveau blocage
        {
           $data = array(
                            'bloqueur' => $this->Auth->user('username'), // moi
                            'bloquer' => $this->request->getParam('username'), // username -> paramètre URL de l'utilisateur à bloqué
            );

            $blocage = $this->Blocage->newEntity(); // création d'une nouvelle entité

            $blocage = $this->Blocage->patchEntity($blocage, $data);

                    if ($this->Blocage->save($blocage))
                {

                    $reponse = 'addblockok'; // blocage réussi

                }
                    else
                {
                    $reponse = 'probleme';
                }
        }

            $this->response->body($reponse); // réponse AJAX
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
     * Débloquer un utilisateur
     *
     * Sortie : réponse JSON sur le résultat de l'opération
     * - deleteblockok -> déblocage réussi
     */

    public function delete()
    {

            if ($this->request->is('ajax'))
        {

            // suppression de l'entité

            $query = $this->Blocage->query();

            $query->delete()
                  ->where(['bloqueur' => $this->Auth->user('username')])
                  ->where(['bloquer' => $this->request->getParam('username')])
                  ->execute();

                if ($query)
            {
                $reponse = 'deleteblockok'; // suppression réussi
            }

                else
            {
                $reponse = 'probleme';
            }

                $this->response->body($reponse); // réponse AJAX
                return $this->response;
        }
        // accès à la page hors d'une requête Ajax
            else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }

    }
        /**
     * Méthode Check_blocage
     *
     * Vérifie si il n'y a pas déjà un blocage effectif
     *
     * Paramètre : $username -> nom de l'utilisateur
     * Sortie : 0 -> Aucun blocage | 1-> J'ai déjà bloqué cet utilisateur
     */

        private function check_blocage($username = null)
    {
        $query = $this->Blocage->find()->where(['bloqueur' => $this->Auth->user('username')])->where(['bloquer' => $username]);

        $resultat = $query->count();

        return $resultat;
    }
}
