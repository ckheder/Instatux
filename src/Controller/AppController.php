<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],


            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
]);
   }
     public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display']);
        $this->Auth->config('authError', false); // desactivation des messages d'erreurs
        $this->set('authUser', $this->Auth->user('id')); // id du connecté
        $this->set('authName', $this->Auth->user('username')); // nom du connecté

    }

    /**
     * Méthode Upload
     *
     * Traitement d'un fichier uploadé et mise à jour du contenu tweet ou depuis la messagerie
     *
     * Paramètre : $contenu : contenu d'un message ou d'un tweet | $file : le fichier
     *
     * Sortie : $erreur : envoi impossible ou mauvais fichier | $reponse : problème interne | $contenu : contenu du tweet mis à jour
     *
     *
*/
       public function upload($file,$contenu)
    {
        // test de l'envoi du fichier

            if($file['error'] != 0)
        {
            return $erreur = 'Problème lors de l\'envoi de votre fichier.Veuillez réessayer.';
        }

        // type MIME autorisé

            $imageMimeTypes = array(
                                    'image/jpg',
                                    'image/png',
                                    'image/jpeg'
                                    );
        // récupération du type MIME

            $fileMimeType = mime_content_type($file['tmp_name']);

        // test de l'extension du fichier

                    if (!in_array($fileMimeType, $imageMimeTypes))
                {
                     $erreur = 'Ce n\'est pas une image';
                }

        //S'il n'y a pas d'erreur, on upload

                        if(!isset($erreur))
                    {
                        // répertoire de destination
                        $uploadPath = 'img/media/'.$this->Auth->user('username').'/';

                        // déplacement réussi -> mise à jour du tweet
                            if(move_uploaded_file($file['tmp_name'], $uploadPath.basename($file['name'])))
                        {
                          chmod($uploadPath.basename($file['name']), 0644);
                        $contenu = preg_replace('~\[image]([^{]*)\[/image]~i', '<img src="/instatux/'.$uploadPath.basename($file['name']).'" class="tweet_media" width="100%" alt="image introuvable" />', $contenu);

                            return $contenu;
                        }
                            else // déplacement raté
                        {

                            return $reponse = 'Impossible d\'envoyer ce fichier';
                        }

                    }
                        else
                    {
                        return $erreur; // renvoi de l'erreur
                    }

    }

    /**
     * Méthode linkify_content
     *
     * Conversion des @username en lien vers le profil, émoji vers image, # lien cliquable vers le moteur de recherche, URL vers lien cliquable, media vers iframe
     *
     * Paramètre : $content -> contenu du tweet,message,comm
     *
     * Sortie : $content -> contenu parsé
*/
        public function linkify_content($contenu)
    {
        $contenu = preg_replace('/(^|[^@\w])@(\w{1,15})\b/','$1<a href="./$2">@$2</a>',$contenu); // @username

        $contenu =  preg_replace('/:([^\s]+):/', '<img src="./img/emoji/$1.png" class="emoji_comm"/>', $contenu); // emoji

        //URL

        $pattern_link = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\\\\\\\w]*))?)/';

        $contenu = preg_replace($pattern_link, '<a href="$1" target="_blank">$1</a>', $contenu);

        // conversion média en lecteur vidéo

// youtube
            if (preg_match('~\[videoYoutube]([^{]*)\[/videoYoutube]~i', $contenu))
        {
            $contenu = preg_replace('~\[videoYoutube]([^{]*)\[/videoYoutube]~i', '<p><iframe src="https://www.youtube.com/embed/$1"  width="100%" height="360" frameborder="0" allowfullscreen></iframe></p>', $contenu);
        }
// dailymotion
            elseif (preg_match('~\[videoDailymotion]([^{]*)\[/videoDailymotion]~i', $contenu))
        {
            $contenu = preg_replace('~\[videoDailymotion]([^{]*)\[/videoDailymotion]~i', '<p><iframe frameborder="0" width="100%" height="360" src="//www.dailymotion.com/embed/video/$1" allowfullscreen></iframe></p>', $contenu);
        }
// clip twitch
            elseif (preg_match('~\[clipTwitch]([^{]*)\[/clipTwitch]~i', $contenu))
        {
        $contenu = preg_replace('~\[clipTwitch]([^{]*)\[/clipTwitch]~i', '<p><iframe src="https://clips.twitch.tv/embed?autoplay=false&clip=$1&tt_content=embed&tt_medium=clips_embed" width="100%" height="360" frameborder="0" scrolling="no" allowfullscreen="true"></iframe></p>', $contenu);
        }
// video twitch
            elseif (preg_match('~\[videoTwitch]([^{]*)\[/videoTwitch]~i', $contenu))
        {
        $contenu = preg_replace('~\[videoTwitch]([^{]*)\[/videoTwitch]~i', '<p><iframe src="https://player.twitch.tv/?autoplay=false&video=v$1" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="100%"></iframe></p>', $contenu);
        }
// instagram
            elseif (preg_match('~\[InstagramPost]([^{]*)\[/InstagramPost]~i', $contenu))
        {
        $contenu = preg_replace('~\[InstagramPost]([^{]*)\[/InstagramPost]~i', '<p><iframe src="https://www.instagram.com/p/$1/embed/captioned/" width="100%" height="780" frameborder="0" scrolling="no" allowtransparency="true"></iframe></p>', $contenu);
        }
// lien vers une image distante
            elseif (preg_match('~\[imageUrl]([^{]*)\[/imageUrl]~i', $contenu))
        {
        $contenu = preg_replace('~\[imageUrl]([^{]*)\[/imageUrl]~i', '<a href="$1" ><img src="$1" width="100%" /></a>', $contenu);
        }

        $contenu =  preg_replace('/#([^\s]+)/','<a href="./search/hashtag/$1">#$1</a>',$contenu); //#something

        $contenu = nl2br($contenu); // paragraphe

        return $contenu;
    }

        /**
     * Méthode verifconv
     *
     * Vérification de l'authorisation de voir une conversation : test si le username est l'un de deux participants de la conversation donné en paramètre URL
     *
     * Paramètre : $username
     *
     * Sortie : 0 -> pas le droit | 1 -> autorisé
     */

        public function verifconv($username, $conv)
    {
        $this->loadModel('Conversation');

        $verifconv = $this->Conversation->find()
                                    ->where(['user_conv' => $username])
                                    ->where(['conv' => $conv]);


          if ($verifconv->isEmpty())
        {
            return 0; // pas le droit
        }
         else
        {
            return 1; // autorisé
        }
    }

            /**
     * Chargement des helpers
     */

    public $helpers = [
    'Html' => [
        'className' => 'Bootstrap.BootstrapHtml'
    ],
    'Form' => [
        'className' => 'Bootstrap.BootstrapForm'
    ],
    'Modal' => [
        'className' => 'Bootstrap.BootstrapModal'
    ],
        'Flash' => [
            'className' => 'Bootstrap.BootstrapFlash'
        ]
];

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

}
