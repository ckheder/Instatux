<?php
namespace App\View\Cell;

use Cake\View\Cell;


/**
 * Abonnement cell
 */
class AbonnementCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */

    private function getid($username) // id de l'utilisateur
    {
        $this->loadModel('Users');
        $id = $this->Users->find();
        $id->select(['id'])
        ->where(['username' => $username ]);
        return $id;
    }



    // 

    public function display($authuser, $authname)
    {

//test de l'abonnement

        $this->loadModel('Abonnement');
        $abonnement = $this->Abonnement->find();
        $abonnement->where([

'user_id' =>  $authuser

            ])
        ->where(['suivi'=>$this->getid($this->request->getParam('username'))]);
        
        if ($abonnement->isEmpty()) 
        {
   $this->set('abonnement',0);
}
else
{
     $this->set('abonnement',1);
}

$this->set('authname', $authname);
// partie nombre d'abonnes

   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $this->getid($this->request->getParam('username'))])->count();

$this->set('nb_abonnes',$nb_abonnes);
      
    // partie nombre d'abonnement  

$nb_abonnement = $this->Abonnement->find()->where(['user_id' => $this->getid($this->request->getParam('username'))])->count();

$this->set('nb_abonnement',$nb_abonnement);

// récupération de l'id membre


$id =  $this->getid($this->request->getParam('username'));

 foreach ($id as $id): 

$this->set('id_membre', $id->id);

endforeach;
        
    }

        public function moi($authuser)
    {

        $this->loadModel('Abonnement');
        
// partie nombre d'abonnes

   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $authuser])->count();

$this->set('nb_abonnes',$nb_abonnes);
      
    // partie nombre d'abonnement  

$nb_abonnement = $this->Abonnement->find()->where(['user_id' => $authuser])->count();

$this->set('nb_abonnement',$nb_abonnement);  
        
    }

    public function nbabonnes($id)
    {
    $this->loadModel('Abonnement');
        
   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $id])->count();

$this->set('nb_abonnes',$nb_abonnes);

    }


}
