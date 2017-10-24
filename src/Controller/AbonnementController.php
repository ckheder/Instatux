<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;


/**
 * Abonnement Controller
 *
 * @property \App\Model\Table\AbonnementTable $Abonnement
 */
class AbonnementController extends AppController
{
    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() // liste de mes abonnements
    {
        $this->viewBuilder()->layout('profil');

        $this->set('title', 'Mes abonnements');

        // abonnement valide

        $abonnement_valide = $this->Abonnement->find()
                
        ->where(['user_id' =>  $this->Auth->user('username') ])
     
        ->where(['etat' => 1])

        ->order((['Users.username' => 'ASC']))
        
        ->contain(['Users']);

        $nb_abonnes = $abonnement_valide->count();

        if ($abonnement_valide->isEmpty()) // aucun résultat
        {
            $this->set('nbabonnement_valide',0);
        }
        else
        {
            $this->set('count_abonnes', $nb_abonnes);
            $this->set(compact('abonnement_valide'));
        }
// fin abonnement valide

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

        if ($abonnement_attente->isEmpty()) // aucun résultat
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
    public function add($suiveur = null, $suivi = null) // suiveur : session en cours, suivi $_GET
    {
        $abonnementTable = TableRegistry::get('Abonnement');
        $abonnement = $abonnementTable->newEntity();

        // vérifie si c'est un profil privé

        $check_profil = $this->check_type_profil($this->request->getParam('username'));

        if($check_profil == 1)
        {

        // vérifie se je ne suis pas déjà abonné

            $abonnement_verif = $this->check_abo();
        
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
 
            $abonnement = $this->Abonnement->patchEntity($abonnement, $data);
            if ($abonnementTable->save($abonnement)) 
            {

                 $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);
                $this->eventManager()->dispatch($event);

                //fin évènement


                $this->Flash->success(__('Demande d\'abonnement envoyé !'));              
            }

             else 
            {

                $this->Flash->error(__('Impossible de s\'abonner.'));
            }
        }
    }
        else // profil public 
        {

            // on vérifie quand même si on est pas déjà abonné

            $check_abo = $this->check_abo();

            if($check_abo == 0)
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
 
            $abonnement = $this->Abonnement->patchEntity($abonnement, $data);
            if ($abonnementTable->save($abonnement)) 
            {

                 $event = new Event('Model.Abonnement.afterAdd', $this, ['abonnement' => $abonnement]);
                $this->eventManager()->dispatch($event);

                //fin évènement


                $this->Flash->success(__('Abonnement ajouté !'));              
            }

             else 
            {

                $this->Flash->error(__('Impossible de s\'abonner.'));
            }
        }

        }
  return $this->redirect($this->referer());
        $this->set(compact('abonnement'));
        $this->set('_serialize', ['abonnement']);
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
                $this->Flash->success(__('Abonnement supprimé.')); 
            }

}

  else 
            {

                $this->Flash->error(__('Impossible de supprimer cet abonnement.'));
            }
        $this->set(compact('abonnement'));
        $this->set('_serialize', ['abonnement']);
return $this->redirect($this->referer());
    }

    public function indexmessagerie() // liste de mes abonnements pour la messagerie
    {


                if ($this->request->is('ajax')) {
           
            $this->autoRender = false;            
            $name = $this->request->query('term');            
                $abonnement = $this->Abonnement->find('all')->contain(['Users']);
                
        $abonnement->where([

'user_id' =>  $this->Auth->user('username')

            ])
        ->where(['Users.username LIKE '  => '%'.$name.'%']);
        

    

$resultArr = [];



            foreach($abonnement as $result) 
            {
              //$resultArr[] =  $result->user->username;


               $resultArr[] =  array('label' => $result->user->username, 'value' => $result->user->username , 'username' => $result->user->username);
                
               
            }
            echo json_encode($resultArr); 

}
}

public function validate() // valider ou non une demande d'abonnement
{
   
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

                    $this->Flash->success(__(''.$this->request->getParam('username').' fais désormais parti de vos abonnés'));
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
                    
                    $this->Flash->error(__('Abonnement refusé avec succès !'));
                }
    }

    return $this->redirect($this->referer());

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

private function check_abo() // vérifie si on est déjà abonné
{
        $abonnement_verif = $this->Abonnement->find()
        ->where([

'user_id' =>  $this->Auth->user('username')

            ])
        ->where(['suivi'=>$this->request->getParam('username')])->count();

    return $abonnement_verif;
}

    




}
