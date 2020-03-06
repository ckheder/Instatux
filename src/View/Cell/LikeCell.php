<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Like cell
 *
 * Affichage des 10 dernières personnes à aimé un tweet sur view.ctp
 */

class LikeCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

/**
     * Méthode Display
     *
     * Recherche des 10 dernières personnes à aimé un tweet sur view.ctp
     *
     * Paramètre : $idtweet -> identifiant du tweet
     *
*/
    public function display($idtweet)
    {
        $this->loadModel('Aime');

            $wholike = $this->Aime->find()
                                    ->select(['Users.username'])
                                    ->where(['tweet_aime' => $idtweet])
                                    ->contain(['Users'])
                                    ->order(['Aime.created' => 'DESC'])
                                    ->limit(10);

        $this->set('wholike',$wholike);
    }
}
