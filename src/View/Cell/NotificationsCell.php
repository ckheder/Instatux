<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Hashtag cell
 */
class NotificationsCell extends Cell
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
    public function notifications($authname)
    {
        $this->loadModel('Settings');
         $settings_notif = $this->Settings->find()->select(['notif_message','notif_cite','notif_partage','notif_comm','notif_abo'])
        
                                    ->where(['user_id' => $authname]);

        $this->set('settings_notif',$settings_notif);
    }
}