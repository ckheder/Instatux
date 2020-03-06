<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Info cell
 *
 * Info utilisateur sur le profil que je visite et nombre de tweets postés
 *
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
     * Méthode Display
     *
     * Info utilisateur sur le profil que je visite et nombre de tweets postés
     *
     *
*/

    public function display()
    {
        // info utilisateurs hors abonnement

        $this->loadModel('Users');

        $users =  $this->Users->find()
                                ->select(['username', 'description','lieu','website','created'])
                                ->where(['username' => $this->request->getParam('username')]);

        $this->set('users',$users);

        //nombre de tweet

        $this->loadModel('Tweet');

        $nb_tweet = $this->Tweet->find()
                                ->where(['Tweet.user_id' => $this->request->getParam('username')])
                                ->orWhere(['Tweet.user_timeline'=> $this->request->getParam('username')])
                                ->count();

        $this->set('nb_tweet',$nb_tweet);

        // nombre de medias

        $this->loadModel('Media');

        $nb_media = $this->Media->find()
                                ->where(['Media.user_id' => $this->request->getParam('username')])
                                ->count();

        $this->set('nb_media',$nb_media);
    }
}
