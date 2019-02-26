<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Like cell
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
     * Default display method.
     *
     * @return void
     */
    public function display($idtweet)// afficher les gens qui like un post
    {
        $this->loadModel('Aime');

        $wholike = $this->Aime->find()->select(['Users.username'])->where(['tweet_aime' => $idtweet])->contain(['Users'])->order(['Aime.created' => 'DESC'])->limit(10);

        $this->set('wholike',$wholike);
    }
}
