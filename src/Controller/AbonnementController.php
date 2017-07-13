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

'user_id' =>  $this->Auth->user('username')

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

'user_id' =>  $this->Auth->user('username')

            ])
        ->where(['suivi'=>$this->request->getParam('username')]);
        
        if ($abonnement_verif->isEmpty()) // si pas de résultat, on ajoute
        {
        $data = array(
            'user_id' => $this->Auth->user('username'), // suiveur
            'suivi' => $this->request->getParam('username'), // suivi
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
            }
}
             else 
            {

                $this->Flash->error(__('Impossible de s\'abonner.'));
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
return $this->redirect(['action' => 'index']);
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

    




}
