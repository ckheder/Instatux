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

    public function display($authname)
    {

//test de l'abonnement

        $this->loadModel('Abonnement');
        $abonnement = $this->Abonnement->find();
        $abonnement->where([

'user_id' =>  $authname

            ])
        ->where(['suivi'=> $this->request->getParam('username')]);
        
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

   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $this->request->getParam('username')])->count();

$this->set('nb_abonnes',$nb_abonnes);
      
    // partie nombre d'abonnement  

$nb_abonnement = $this->Abonnement->find()->where(['user_id' => $this->request->getParam('username')])->count();

$this->set('nb_abonnement',$nb_abonnement);



$id =  $this->getid($this->request->getParam('username'));
 foreach ($id as $id): 
$this->set('id_membre', $id->id);
endforeach;
}




        public function moi($authname)
    {

        $this->loadModel('Abonnement');
        
// partie nombre d'abonnes de moi

   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $authname])->count();

$this->set('nb_abonnes',$nb_abonnes);
      
    // partie nombre d'abonnement  de moi

$nb_abonnement = $this->Abonnement->find()->where(['user_id' => $authname])->count();

$this->set('nb_abonnement',$nb_abonnement);  
        
    }

    public function nbabonnes($id) // pour la cell sur la page d'abonnement
    {
    $this->loadModel('Abonnement');
        
   $nb_abonnes = $this->Abonnement->find()->where(['suivi' => $id])->count();

$this->set('nb_abonnes',$nb_abonnes);

    }

         public function avatar_user($user, $abonnement) // avatar de l'utilisateur abonné sur l'accueuil
    {
        $this->loadModel('Users');
        $avatar_user = $this->Users->find();
        $avatar_user->select(['avatarprofil'])
        ->where(['username' => $user ]);
        
        $this->set('avatar_user',$avatar_user);
        $this->set('user', $user);
        $this->set('abonnement', $abonnement);
    }


}
