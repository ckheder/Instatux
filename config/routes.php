<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::extensions('json', 'xml');

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */

// Route USERS
    
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    // route login

    $routes->connect('/login',['controller' => 'Users', 'action' => 'login']);

    // route logout

    Router::connect('/logout',['controller' => 'Users', 'action' => 'logout']);

    // route editer description

    Router::connect('/editinfos',['controller' => 'Users', 'action' => 'editinfos']);

    // route editer lieu

    Router::connect('/settings/lieu',['controller' => 'Users', 'action' => 'editlieu']);

    // route editer website

    Router::connect('/settings/website',['controller' => 'Users', 'action' => 'editwebsite']);

    // route editer password

    Router::connect('/settings/resetpassword',['controller' => 'Users', 'action' => 'editpassword']);

    // route editer avatar

    Router::connect('/settings/avatar',['controller' => 'Users', 'action' => 'avatar']);

    // route editer adresse mail

    Router::connect('/settings/newmail',['controller' => 'Users', 'action' => 'editmail']);

// Route TWEET

    // route profil

    Router::connect('/:username',['controller' => 'Tweet', 'action' => 'index']);

    // route voir un tweet

    Router::connect('/post/:id',['controller' => 'Tweet', 'action' => 'view'],['pass' =>['id'], '_name' => 'post']);

    // route voir les médias d'un utilisateur

    Router::connect('/:username/media',['controller' => 'Tweet', 'action' => 'media']);

    // route utiliser pour recharger la liste des médias visible à gauche après l'envoi d'un tweet contenant un média

    Router::connect('/:username/media/listmedia',['controller' => 'Tweet', 'action' => 'listmedia']);

    // route crée un tweet

    Router::connect('/post/add',['controller' => 'Tweet', 'action' => 'add']);

    //route supprimer un tweet , appelée en Ajax

    Router::connect('/post/delete/:id',['controller' => 'Tweet', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);

    // route autoriser commentaire

    Router::connect('/allowcomment/:etat/:idtweet',['controller' => 'Tweet', 'action' => 'allowComment'],['etat' => '\d+', 'pass' =>['etat']]);
    
    // route accueil : actualité d'un utilisateur connecté

    Router::connect('/accueuil',['controller' => 'Tweet', 'action' => 'accueuil']);

    // route actualités : actualité d'un utilisateur offline, tweet publics

    Router::connect('/actualites',['controller' => 'Tweet', 'action' => 'actualites']);

    // route création d'un partage de tweet

    Router::connect('/partage/add/:id/:id_auteur',['controller' => 'Tweet', 'action' => 'share']);

// Route NOTIFICATIONS

    // route voir les notifications

    Router::connect('/notifications',['controller' => 'Notifications', 'action' => 'index'],['_name' => 'notifications']);

    // route marquer toutes les notifications comme lue

    Router::connect('/notifications/all',['controller' => 'Notifications', 'action' => 'allnotiflue']);

    // route supprimer toutes les notifications

    Router::connect('/notifications/deleteall',['controller' => 'Notifications', 'action' => 'alldeletenotif']);

    // route calcul du nombre de notifications

    Router::connect('/notifications/count',['controller' => 'Notifications', 'action' => 'nbNotif']);

    // route effacer une notification

    Router::connect('/notification/delete/:id',['controller' => 'Notifications', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);

    // route marquer une notification comme lue

    Router::connect('/notification/read/:id',['controller' => 'Notifications', 'action' => 'singlenotiflue'],['id' => '\d+', 'pass' =>['id']]);

// Routes RECHERCHE

    // route moteur de recherche

    Router::connect('/search-:string',['controller' => 'Search', 'action' => 'index']);

    // route recherche par hashtag

    Router::connect('/search/hashtag/:string',['controller' => 'Search', 'action' => 'hashtag']);

    // route autocomplétion des utilisateurs

    Router::connect('/search/searchusers',['controller' => 'Search', 'action' => 'searchusers']);

// Routes ABONNEMENTS

    // route de mes abonnements

    Router::connect('/abonnement/:username',['controller' => 'Abonnement', 'action' => 'abonnement']);

   // route de mes abonne

    Router::connect('/abonne/:username',['controller' => 'Abonnement', 'action' => 'abonnes']);

    // route voir mes demandes

    Router::connect('/demande',['controller' => 'Abonnement', 'action' => 'demande'],['_name' => 'demande']);

    // route ajouter un abonnement

    Router::connect('/abonnement/add/:username',['controller' => 'Abonnement', 'action' => 'add']);

    // route supprimer un abonnement

    Router::connect('/abonnement/delete/:username',['controller' => 'Abonnement', 'action' => 'delete']);

    // route accepter une demande d'abonnement

    Router::connect('/abonnement/:act/:username',['controller' => 'Abonnement', 'action' => 'validate']);

    // route refuser une demande d'abonnement

    Router::connect('/abonnement/remove/:username',['controller' => 'Abonnement', 'action' => 'deleterequest']);

    // route consulter la liste des abonnements pour l'autocomplétion de la messagerie

    Router::connect('/abonnement/indexmessagerie',['controller' => 'Abonnement', 'action' => 'indexmessagerie']);

    // route faire des suggestions de suivi et vérifier qu'il n'y a pas déjà d'abonnement

    Router::connect('/suggestion',['controller' => 'Abonnement', 'action' => 'suggestionmoi']);

// Routes LIKE

    // route crée un like

    Router::connect('/like',['controller' => 'Aime', 'action' => 'add'],['_name' => 'routelike']);

    // route liste like

    Router::connect('/like/:id',['controller' => 'Aime', 'action' => 'index'],['id' => '\d+', 'pass' =>['id']]);

// Routes SETTINGS

    // route page d'accueil des settings

    Router::connect('/settings',['controller' => 'Settings', 'action' => 'index']);

    // route settings notif_message

    Router::connect('/settings-notif_message',['controller' => 'Settings', 'action' => 'notifmessage']);

    // route settings notification de citation

    Router::connect('/settings-notif_cite',['controller' => 'Settings', 'action' => 'notifcite']);

    // route settings notif_partage de tweet

    Router::connect('/settings-notif_partage',['controller' => 'Settings', 'action' => 'notifpartage']);

    // route settings notif_abo : nouvel abonnement

    Router::connect('/settings-notif_abo',['controller' => 'Settings', 'action' => 'notifabo']);

    // route settings notif_comm : notification de nouveau commentaire

    Router::connect('/settings-notif_comm',['controller' => 'Settings', 'action' => 'notifcomm']);

    // route configurer profil : public ou privé

    Router::connect('/settings/setup_profil',['controller' => 'Settings', 'action' => 'setup_profil']);

// Routes BLOCAGE

    // route liste bloques

    Router::connect('/bloques',['controller' => 'Blocage', 'action' => 'listebloques']);

    // route bloquer un utilisateur

    Router::connect('/blocage/add/:username',['controller' => 'Blocage', 'action' => 'add']);

    // route debloquer un utilisateur

    Router::connect('/blocage/delete/:username',['controller' => 'Blocage', 'action' => 'delete']);

// Routes MESSAGERIE

    // route page d'accueuil de la messagerie

    Router::connect('/messagerie',['controller' => 'Messagerie', 'action' => 'index'],['_name' => 'messagerie']);

    // route envoi message : appelé en AJAX

    Router::connect('/message/add',['controller' => 'Messagerie', 'action' => 'add']);

    //route chargement de la liste des conversations

    Router::connect('/listconv',['controller' => 'Messagerie', 'action' => 'listconv']);

    // route voir une conversation

    Router::connect('/conversation-:id',['controller' => 'Messagerie', 'action' => 'view'],['_name' => 'conversation']);

    // route supprimer une conversation

    Router::connect('/conversation/delete/:id',['controller' => 'Conversation', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);
 
    // route ajouter un utilisateur à une conversation

    Router::connect('/conversation/adduser',['controller' => 'Conversation', 'action' => 'adduser']);

// Routes COMMENTAIRES

    // route envoi nouveau commentaire

    Router::connect('/commentaire/add',['controller' => 'Commentaires', 'action' => 'add']);

    // route modifier un commentaire

    Router::connect('/commentaire/edit/:id',['controller' => 'Commentaires', 'action' => 'edit'],['id' => '\d+', 'pass' =>['id']]);

    // route supprimer un commentaire

    Router::connect('/commentaire/delete',['controller' => 'Commentaires', 'action' => 'delete']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
