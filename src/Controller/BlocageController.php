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
    public function add($bloquer) // bloquer un utilisateur
    {

        // on vérifie si il y'a déjà un blocage

        if($this->check_blocage($bloquer) == 1)
        {
            $this->Flash->error(__('Cet utlisateur est déjà bloqué'));

             return $this->redirect($this->referer());
        }
        else // création d'un nouveau blocage
        {

            $data = array(

                'bloqueur' => $this->Auth->user('username'),
                'bloquer' => $bloquer,
            );
        $blocage = $this->Blocage->newEntity();

        $blocage = $this->Blocage->patchEntity($blocage, $data);

        if ($this->Blocage->save($blocage)) {
            
                $this->Flash->success(__(''.$bloquer.' est désormais bloqué'));

                
            }else{
            $this->Flash->error(__('Impossible de bloquer cet utilisateur.'));
        }
        return $this->redirect($this->referer());
        }
    }

    public function delete($bloquer)
    {
     

            $query = $this->Blocage->query();
            $query->delete()
    ->where(['bloqueur' => $this->Auth->user('username')])
    ->where(['bloquer' => $bloquer])
    ->execute();
 
            if ($query) 
            {
                $this->Flash->success(__(''.$bloquer.' est débloqué.')); 
            }



  else 
            {

                $this->Flash->error(__('Impossible de débloquer cet utilisateur.'));
            }


return $this->redirect($this->referer());
    }



    private function check_blocage($username = null)// on vérifie si il n'y a pas déjà un blocage effectif
    {
        $query = $this->Blocage->find()->where(['bloqueur' => $this->Auth->user('username')])->where(['bloquer' => $username]);

        $resultat = $query->count();

        return $resultat;
    }
}
