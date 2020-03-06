<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;


/**
 * Abonnement cell
 *
 * Test de l'abonnement sue le profil que je visite , nombre d'abonnés/abonnement, test abonnement sur le moteur de recherche et sur les likes, suggestion et vérifier le blocage de mes abonnés
 *
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

/**
     * Méthode Display
     *
     * Test de l'abonnement sue le profil que je visite , nombre d'abonnés/abonnement
     *
     * Etat abonnement : 0 -> demande, 1 -> abonnement validé, 2 -> rien du tout
     *
     * Paramètre : $authname -> nom de la personne que je visite
     *
*/
    public function display($authname)
    {

        // test de l'abonnement, si je le suis

            $this->loadModel('Abonnement');

            $abonnement = $this->Abonnement->find()->select(['etat'])
                                                    ->where(['user_id' =>  $authname])
                                                    ->where(['suivi'=> $this->request->getParam('username')]);


            if ($abonnement->isEmpty()) // aucun abonnement
        {
            $this->set('abonnement',2);
        }
            else // test de l'abonnement actuel
        {
                foreach ($abonnement as $abonnement) // 0 -> demande, 1 -> abonnement validé
            {
                $etat_abo = $abonnement['etat'];
            }

        $this->set('abonnement',$etat_abo);

        }

        $this->set('authname', $authname);

        // calcul du nombre d'abonnes du profil que je visite

        $nb_abonnes = $this->Abonnement->find()
                                        ->where(['suivi' => $this->request->getParam('username')])
                                        ->Where(['etat'=> 1])
                                        ->count();

            $this->set('nb_abonnes',$nb_abonnes);

        // calcul du nombre d'abonnement du profil que je visite

        $nb_abonnement = $this->Abonnement->find()
                                            ->where(['user_id' => $this->request->getParam('username')])
                                            ->Where(['etat'=> 1])
                                            ->count();

            $this->set('nb_abonnement',$nb_abonnement);

        // on récupère l'état du blocage

            $this->loadModel('Blocage');

            $blocage = $this->Blocage->find()
                                        ->where(['bloqueur' => $authname])
                                        ->where(['bloquer' => $this->request->getParam('username')])
                                        ->count();

                $this->set('etat_blocage', $blocage);

    }

/**
     * Méthode Test_abo_search
     *
     * Test de l'abonnement sur les résultats des utilisateurs du moteur de recherche et de mes abonnés, abonnement si je visite un autre profil
     *
     * Etat abonnement : 0 -> demande, 1 -> abonnement validé, 2 -> rien du tout
     *
     * Paramètre : $authname -> moi | $suivi -> la personne à tester
     *
*/

    public function test_abo($authname, $suivi)
    {

        $this->loadModel('Abonnement');

            $abonnement = $this->Abonnement->find()
                                            ->select(['etat'])
                                            ->where(['user_id' =>  $authname ])
                                            ->where(['suivi'=> $suivi]);

                if ($abonnement->isEmpty())
            {
                $this->set('abonnement',2);
            }
                else
            {
                    foreach ($abonnement as $abonnement)
                {
                    $etat_abo = $abonnement['etat'];
                }

        $this->set('abonnement',$etat_abo);
    }

        $this->set('suivi', $suivi);
    }

/**
     * Méthode mesabonnes
     *
     * Liste de mes abonnes, destinée à la méthode "suggestionmoi" afin de définir des suggestions de suivi
     *
     * Paramètre : $authname -> moi
     *
*/

    private function mesabonnes($authname)
    {
        $this->loadModel('Abonnement');

            $abonnement = $this->Abonnement->find()
                                            ->select(['suivi'])
                                            ->where(['user_id' =>  $authname]);
        return $abonnement;
    }

/**
     * Méthode suggestionmoi
     *
     * Suggestions de suivi
     *
     * 5 résultats uniquement
     *
     * Paramètre : $authname -> moi
     *
*/

    public function suggestionmoi($authname)
    {
            $this->loadModel('Users');

        $suggestionmoi = $this->Users->find()
                                    ->select(['username'])
                                    ->where(['username NOT IN' =>  $this->mesabonnes($authname)])
                                    ->where(['username !=' => $authname])
                                    ->limit(2);

        // si aucune on ne hcarge pas la Cell


          $this->set('suggestionmoi', $suggestionmoi);
        
    }
/**
     * Méthode testblocage
     *
     * On test si mes abonnés sont bloqués ou non
     *
     * La vue génèrera un lien de blocage ou de déblocage suivant la situation
     *
     * Paramètre : $authname -> moi | $suivi -> personne à tester
     *
*/
    public function testblocage($authname, $suivi)
    {
        $this->loadModel('Blocage');

            $blocage = $this->Blocage->find()
                                        ->where(['bloqueur' => $authname])
                                        ->where(['bloquer' => $suivi])
                                        ->count();
            $this->set('blocage', $blocage);
            $this->set('suivi', $suivi);
    }
}
