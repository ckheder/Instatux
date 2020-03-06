<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Routing\Router;



/**
 * Conversation Controller
 *
 *Gestion des conversations entre deux membres
 *
 * @property \App\Model\Table\ConversationTable
 */
class ConversationController extends AppController
{



    /**
     * Méthode actionconv
     *
     * Mise à jour du statut d'une conversation : 0 -> conversation désactivée,1 -> conversation active
     *
     * ATTENTION : les messages ne sont pas supprimés, la conversation est juste masquée
     *
     * Paramètre : $this->request->getParam('id') -> id de la conversation
     *
     * Sorties : actconvok -> activation conversation avec succès | desactconvok -> desactivation conversation avec succès 
     */
        public function delete()
    {

            if ($this->request->is('ajax'))
        {

                $idconv = $this->request->data['idconv']; // identifiant de la conversation à suppprimer

                $query = $this->Conversation->query()
                        ->update()
                        ->set(['statut' => 1])
                        ->where(['user_conv' => $this->Auth->user('username')])
                        ->where(['conv' => $idconv ])
                        ->execute();

                if ($query) // suppression réussie d'une conversation
            {

                $data['reponse'] = 'suppconvok';

            }

                else // echech suppression conversation
            {
                $data['reponse'] = 'suppconvfail';
            }

                $this->response->body(json_encode($data)); // réponse AJAX

                return $this->response;
        }
        // accès à la page hors d'une requête Ajax
            else 
        {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }

   }

     /**
     * Méthode adduser
     *
     * Vérification si le user invité ne fais pas déjà partie de la conversation et si non envoi d'une notification d'invitation
     *
     * Paramètre : adduser : utilisateur invité | conv : id de la conversation
     *
     * Sorties : invitok -> envoi d'invitation réussie | dejain -> fais déjà partie de la conversation
     */
    public function adduser()
    {

            if ($this->request->is('ajax'))
        {

            $typeconv = $this->request->data['typeconve']; // type de conversation
            $adduser = $this->request->data['adduser']; // nom de l'utilisateur à ajouter
            $conv = $this->request->data['conv']; // identifiant de la conversation

                    if(AppController::verifconv($adduser, $conv) == 0) // cette utilisateur ne fait pas partie de la conversation
                {
                    $data = array(
                                    'user' => $adduser,
                                    'conv' => $conv,
                                    'sender' => $this->Auth->user('username')    
                                );

                // création de l'entité 

        $join = $this->Conversation->newEntity();

        $join->conv = $conv;

        $join->user_conv = $adduser;

        $join->type_conv = 'multiple';

        //se baser sur id conv pour mettre à jour vers multiple

                if($this->Conversation->save($join))
            {

                // mise à jour de la ligne de conv duo vers multiple

                    if($typeconv == 'duo')
                {
                        $query = $this->Conversation->updateAll(
                                ['type_conv' => 'multiple'], //la conversation devient multiple
                                ['conv' => $conv ]); 
                }

                    $event = new Event('Model.Conversation.invit', $this, ['invit' => $data]);
                    $this->eventManager()->dispatch($event);

                    $reponse = 'invitok';
                }
                    else
                {
                    $reponse = 'probleme';
                }
                
                }
                    else
                {
                    $reponse = 'dejain';
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

}
