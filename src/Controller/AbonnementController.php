<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Abonnement Controller
 *
 * @property \App\Model\Table\AbonnementTable $Abonnement
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
        $this->Auth->deny(['abonnement','abonnes','demande']); // on empeche l'accès a l'index si je ne suis pas auth
    }

                    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */


    public function abonnement() // liste de mes abonnements
    {
           $this->viewBuilder()->layout('follow');

           if($this->request->getParam('username') == $this->Auth->user('username'))
           {

        $this->set('title', 'Mes abonnements');
    }
    else
    {
        $this->set('title', 'Liste des abonnements de '.$this->request->getParam('username').'');
    }

        // abonnement valide, personne que je suis

        $abonnement_valide = $this->Abonnement->find()->select(['Users.username'])
                
        ->where(['Abonnement.user_id' =>  $this->request->getParam('username') ])
     
        ->where(['etat' => 1])

        ->order((['Users.username' => 'ASC']))
        
        ->contain(['Users']);

        $nb_abonnement = $abonnement_valide->count();

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

public function abonnes()
{
            $this->viewBuilder()->layout('follow');

                   if($this->request->getParam('username') == $this->Auth->user('username'))
           {

        $this->set('title', 'Mes abonné(s)');
    }
    else
    {
        $this->set('title', 'Liste des abonnés de '.$this->request->getParam('username').'');
    }
            // abonné valide, personne qui me suive
        $abonne_valide = $this->Abonnement->find()
        ->select(['Users.username'])
        ->leftjoin(
            ['Users'=>'users'],
            ['Users.username = (Abonnement.user_id)']
    )
                
        ->where(['suivi' =>  $this->request->getParam('username') ])
     
        ->where(['etat' => 1])
        ->order((['Users.username' => 'ASC']));
        
        $nb_abonnes = $abonne_valide->count();
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

public function demande() 
{
            $this->viewBuilder()->layout('follow');

        $this->set('title', 'Demande(s) de suivi');

        // mes demandes reçues
  
         $abonnement_attente = $this->Abonnement->find()
       
        ->select([
            'Users.username',
            ])
        ->leftjoin(
            ['Users'=>'users'],
            ['Users.username = (Abonnement.user_id)']
    )
                
        ->where(['suivi' =>  $this->Auth->user('username') ])
     
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
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() // suiveur : session en cours, suivi $_GET
    {
if ($this->request->is('ajax')) {
        // vérifie si c'est un profil privé

        $check_profil = $this->check_type_profil($this->request->getParam('username'));

        if($check_profil == 1) // profil privé
        {

        // vérifie se je ne suis pas déjà abonné

            $abonnement_verif = $this->check_abo($this->Auth->user('username'));
        
        if ($abonnement_verif == 0) // si pas de résultat, on ajoute -> on ajoutera ici le test du profil privé la cell le saura 
        {
        $data = array(
            'user_id' => $this->Auth->user('username'), // suiveur
            'suivi' => $this->request->getParam('username'), // suivi
            'etat' => 0,
            //evenement abonnement
             'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            );
            $abonnement = $this->Abonnement->newEntity();
            $abonnement = $this->Abonnement->patchEntity($abonnement, $data);

            if ($this->Abonnement->save($abonnement)) 
            {

                 $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);
                $this->eventManager()->dispatch($event);

                //fin évènement

                $reponse = 'demandeok';             
            }

             else 
            {

                $reponse = 'probleme';
            }
        }
    }

    //fin profil privé
        else // profil public 
        {

            // on vérifie quand même si on est pas déjà abonné

            $check_abo = $this->check_abo($this->Auth->user('username'));

            if($check_abo === 0)
            {

        $data = array(
            'user_id' => $this->Auth->user('username'), // suiveur
            'suivi' => $this->request->getParam('username'), // suivi
            'etat' => 1,
            //evenement abonnement
             'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            );
            $abonnement = $this->Abonnement->newEntity();
            $abonnement = $this->Abonnement->patchEntity($abonnement, $data);
            if ($this->Abonnement->save($abonnement)) 
            {
                 if($this->testnotifabo($this->request->getParam('username')) == "oui")
                {

                 $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);
                $this->eventManager()->dispatch($event);

                //fin évènement
            }

                $reponse = 'abook';              
            }

             else 
            {

                $reponse = 'probleme';
            }
        }

        }
                       $this->response->body($reponse);
    return $this->response;


    }
// fin vérif

    }

    /**
     * Delete method
     *
     * @param string|null $id Abonnement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if ($this->request->is('ajax')) {
        // vérif 
        $abonnement_verif = $this->Abonnement->find();
        $abonnement_verif->where([

'user_id' =>  $this->Auth->user('username') // id de la personne connecté

            ])
        ->where(['suivi'=>$this->request->getParam('username')]);


        // fin vérif
        if (!$abonnement_verif->isEmpty()) // si tout est bon
        {   

            $query = $this->Abonnement->query();
            $query->delete()
    ->where(['user_id' => $this->Auth->user('username')])
    ->where(['suivi' => $this->request->getParam('username')])
    ->execute();
 
            if ($query) 
            {
               $reponse = 'suppok';
            }
            else 
            {

                $reponse = 'problème';
            }

}

  
                       $this->response->body($reponse);
    return $this->response;


    }
    }

    public function indexmessagerie() // liste de mes abonnements pour la messagerie, personne que je suis
    {


                if ($this->request->is('ajax')) {

                    $this->loadModel('Users');
           
            $this->autoRender = false;            
            $name = $this->request->query('term');            
                $abonnement = $this->Users->find()->select(['username'])

        ->where(['username !=' =>  $this->Auth->user('username')])
        ->where(['username LIKE '  => ''.$name.'%']);


            foreach($abonnement as $result) 
            {


               $resultArr[] =  array(
                
                    
                    'value' => $result->username
                    );
                
               
            }
            echo json_encode($resultArr); 


}
}

public function validate() // valider ou non une demande d'abonnement
{
    if ($this->request->is('ajax')) {
   
    if ($this->request->getParam('act') === 'accept') // valider l'abonnement
    {
        $query = $this->Abonnement->query()
                            ->update()
                            ->set(['etat' => 1])
                            ->where(['user_id' => $this->request->getParam('username') ])
                            ->Where(['suivi' => $this->Auth->user('username')])
                            ->execute();

                if($query)
                {
                    $data_event = array(
                        'destinataire_notif' => $this->request->getParam('username'),
                        'nom_session' => $this->Auth->user('username'),//nom de session
                        );

                    $event = new Event('Model.Abonnement.abovalide', $this, ['data_event' => $data_event]);
                     $this->eventManager()->dispatch($event);

                    $reponse = 'aboaccept';
                }
                else
                {
                    $reponse = 'probleme';
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
                    
                    $reponse = 'aborefuse';
                }
                else
                {
                    $reponse = 'probleme';
                }
    }

                       $this->response->body($reponse);
    return $this->response;


    }

}
 /**
     * Annuler une demande d'abo
     *
     * @param string|null $id Abonnement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleterequest()
    {
        if ($this->request->is('ajax')) {

$query = $this->Abonnement->query()
                            ->delete()
                            ->where(['suivi' => $this->request->getParam('username') ])
                            ->Where(['user_id' => $this->Auth->user('username')])
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
    }

private function check_type_profil($username) // vérifie le profil de la personne que l'on souhaite suivre
{
    $this->loadModel('Settings');

    $check_type_profil = $this->Settings->find()

    ->select(['type_profil'])
    ->where(['user_id' => $username]);

    foreach ($check_type_profil as $profil) {

        $profil = $profil->type_profil;
       
    }

    return $profil;
}

private function check_abo($username) // vérifie si on est déjà abonné
{
        $abonnement_verif = $this->Abonnement->find()
        ->where([

'user_id' =>  $username

            ])
        ->where(['suivi'=>$this->request->getParam('username')])->count();

    return $abonnement_verif;
}

    private function testnotifabo($username) // on vérifie si la personne à laquelle je m'abonne accepte les notifications d'abonnement, uniquement profil public
    {
                $this->loadModel('Settings');

        $verif_notif = $this->Settings->find()->select(['notif_abo'])->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // recupération de la conversation
                {
                $settings_notif = $verif_notif['notif_abo'];
                }

             return $settings_notif;
    }


}
