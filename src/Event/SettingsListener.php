<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

/**
 * Listener SettingsListener
 *
 * Création de notification de la ligne Settings pour un utilisateur nouvellement enregistré, mise à jour des tweets après une mise à jour de profil
 *
 */

class SettingsListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.Settings.afterPrivate' => 'updatetweetprivate',
            'Model.Settings.afterPublic' => 'updatetweetpublic'
        );
    }

/**
     * Méthode updatetweetprivate
     *
     * Après avoir passé mon profil à privé, passe tous mes tweets à privés
     *
     * Paramètres : $authname -> nom du membre
     *
*/

    public function updatetweetprivate($event, $authname) {

   
    $entity = TableRegistry::get('Tweet');

    $query = $entity->updateAll(
                                ['private' => 1], // tous les tweets passe à 1 -> privé
                                ['user_id' => $authname ]); // conditions 

}

/**
     * Méthode updatetweetpublic
     *
     * Après avoir passé mon profil à public, passe tous mes tweets à public
     *
     * Paramètres : $authname -> nom du membre
     *
*/

    public function updatetweetpublic($event, $authname) {

   
    $entity = TableRegistry::get('Tweet');

    $query = $entity->updateAll(
                                ['private' => 0], //tous les tweets passe à 0 -> public
                                ['user_id' => $authname ]); // conditions 

}


}