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
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    // route login

    $routes->connect('/login',['controller' => 'Users', 'action' => 'login']);

    // fin route login

    // route logout
Router::connect('/logout',['controller' => 'Users', 'action' => 'logout']);
    // fin route logout

    // route profil
//Router::connect('/profil',['controller' => 'Users', 'action' => 'redirection']);
    // fin route profil

//essai route profil

Router::connect('/:username',['controller' => 'Tweet', 'action' => 'index'],['pass' =>['username']],['_name' => 'profil']);

//fin essai route profil

//essai route tweet

Router::connect('/post/:id',['controller' => 'Tweet', 'action' => 'view'],['id' => '\d+', 'pass' =>['id']]);

//fin essai route tweet

//essai route tweet

Router::connect('/post/delete/:id',['controller' => 'Tweet', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);

//fin essai route tweet

// route  notif

Router::connect('/notifications',['controller' => 'Notifications', 'action' => 'index']);

//fin route  notif

// route delete notif

Router::connect('/notifications/delete/:id',['controller' => 'Notifications', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);

//fin route delete notif

// route recherche

Router::connect('/search-:string',['controller' => 'Search', 'action' => 'index']);

Router::connect('/search/index/-:string',['controller' => 'Search', 'action' => 'index']); // utliser dans la pagination

//fin route recherche

    // route abonnement index
Router::connect('/abonnement',['controller' => 'Abonnement', 'action' => 'index']);
    // fin route abonnement/index

    // route abonnement add
Router::connect('/abonnement/add/:username',['controller' => 'Abonnement', 'action' => 'add']);
    // fin route abonnement/add

    // route like
Router::connect('/like-:id',['controller' => 'Aime', 'action' => 'add'],['id' => '\d+', 'pass' =>['id']],['_name' => 'routelike']);
    // fin route like

    // route abonnement delete
Router::connect('/abonnement/delete/:username',['controller' => 'Abonnement', 'action' => 'delete']);
    // fin route abonnement/delete

    // route accepter abonnement
Router::connect('/abonnement/:act/:username',['controller' => 'Abonnement', 'action' => 'validate']);
    // fin route abonnement/delete

    // route settings
Router::connect('/settings',['controller' => 'Settings', 'action' => 'index']);
    // fin route settings

 // route settings notif_message
Router::connect('/settings-notif_message',['controller' => 'Settings', 'action' => 'notifmessage']);
// fin route notif_message

 // route settings notif_cite
Router::connect('/settings-notif_cite',['controller' => 'Settings', 'action' => 'notifcite']);
// fin route notif_cite

 // route settings notif_partage
Router::connect('/settings-notif_partage',['controller' => 'Settings', 'action' => 'notifpartage']);
// fin route notif_partage

 // route settings notif_abo
Router::connect('/settings-notif_abo',['controller' => 'Settings', 'action' => 'notifabo']);
// fin route notif_abo

 // route settings notif_abo
Router::connect('/settings-notif_comm',['controller' => 'Settings', 'action' => 'notifcomm']);
// fin route notif_abo

    // route liste bloques
Router::connect('/bloques',['controller' => 'Blocage', 'action' => 'listebloques']);
    // fin route listebloques

    // route messagerie
Router::connect('messagerie',['controller' => 'Messagerie', 'action' => 'index']);
    //fin route messagerie

    // route conversation
Router::connect('/conversation-:id',['controller' => 'Messagerie', 'action' => 'view'],['id' => '\d+', 'pass' =>['id']]);
    //fin route conversation

    // route accueil
Router::connect('/actualités',['controller' => 'Tweet', 'action' => 'accueuil']);
    // fin route accueil

    // route partage add
Router::connect('/partage/add/:id/:id_auteur',['controller' => 'Tweet', 'action' => 'share'],['id' => '\d+', 'pass' =>['id']]);
    // fin route partage/add

    // route partage delete
Router::connect('/partage/delete/:id',['controller' => 'Partage', 'action' => 'delete'],['id' => '\d+', 'pass' =>['id']]);
    // fin route partage delete
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
