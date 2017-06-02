<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Nbmessage cell
 */
class NbmessageCell extends Cell
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
    public function display($conv) // calcul du nombre de message par conversation, utilisable sur l'index de la messagerie et sur la méthode view
    {

        $this->loadModel('Messagerie');

        $nb_message = $this->Messagerie->find()->where(['conv' => $conv])->count();
        $this->set('nb_message',$nb_message);
    }
}
