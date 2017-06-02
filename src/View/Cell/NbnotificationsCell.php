<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Users cell
 */
class NbnotificationsCell extends Cell
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

    public function display($authUser) // info sur les autres
    {
        $this->loadModel('Notifications');

        $nb_notif = $this->Notifications->find()->where(['user_id' => $authUser])->where(['statut' => 0])->count();
        $this->set('nb_notif', $this->decorate('NbnotificationsCell', $nb_notif));
    }
}
