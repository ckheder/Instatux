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
        $this->set('title', 'Mes abonnements'); // titre de la page
                $abonnement = $this->Abonnement->find()
                
        ->where([

'user_id' =>  $this->Auth->user('id')

            ])

        ->order((['Users.username' => 'ASC']))
        
        ->contain(['Users']);
        if ($abonnement->isEmpty()) 
        {
   $this->set('nbabonnement',0);
}
else
{
     $this->set('nbabonnement',1);
     $this->set(compact('abonnement'));
}
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
        // vérif
        $abonnement_verif = $this->Abonnement->find();
        $abonnement_verif->where([

'user_id' =>  $this->Auth->user('id')

            ])
        ->where(['suivi'=>$this->request->getParam('id')]);
        
        if ($abonnement_verif->isEmpty()) // si pas de résultat, on ajoute
        {
        $data = array(
            'user_id' => $this->Auth->user('id'), // suiveur
            'suivi' => $this->request->getParam('id'), // suivi
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


                $this->Flash->success(__('The abonnement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
             else 
            {

                $this->Flash->error(__('insertion fail.'));
            }
       // }
        $this->set(compact('abonnement'));
        $this->set('_serialize', ['abonnement']);
}
else
{
$this->Flash->error(__('verif fail.'));
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
        // vérif 
        $abonnement_verif = $this->Abonnement->find();
        $abonnement_verif->where([

'user_id' =>  $this->Auth->user('id') // id de la personne connecté

            ])
        ->where(['suivi'=>$this->request->getParam('id')]);


        // fin vérif
        if (!$abonnement_verif->isEmpty()) // si tout est bon
        {   

            $id_abo = $this->request->getParam('id'); // id passé en URL
            $entity = $this->Abonnement->get($id_abo); // création de l'entité abonnement
            $result = $this->Abonnement->delete($entity); // suppression de l'entité
 
            if ($result) 
            {
                $this->Flash->success(__('Abonnement supprimé.'));

                return $this->redirect(['action' => 'index']);
            }
             else 
            {

                $this->Flash->error(__('Impossible de supprimer cet abonnement.'));
            }
       // }
        $this->set(compact('abonnement'));
        $this->set('_serialize', ['abonnement']);
}
else
{
$this->Flash->error(__('verif fail abo.'));
}
    }

    public function indexmessagerie() // liste de mes abonnements pour la messagerie
    {


                if ($this->request->is('ajax')) {
           
            $this->autoRender = false;            
            $name = $this->request->query('term');            
                $abonnement = $this->Abonnement->find('all')->contain(['Users']);
                
        $abonnement->where([

'user_id' =>  $this->Auth->user('id')

            ])
        ->where(['Users.username LIKE '  => '%'.$name.'%']);
        

    

$resultArr = [];



            foreach($abonnement as $result) 
            {
              //$resultArr[] =  $result->user->username;


               $resultArr[] =  array('label' => $result->user->username, 'value' => $result->user->username , 'id' => $result->user->id);
                
               
            }
            echo json_encode($resultArr); 

}
}

    




}
