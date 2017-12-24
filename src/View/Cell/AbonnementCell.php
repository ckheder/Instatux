<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;


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


    public function display($authname) // info sur l'uilisateur, pas moi
    {

//test de l'abonnement, si je le suis

        $this->loadModel('Abonnement');
        $abonnement = $this->Abonnement->find();
        $abonnement->where([

'user_id' =>  $authname

            ])
        ->where(['suivi'=> $this->request->getParam('username')])
        ->where(['etat' => 1]);
        
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

// on récupère l'état du blocage 

$this->loadModel('Blocage');

$blocage = $this->Blocage->find()->where(['bloqueur' => $authname])->where(['bloquer' => $this->request->getParam('username')])->count();

$this->set('etat_blocage', $blocage);

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

         public function avatar_user($user, $share,$abonnement) // avatar de l'utilisateur abonné sur l'accueuil dans le cas d'un partage
    {
        $this->loadModel('Users');
        $avatar_user = $this->Users->find();
        $avatar_user->select(['avatarprofil'])
        ->where(['username' => $user ]);
        
        $this->set('avatar_user',$avatar_user);
        $this->set('user', $user);
        $this->set('abonnement', $abonnement);

        if($share == 1)
        {
            $this->set('share', $share);
        }

        
    }

    public function test_abo($authname, $suivi) // test de l'abonnement sur le moeteur de recherche
    {

        $this->loadModel('Abonnement');
        $abonnement = $this->Abonnement->find();
        $abonnement->where([

'user_id' =>  $authname

            ])
        ->where(['suivi'=> $suivi])
        ->where(['etat' => 1]);
        
        if ($abonnement->isEmpty()) 
        {
   $this->set('abonnement',0);
}
else
{
     $this->set('abonnement',1);

}

$this->set('suivi', $suivi);
    }

    private function mesabonnes($authname)
    {
               $this->loadModel('Abonnement');
        $abonnement = $this->Abonnement->find()->select(['suivi'])->where(['user_id' =>  $authname]);
        return $abonnement;
            
            
    }

    public function suggestionmoi($authname)
    {
         $this->loadModel('Users');
        $suggestionmoi = $this->Users->find()->select(['username','avatarprofil'])->where(['username NOT IN' =>  $this->mesabonnes($authname)])
        ->where(['username !=' => $authname])
    
        ->limit(5);

        $this->set('suggestionmoi', $suggestionmoi);
    }


}
