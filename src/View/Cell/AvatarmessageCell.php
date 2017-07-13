<?php
namespace App\View\Cell;

use Cake\View\Cell;


/**
 * Abonnement cell
 */
class AvatarmessageCell extends Cell
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
    public function display($expediteur, $destinataire, $authname)
    {

        if($expediteur != $authname)
        {
            $name = $expediteur;
        }
        else
        {
            $name = $destinataire;
        }

        $this->loadModel('Users');
        $info_message =  $this->Users->find()

        ->select(['avatarprofil', 'username', 'id'])
        ->where(['username' => $name]);
        $this->set('info_message',$info_message);
        
    }


}
