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
    public $components = array('RequestHandler');

            public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']); // on empeche l'accès a l'index si je ne suis pas auth
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() // liste de mes abonnements
    {
        $this->viewBuilder()->layout('general');

        $this->set('title', 'Abonnements');

        // abonnement valide, personne que je suis

        $abonnement_valide = $this->Abonnement->find()->select(['Users.username','Users.avatarprofil'])
                
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
            $this->set(compact('abonnement_valide'));
        }


// fin abonnement valide

        // abonné valide, personne qui me suive


        $abonne_valide = $this->Abonnement->find()

        ->select(['Users.username','Users.avatarprofil'])

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
            $this->set(compact('abonne_valide', $abonne_valide));
        }

// fin abonné valide

// abonnement en attente

        $abonnement_attente = $this->Abonnement->find()
       
        ->select([
            'Users.username',
            'Users.avatarprofil'
            ])
        ->leftjoin(
            ['Users'=>'users'],

            ['Users.username = (Abonnement.user_id)']
    )
                
        ->where(['suivi' =>  $this->Auth->user('username') ])
     
        ->where(['etat' => 0])

        ->order((['Users.username' => 'ASC']));

        $nb_attente = $abonnement_attente->count(); // nombre de demande en attente

        if ($nb_attente === 0) // aucun résultat
        {
            $this->set('nbabonnement_attente',0);
        }
        else
        {
            $this->set('nb_attente', $nb_attente);
            $this->set(compact('abonnement_attente', $abonnement_attente));
        }
// fin abonnement en attente        

}
    /**
     * View method
     *
     * @param string|null $id Abonnement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abonnement = $this->Abonnement->get($id, [
            'contain' => []
        ]);

        $this->set('abonnement', $abonnement);
        $this->set('_serialize', ['abonnement']);
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
            'avatar_session' => $this->Auth->user('avatarprofil')
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
            'avatar_session' => $this->Auth->user('avatarprofil')
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
           
            $this->autoRender = false;            
            $name = $this->request->query('term');            
                $abonnement = $this->Abonnement->find()->select(['suivi'])
                
        ->where(['user_id' =>  $this->Auth->user('username')])
        ->where(['suivi LIKE '  => '%'.$name.'%'])
        ->where(['etat' => 1]);

$resultArr = [];

            foreach($abonnement as $result) 
            {


               $resultArr[] =  array('label' => $result->suivi, 'value' => $result->suivi);
                
               
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
                        'avatar_session' => $this->Auth->user('avatarprofil')
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
