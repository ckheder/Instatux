<?php
namespace App\Controller;

use App\Controller\AppController;
//use App\Controller\Component\AuthComponent;

/**
 * Tweet Controller
 *
 * @property \App\Model\Table\TweetTable $Tweet
 */
class SettingsController extends AppController
{
var $uses = array(); // se passer d'un modèle

    public function index()
    {
    	$this->set('title', 'Paramètre de compte'); // titre de la page
        $this->viewBuilder()->layout('profil');
    }


}