<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Hashtag cell
 */
class HashtagCell extends Cell
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
    public function display()
    {
        $this->loadModel('Hashtag');

        $hashtag = $this->Hashtag->find()
        ->order(['nb_tag' => 'DESC'])
        ->limit(5);

        $this->set('hashtag',$hashtag);
    }
}
