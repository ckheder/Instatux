<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Datasource\ConnectionManager;


/**
 * Messagerie cell
 *
 * Récupère les conversations de l'utilisateur courant, afficher sur la page d'accueil de la messagerie
 */
class MessagerieCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    
    protected $_validCellOptions = [];

    /**
     * method userconv
     *
     * Récupérer les utilisateurs d'une conversation
     *
     * Paramètres : $conv -> identifiant de la conversation, $authname : utilisateur courant, afin de ne pas l'afficher sur la liste des membres d'une conversation
     */


      public function usersconv($conv, $authname) 
    {
      $this->loadModel('Conversation');

      $users_conv = $this->Conversation->find()
                                        ->select(['user_conv'])
                                        ->where(['conv' => $conv])
                                        ->where(['user_conv !=' => $authname]);

      $this->set('usersconv' , $users_conv);
    }

}

