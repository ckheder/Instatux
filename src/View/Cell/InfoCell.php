<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Users cell
 */
class InfoCell extends Cell
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
    public function moi($authuser) // info sur moi
    {
        $this->loadModel('Users');
        $users =  $this->Users->find();
        $users->where(['id' => $authuser]);
        $this->set('users',$users);

        
    }

    public function display() // info sur les autres
    {
        $this->loadModel('Users');
        $users =  $this->Users->find();
        $users->where(['username' => $this->request->getParam('username')]);
        $this->set('users',$users);
    }
}
