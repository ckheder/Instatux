<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;

/**
 * Controller Messagerie
 *
 * Gestion de la messagerie
 *
 * @property \App\Model\Table\MessagerieTable
 */
class MessagerieController extends AppController
{

    public $components = array('RequestHandler');

    // pagination limitée à 8 messages par ordre décroissant de la date

    public $paginate = [
                          'limit' => 8,
                          'order' => [
                                      'Messagerie.created' => 'desc'
                                      ]
    ];

            public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']); // on empeche l'accès a l'index si je ne suis pas auth
    }

            public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Conversation');
        $this->loadModel('Blocage');
        $this->loadModel('Settings');
    }

    /**
     * Méthode Index
     *
     * Affiche une cell contenant toute les conversations de l'utilisateur courant qui ne sont pas masquées (statut 1), et un formulaire de nouveau message
     *
     */
      public function index()
    {
        $this->viewBuilder()->layout('messagerie');
        $this->set('title', 'Messagerie');
    }

    /**
     * Méthode Add
     *
     * Ajout d'un message : soit ajouter à une conversation soit en crée une nouvelle
     *
     * Paramètre : idtweet-> identifiant du tweet dont on veut la liste des likes
     */
    public function add()
    {

       if ($this->request->is('ajax')) {


        // url d'origine : profil | index messagerie | conversation

          $page = $this->request->referer(true);

        // url messagerie

          $url_messagerie = str_replace('/instatux','',Router::url(['_name' => 'messagerie']));

        // destinataire du message

          $destinataire = $this->request->data['destinataire'];

// si je viens de la page index messagerie ou de la modale envoi de message depuis le profil

              if($page == $url_messagerie OR preg_match('/\/(\w+)/m', $page))
            {

                //test si je suis bloqué par le destinataire

                 if($this->test_blocage($destinataire) == 1)
              {

                  //renvoi d'une réponse 'blocage'
                  $reponse = 'blocage';
                  $this->response->body(json_encode($reponse));
                  return $this->response;              
              }
                else
              {

                // récupération ou génération d'une nouvelle conversation avec mon destinataire

                  $conversationresult = $this->get_conv($destinataire);

                  $conversation = $conversationresult['conversation']; // identifiant conversation

                  $new_conv = $conversationresult['new_conv']; // 0 : nouvelle conversation, 1 : conversation existante

                  $statut = $conversationresult['statut'];

                  //dd($statut);

              }

              $typeconv = 'duo';
           } 

//conversation duo

            if(isset($this->request->data['typeconv']))
          {

            $typeconv = $this->request->data['typeconv'];

              if($typeconv == 'duo')
            {

            //récupération de la conversation

              $conversation = $this->request->data['conversation'];

              $new_conv = 1;
                                  
            // test si je suis bloqué par le destinataire

                 if($this->test_blocage($destinataire) == 1)
              {

                  //renvoi d'une réponse 'blocage'
                  $reponse = 'blocage';
                  $this->response->body(json_encode($reponse));
                  return $this->response;              
              }

            }

          }

//création du nouveau message

            // création d'une nouvelle entité "messagerie"

            $message = $this->Messagerie->newEntity();

            $messages = strip_tags($this->request->data('message')); // echappement des caractères dans le message envoyé

            $data = array(
                          'user_id' => $this->Auth->user('username'), // expediteur                          
                          'message' =>  AppController::linkify_content($messages), // message
                          'conv' => $conversation, // id conversation
            // données servant à la création si besoin d'une nouvelle conversation et d'une notification de nouveau message
                          'new_conv' => $new_conv, // 1-> conversation existante, 0 -> conversation inexistante
                          'destinataire' => $destinataire
                          );


            $message = $this->Messagerie->patchEntity($message, $data);

            if ($this->Messagerie->save($message))
          {

            // test de l'acceptation de notif message et si la conv existe

            $notif = $this->testnotifmessage($destinataire, $conversation);

              // évènement lié à la création d'un nouveau message : on crée une notif de nouveau message ou une nuvelle conversation si besoin

              if($notif == 'oui' OR $new_conv == 0 OR $statut)
            {

              $event = new Event('Model.Messagerie.afterAdd', $this, ['message' => $message,'notif' => $notif, 'statut' => $statut]);
              $this->eventManager()->dispatch($event);

            }

              // fin évènement

                if($page == $url_messagerie OR preg_match('/\/(\w+)/m', $page)) // je viens de la page messagerie, je le notifie en JSON pour la redirection
              {
                $data['origin'] = 1;
              }
                $this->response->body(json_encode($data));
          }
            else
          {
                $reponse = 'probleme';
                $this->response->body(json_encode($reponse));
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
     * Méthode View
     *
     * Affichage d'une conversation
     *
     */
      public function view()
    {
        
          if ($this->request->is('ajax')) 
        {
         
        // on vérifie si j'ai le droit de voir cette conversation

          $statut = AppController::verifconv($this->Auth->user('username'), $this->request->getParam('id'));

          if($statut == 0) // je ne peut voir cette conversation
         {

          $this->Flash->error(__('Vous n\'avez pas l\'autorisation de voir cette conversation'));

                // redirection vers le nouveau profil

                return $this->redirect('/messagerie');

            die();
         }
          else
         {
      
          // récupération du type de conv

            $type_conv = $this->get_type_conv($this->request->getParam('id'));

            $message = $this->Messagerie->find()->select([
                                                          'Messagerie.user_id',
                                                          'Messagerie.message',
                                                          'Messagerie.created',
                                                        ])
                                                ->where(['Messagerie.conv' => $this->request->getParam('id')])
                                                ->order(['Messagerie.created' => 'DESC'])
                                                ->contain(['Conversation']);

            $this->set('message', $this->Paginator->paginate($message, ['limit' => 8]));
           
            $this->set('type_conv', $type_conv);

              if($type_conv == 'duo')
            {
                  $destinataire = $this->get_destinataire($this->request->getParam('id'));

                  $this->set('destinataire', $destinataire); 
                                    
            }
           
        }

    }
      else 
    {
      throw new NotFoundException(__('Cette page n\'existe pas.'));
    }
  }

           /**
     * Méthode listconv
     *
     * Actualisation de la liste de mes conversation après envoi d'un message depuis la messagerie ou au chragement de la page
     *
     * Paramètre : statut = 0 -> booléen false donc visible
     *
     * Sortie : liste de mes conversations
     */

             public function listconv()
    {

            if ($this->request->is('ajax')) 
        {
      
      $connection = ConnectionManager::get('default');

      $conv = $connection->execute('SELECT M.conv AS conv, DM.message AS message, DM.created AS created, DM.user_id AS user_id 
                                    FROM ( SELECT conv, MAX( created ) AS max_date FROM messagerie GROUP BY conv ) M 
                                    INNER JOIN conversation C ON M.conv = C.conv 
                                    INNER JOIN messagerie DM ON C.conv = DM.conv 
                                    INNER JOIN users U ON DM.user_id = U.username AND M.max_date = DM.created 
                                    WHERE C.user_conv = :username
                                    AND C.statut = 0
                                    ORDER BY DM.created DESC ', ['username' => $this->Auth->user('username')]);


        $this->set('conv' , $conv); // liste des conversation
             
        $this->set('authname', $this->Auth->user('username'));

        }

          else 
      {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
      }

    }


        /**
     * Méthode test_blocage
     *
     * Vérification si le destinataire ne m'a pas bloqué
     *
     * Paramètre : $username -> destinataire du message
     *
     * Sortie : 0 -> non bloqué | 1 -> bloqué
     */

        private function test_blocage($username) // on vérifie que le destinataire ne m'a pas bloqué
    {
        

        $verif_blocage = $this->Blocage->find()
                                        ->where(['bloqueur' => $username])
                                        ->where(['bloquer' => $this->Auth->user('username') ])
                                        ->count();
         return $verif_blocage;
    }

            /**
     * Méthode testnotifmessage
     *
     * Vérification si le destinataire accepte les notifications de message et si elle n'a pas supprimé la conversation
     *
     * Paramètre : $username -> destinataire du message
     *
     * Sortie : oui -> accepte | 1 -> refuse
     */

      private function testnotifmessage($username,$conv)
    {

      // vérification si conversation supprimé

      $verif_conv = $this->Conversation->find()
                                        ->where(['user_conv' => $username])
                                        ->where(['conv' => $conv])
                                        ->where(['statut' => 0]); // statut 0 -> conversation affichée

        if (!$verif_conv->isEmpty())
        {

        $verif_notif = $this->Settings->find()
                                      ->select(['notif_message'])
                                      ->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // récupération du paramètre
      {
          $settings_notif = $verif_notif['notif_message'];
      }

             return $settings_notif;
           }
            else
           {
            return 'non';
           }
    }

            /**
     * Méthode gettypeconv
     *
     * Récupération du type de conversation
     *
     * Paramètre : $conv -> identifiant de la conversation
     *
     * Sortie : duo / multiple
     */
      private function get_type_conv($conv)
    {

      $type_conv = $this->Conversation->find()
                                        ->select(['type_conv'])
                                        ->where(['conv' => $conv]);

                  foreach ($type_conv as $type_conv) // récupération du paramètre
                {
                  $type_conv = $type_conv['type_conv'];
                }
                                 
             return ($type_conv);
    }

                /**
     * Méthode get_destinataire
     *
     * Récupération du destinataire d'une conversation
     *
     * Paramètre : $conv -> identifiant de la conversation
     *
     * Sortie : nom du destinataire
     */

        private function get_destinataire($conv)
    {

        $dest = $this->Conversation->find()
                                    ->select(['user_conv'])
                                    ->where(['conv' => $conv])
                                    ->andwhere(['user_conv !=' => $this->Auth->user('username')]);

                    foreach ($dest as $dest) // récupération du paramètre
                {
                  $dest = $dest['user_conv'];
                }
                                 
             return ($dest);
    }

                    /**
     * Méthode get_conv
     *
     * Récupération d'une éventuelle conversation
     *
     * Paramètre : $conv -> identifiant de la conversation
     *
     * Sortie : nom du destinataire
     */

        private function get_conv($destinataire)
    {

                        //récupération d'une éventuelle conversation existante

              $otherparticipant = $this->Conversation
                                        ->find()
                                        ->select(['conv'])
                                        ->where(['user_conv' =>  $destinataire])
                                        ->andwhere(['type_conv' => 'duo']);

              $checkconv = $this->Conversation
                                ->find()
                                ->select(['conv','statut'])
                                ->where(['user_conv' =>  $this->Auth->user('username') ]) // moi
                                ->andwhere(['conv IN' => $otherparticipant]); //destinataire

                if ($checkconv->isEmpty()) // si pas de résultat, on crée une nouvelle conversation
              {
                $conversation = rand();// création d'id de conversation aléatoire
                $new_conv = 0; // conversation inexistante, variable à 0
              }
                else // recupération de la conversation
              {
                  foreach ($checkconv as $row)
                {
                  $conversation = $row['conv'];
                  $statut = $row['statut'];
                  $new_conv = 1; // conversation existante
                }
              }

              return array('conversation' => $conversation,
                            'statut' => $statut,
                            'new_conv' => $new_conv);
    }

       


}
