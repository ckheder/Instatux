<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;


/**
 * Controller Abonnement
 *
 * Gestion complète des abonnements
 *
 * @property \App\Model\Table\AbonnementTable
 */
    class AbonnementController extends AppController
{

    public $paginate = [
                        'limit' => 10,
                        'maxLimit' => 30

                        ];

    public $components = array('RequestHandler');



        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['abonnement','abonnes','demande','suggestionmoi']); // accès interdit aux abonnés, abonnement et demande des gens non connectés
    }

        public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Users');
        $this->loadModel('Settings');
    }

    /**
     * Méthode Abonnement
     *
     * Retourne la liste des abonnements dela personne
     *
     * Paramètre : username donné en URL
     */


        public function abonnement()
    {
           $this->viewBuilder()->layout('follow');

           // titre de page dynamique

                if($this->request->getParam('username') == $this->Auth->user('username')) // si je suis sur mes abonnements
            {

                $this->set('title', 'Mes abonnements');
            }

                else // si je suis sur les abonnements d'une autre personne
            {
                $this->set('title', 'Liste des abonnements de '.$this->request->getParam('username').'');
            }

        // récupération des informations sur les personnes que je suis

            $abonnement_valide = $this->Abonnement->find()

        ->select(['Users.username','Users.description'])

        ->where(['Abonnement.user_id' =>  $this->request->getParam('username') ])

        ->where(['etat' => 1])

        ->order((['Users.username' => 'ASC']))

        ->contain(['Users']);

        $nb_abonnement = $abonnement_valide->count(); // nombre d'abonnement

            if ($nb_abonnement === 0) // aucun résultat
        {
            $this->set('nbabonnement_valide',0);
        }
            else
        {
            $this->set('count_abonnement', $nb_abonnement);

            $this->set('abonnement_valide', $this->Paginator->paginate($abonnement_valide, ['limit' => 30]));
        }

    }

    /**
     * Méthode Abonné
     *
     * Retourne la liste des abonnés
     *
     * Paramètre : username donné en URL
     */

            public function abonnes()
        {
            $this->viewBuilder()->layout('follow');

            //titre de page dynamique

                if($this->request->getParam('username') == $this->Auth->user('username')) // si je suis sur mes abonnés
            {

                $this->set('title', 'Mes abonné(s)');
            }

                else // si je suis sur les abonnés d'une autre personne
            {
                $this->set('title', 'Liste des abonnés de '.$this->request->getParam('username').'');
            }
                
        // récupération des informations sur les personnes qui me suivent

        $abonne_valide = $this->Abonnement->find()

        ->select(['Users.username','Users.description'])

        ->leftjoin(
            ['Users'=>'users'],
            ['Users.username = (Abonnement.user_id)']
                )

        ->where(['suivi' =>  $this->request->getParam('username') ])

        ->where(['etat' => 1])

        ->order((['Users.username' => 'ASC']));

        $nb_abonnes = $abonne_valide->count(); // nombre d'abonnés

            if ($nb_abonnes === 0) // aucun résultat
        {
            $this->set('nbabonne_valide',0);
        }
            else
        {
            $this->set('count_abonnes', $nb_abonnes);

            $this->set('abonne_valide', $this->Paginator->paginate($abonne_valide, ['limit' => 30]));
        }

}

    /**
     * Méthode Demande
     *
     * Retourne la liste des demande d'abonnements (page accessible uniquement par moi)
     *
     * Paramètre : $this->Auth->user('username') -> variable Auth contenant l'username
     */

        public function demande()
    {

        $this->viewBuilder()->layout('follow');

        $this->set('title', 'Demande(s) de suivi');

        // Récupération des informations sur mes demandes d'abonnements

         $abonnement_attente = $this->Abonnement->find()

        ->select([
            'Users.username',
            ])

        ->leftjoin(
            ['Users'=>'users'],
            ['Users.username = (Abonnement.user_id)']
                )

        ->where(['suivi' =>  $this->Auth->user('username')])

        ->where(['etat' => 0])

        ->order((['Users.username' => 'ASC']))

        ->limit(10);

        $nb_attente = $abonnement_attente->count(); // nombre de demande en attente

            if ($nb_attente === 0) // aucun résultat
        {
            $this->set('nbabonnement_attente',0);
        }
            else
        {
            $this->set('nb_attente', $nb_attente);

            $this->set('abonnement_attente', $this->paginate($abonnement_attente, ['limit' => 10]));
        }

    }


    /**
     * Méthode Add
     *
     * Création d'un nouvel abonnement
     *
     * Paramètre : Suiveur : $this->Auth->user('username'), Suivi : $this->request->getParam('username')
     */


        public function add()
    {

        // requête Ajax uniquement

        if ($this->request->is('ajax')) 
    {

        //test si je suis bloqué

                if($this->test_blocage($this->request->getParam('username')) == 1)
              {

                  //renvoi d'une réponse 'blocage'
                  $reponse = 'blocage';
                  $this->response->body($reponse);
                  return $this->response;              
              }

        // On vérifie si le profil concerné est privé ou non

        $check_profil = $this->check_type_profil($this->request->getParam('username'));

            if($check_profil == 1) // profil privé -> correspond à une demande
        {

                // On vérifie si je ne suis pas déjà abonné

            $abonnement_verif = $this->check_abo($this->Auth->user('username'));

                if ($abonnement_verif == 0) // si pas de résultat, on crée une nouvelle ligne
            {
                $data = array(
                                'user_id' => $this->Auth->user('username'), // suiveur
                                'suivi' => $this->request->getParam('username'), // suivi
                                'etat' => 0, // demande non validée
                            );

            $abonnement = $this->Abonnement->newEntity();

            $abonnement = $this->Abonnement->patchEntity($abonnement, $data);

                    if ($this->Abonnement->save($abonnement))
                {

                    // Évènement indiquant la création d'une nouvelle entité donc création d'une notification de demande d'abonnement
                 
                    $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);

                    $this->eventManager()->dispatch($event);

                    $reponse = 'demandeok'; // réponse AJAX
                }

                    else
                {

                $reponse = 'probleme'; // réponse AJAX en cas de problème

                }
            }
        }

            else // profil public
        {

            // on vérifie quand même si on est pas déjà abonné

            $check_abo = $this->check_abo($this->Auth->user('username'));

                if($check_abo === 0) // si pas de résultat
            {

                $data = array(
                                'user_id' => $this->Auth->user('username'), // suiveur
                                'suivi' => $this->request->getParam('username'), // suivi
                                'etat' => 1, // abonnement actif
                            );

            // création et sauvegarde d'une nouvell entité abonnement

                $abonnement = $this->Abonnement->newEntity();

                $abonnement = $this->Abonnement->patchEntity($abonnement, $data);

                    if ($this->Abonnement->save($abonnement))
                {
                        if($this->testnotifabo($this->request->getParam('username')) == "oui") // la personne accepte les notifications d'abonnements, création d'une nouvelle ligne
                    {

                        $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);
                        $this->eventManager()->dispatch($event);

                    }

                    $reponse = 'abook'; // réponse AJAX
                }

                    else
                {

                $reponse = 'probleme'; // réponse AJAX

                }
            }

        }

        // envoi des réponses AJAX

            $this->response->body($reponse);
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
     * Suppression d'un abonnement
     *
     * Paramètre : User_id : $this->Auth->user('username'), Suivi : $this->request->getParam('username')
     */

        public function delete($id = null)
    {
            if ($this->request->is('ajax')) 
        {

            $query = $this->Abonnement->query();

            $query->delete()
                    ->where(['user_id' => $this->Auth->user('username')]) //suiveur -> moi
                    ->where(['suivi' => $this->request->getParam('username')]) // suivi -> abonnement que je veut supprimer
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

    // accès à la page hors d'une requête Ajax

            else 
        {
            throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

    /**
     * Méthode IndexMessagerie
     *
     * Liste de mes abonnements pour la messagerie, personne que je suis
     *
     * Autocomplete Ajax
     */

    public function indexmessagerie()
    {

        if ($this->request->is('ajax')) {

        //désactivation du chargement d'une vue

        $this->autoRender = false;

        //requete

        $name = $this->request->query('term'); // mot clé de recherche

        $abonnement = $this->Users->find()->select(['username'])

        ->where(['username !=' =>  $this->Auth->user('username')])

        ->where(['username LIKE '  => ''.$name.'%']);

                foreach($abonnement as $result)
            {

               $resultArr[] =  array('value' => $result->username);

            }

            echo json_encode($resultArr); // On retourne un tableau JSON

        }

// accès à la page hors d'une requête Ajax

        else 
        {
            throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

    /**
     * Méthode Validate
     *
     * Accepter ou non une demande d'abonnement
     *
     * Paramètres : $this->request->getParam('act') -> accept|refuse
     */

    public function validate()
{
    if ($this->request->is('ajax')) {

            if ($this->request->getParam('act') === 'accept') // valider l'abonnement
        {
            $query = $this->Abonnement->query() // Mise à jour en base de la ligne d'abonnement
                            ->update()
                            ->set(['etat' => 1])
                            ->where(['user_id' => $this->request->getParam('username') ])
                            ->Where(['suivi' => $this->Auth->user('username')])
                            ->execute();

                    if($query) // si tout est bon
                {
                    $data_event = array(
                                        'destinataire_notif' => $this->request->getParam('username'),  //suiveur
                                        'nom_session' => $this->Auth->user('username'),// suivi
                                        );

                    // Envoi d'une notification signifiant une demande d'abonnement accepté

                    $event = new Event('Model.Abonnement.abovalide', $this, ['data_event' => $data_event]);

                    $this->eventManager()->dispatch($event);

                    $reponse = 'aboaccept'; // réponse AJAX
                }
                    else
                {
                    $reponse = 'probleme'; // réponse AJAX
                }
        }
            else // refuser l'abonnement
        {
            $query = $this->Abonnement->query()
                            ->delete()
                            ->where(['user_id' => $this->request->getParam('username') ])
                            ->Where(['suivi' => $this->Auth->user('username')])
                            ->execute();

                 if($query)
                {
                    $reponse = 'aborefuse'; // réponse AJAX
                }
                else
                {
                    $reponse = 'probleme'; // réponse AJAX
                }
        }

                $this->response->body($reponse);
                return $this->response;

    }
    // accès à la page hors d'une requête Ajax
        else 
    {
      throw new NotFoundException(__('Cette page n\'existe pas.'));
    }

}
    /**
     * Méthode Deleterequest
     *
     * Annuler une demande d'abonnement à un profil privé
     *
     */
        public function deleterequest()
    {
            if ($this->request->is('ajax'))
        {

            $query = $this->Abonnement->query()
                                        ->delete()
                                        ->where(['suivi' => $this->request->getParam('username') ])
                                        ->Where(['user_id' => $this->Auth->user('username')])
                                        ->Where(['etat' => 0])
                                        ->execute();

                        if($query)
                    {

                        $reponse = 'removerequest';
                    }
                        else
                    {

                        $reponse = 'probleme';
                    }

                    $this->response->body($reponse);
                    return $this->response;

        }
    // accès à la page hors d'une requête Ajax
            else 
        {
            throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
    }

    /**
     * Méthode Check_type_profil
     *
     * Récupération du type de profil
     *
     * Paramètres : $username -> personne concerné
     *
     * Sortie : 0 -> profil public / 1 -> profil privé
     */

    private function check_type_profil($username)
{

    $check_type_profil = $this->Settings->find()

                                        ->select(['type_profil'])

                                        ->where(['user_id' => $username]);

        foreach ($check_type_profil as $profil) 
    {

        $profil = $profil->type_profil;
    }

    return $profil;
}

    /**
     * Méthode Check_Abo
     *
     * Vérification d'un abonnement existant
     *
     * Paramètres : $username -> personne concerné
     *
     * Sortie : 0 -> Abonnement inexistant / 1 -> Abonnement existant
     */

    private function check_abo($username)
{
        $abonnement_verif = $this->Abonnement->find()
                                            ->where(['user_id' =>  $username])     
                                            ->where(['suivi'=>$this->request->getParam('username')])
                                            ->count();

    return $abonnement_verif;
}

    /**
     * Méthode Testnotifabo
     *
     * Vérifie si la personne à laquelle je m'abonne accepte les notifications d'abonnement, uniquement profil public
     *
     * Paramètres : $username -> personne concerné
     *
     * Sortie : oui -> Accepte les notifications d'abonnement / non -> Refuse les notifications d'abonnement
     */

        private function testnotifabo($username)
    {
 
        $verif_notif = $this->Settings->find()
                                        ->select(['notif_abo'])
                                        ->where(['user_id' => $username]);

            foreach ($verif_notif as $verif_notif) // recupération de la conversation
        {
            $settings_notif = $verif_notif['notif_abo'];
        }
             return $settings_notif;
    }

    /**
         * Méthode mesabonnes
         *
         * Liste de mes abonnes, destinée à la méthode "suggestionmoi" afin de définir des suggestions de suivi
         *
         * Paramètre : $authname -> moi
         *
    */

            private function mesabonnes($authName)
        {

                $abonnement = $this->Abonnement->find()
                                                ->select(['suivi'])
                                                ->where(['user_id' =>  $authName]);
            return $abonnement;
        }

    /**
         * Méthode suggestionmoi
         *
         * Suggestions de suivi
         *
         * 5 résultats uniquement, se base sur la méthode précédente
         *
         * Paramètre : $authname -> moi
         *
    */

        public function suggestionmoi()
    {
            if ($this->request->is('ajax')) {


        $suggestionmoi = $this->Users->find()
                                    ->select(['username'])
                                    ->modifier('SQL_NO_CACHE')
                                    ->where(['username NOT IN' =>  $this->mesabonnes($this->Auth->user('username'))])
                                    ->where(['username !=' => $this->Auth->user('username')])
                                    ->order('rand()')
                                    ->limit(2);

        $this->set('suggestionmoi', $suggestionmoi);
      }
      // accès à la page hors d'une requête Ajax
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
        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()
                                        ->where(['bloqueur' => $username])
                                        ->where(['bloquer' => $this->Auth->user('username') ])
                                        ->count();
         return $verif_blocage;
    }
}
