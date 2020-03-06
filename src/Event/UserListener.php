<?php
namespace App\Event;

use Cake\Event\EventListener;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Listener UserListener
 *
 * Création de la ligne Settings d'un nouvel enregistré ainsi que les différends dossiers utilisateurs, avatar et cover par défaut | Suppression de toutes les informations après suppression de compte
 *
 */

class UserListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.User.afteradd' => 'addentity',
            'Model.User.afterdelete' => 'deleteaccount',
        );
    }

/**
     * Méthode addentity
     *
     * Création de la ligne Settings pour un utilisateur nouvellement enregistré, création des dossiers utilisateurs, avatar et cover
     *
     * Paramètres : $user -> tableau contenant le nom de la persone qui vient de s'inscrire
     *
*/

            public function addentity($event, $user)
        {

            $entity = TableRegistry::get('Settings');

            $query = $entity->query();

            // le reste est complété par le SGBD

            $query->insert(['user_id'])
                    ->values([
                                'user_id' => $user->username
                            ])
                    ->execute();

            //creation du dossier utilisateur

            $dir = new Folder('/var/www/html/instatux/webroot/img/media/'.$user->username.'', true, 0755);

            // copie de l'avatar par defaut

            $srcfile='/var/www/html/instatux/webroot/img/default.png';

            $dstfile='/var/www/html/instatux/webroot/img/avatar/'.$user->username.'.jpg';

            copy($srcfile, $dstfile);


        }
/**
     * Méthode deleteaccount
     *
     * Suppression de toutes les informations suite à une suppression de compte
     *
     * Paramètres : $user -> tableau contenant le nom de la persone qui vient de supprimer son compte
     *
*/


    public function deleteaccount($event, $user)
    {

        // suprresioon dossier media

            $dir = new Folder('img/media/'.$user->username.'');
            $dir->delete();

        // suppression des tweets postés et des partages

        $tweet = TableRegistry::get('Tweet');

        $conditionsuser = array(
                                'OR' => array(
                                                'user_id' => $user->username,
                                                'user_timeline' => $user->username
                                            )
                                );

        $tweet->deleteAll($conditionsuser);

        // suppression des abonnements

        $abonnement = TableRegistry::get('Abonnement');

            $conditionabo = array(
                                    'OR' => array(
                                                  'user_id' => $user->username,
                                                   'suivi' => $user->username
                                                    )
                                );
        $abonnement->deleteAll($conditionabo);


    // suppression conversation

        $conversation = TableRegistry::get('Conversation');

        $conditionconv = array(

                                                'participant1' => $user->username

                            );
        $conversation->deleteAll($conditionconv);



    }
}
