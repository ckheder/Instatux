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
    
    public function display() // info sur les autres
    {
        $this->loadModel('Users');
        $users =  $this->Users->find()
        ->select(['username', 'description','lieu','website','created'])
        ->where(['username' => $this->request->getParam('username')]);
        $this->set('users',$users);
        //nombre de tweet
        $this->loadModel('Tweet');
        $nb_tweet = $this->Tweet->find()->where(['Tweet.user_id' => $this->request->getParam('username')])->orWhere(['Tweet.user_timeline'=> $this->request->getParam('username')])->count();
        $this->set('nb_tweet',$nb_tweet);
    }
}
