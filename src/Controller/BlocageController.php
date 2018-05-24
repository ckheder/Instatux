<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Blocage Controller
 *
 * @property \App\Model\Table\BlocageTable $Blocage
 *
 * @method \App\Model\Entity\Blocage[] paginate($object = null, array $settings = [])
 */
class BlocageController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() // bloquer un utilisateur
    {

        if ($this->request->is('ajax')) {

        // on vérifie si il y'a déjà un blocage

        if($this->check_blocage($this->request->getParam('username')) == 1)
        {
           $reponse = 'alreadyblock';
        }
        else // création d'un nouveau blocage
        {

            $data = array(

                'bloqueur' => $this->Auth->user('username'),
                'bloquer' => $this->request->getParam('username'),
            );
        $blocage = $this->Blocage->newEntity();

        $blocage = $this->Blocage->patchEntity($blocage, $data);

        if ($this->Blocage->save($blocage)) {
            
                $reponse = 'addblockok';

                
            }else{
            $reponse = 'probleme';
        }
        }

 $this->response->body($reponse);
    return $this->response;


    }
    }

    public function delete()
    {
     
         if ($this->request->is('ajax')) {

            $query = $this->Blocage->query();
            $query->delete()
    ->where(['bloqueur' => $this->Auth->user('username')])
    ->where(['bloquer' => $this->request->getParam('username')])
    ->execute();

 
            if ($query) 
            {
                $reponse = 'deleteblockok'; 
            }



  else 
            {

                $reponse = 'probleme';
            }


 $this->response->body($reponse);
    return $this->response;


    }
    }



    private function check_blocage($username = null)// on vérifie si il n'y a pas déjà un blocage effectif
    {
        $query = $this->Blocage->find()->where(['bloqueur' => $this->Auth->user('username')])->where(['bloquer' => $username]);

        $resultat = $query->count();

        return $resultat;
    }
}
