<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;


/**
 * Controller Tweet
 *
 * Gestion des Tweet
 *
 * @property \App\Model\Table\TweetTable $Tweet
 */
class TweetController extends AppController
{

        public $paginate = [
        'limit' => 8,
                            ];

        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['actualites']); // on autorise les gens non identifiés au controller de leur actu
        $this->Auth->deny(['accueuil','media']); // on bloque l'accès a l'actu des gens connectes et aux médias
    }

        public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Commentaires');
        $this->loadModel('Media');
        $this->loadModel('Blocage');
        $this->loadModel('Settings');
        $this->loadModel('Abonnement');
        $this->loadModel('Users');
        $this->loadModel('Partage');
    }

/**
     * Méthode Index
     *
     * Retourne la liste des tweets par odred décroissant : vérifie d'abord si on peut accéder au profil
     *
*/
    public function index()
    {
        $this->viewBuilder()->layout('profil');

        $this->set('title', ''.$this->request->getParam('username').' | Instatux'); // titre de la page

        $username = $this->request->getParam('username'); // nom en paramètre

        // on test si le membre existe

            if($this->verif_user($username) == 0)
        {

            throw new NotFoundException(__('Cette page n\'existe pas.'));

        }

        // Si je ne suis pas sur mon profil, on test sie je peut le voir

            if($username != $this->Auth->user('username'))
        {
                if($this->allow_see_profil($username) == 0) // profil privé et non abonné
            {

            $no_follow = 0; // je ne peut y accéder

            $this->set('no_follow', $no_follow);

            }

        }

        if(!isset($no_follow)) // si je suis abonné ou profil public , on récupère la liste des tweets
        {
            $tweet = $this->Tweet->find()->select([
                                                    'Users.username',
                                                    'Tweet.id',
                                                    'Tweet.id_tweet',
                                                    'Tweet.user_id',
                                                    'Tweet.user_timeline',
                                                    'Tweet.contenu_tweet',
                                                    'Tweet.created',
                                                    'Tweet.share',
                                                    'Tweet.nb_commentaire',
                                                    'Tweet.nb_partage',
                                                    'Tweet.nb_like',
                                                    'Tweet.allow_comment',
                                                    ])
                                    ->where(['Tweet.user_timeline' => $username])
                                    ->order(['Tweet.created' => 'DESC'])
                                    ->contain(['Users']);

            $nb_tweet =  $tweet->count(); // calcul du nombre de tweet

          if($nb_tweet == 0)
         {
             $this->set('nb_tweet', $nb_tweet);
         }

            $this->set('tweet', $this->Paginator->paginate($tweet, ['limit' => 8]));

        }
    }

/**
     * Méthode View
     *
     * Affichage d'un tweet
     *
*/
    public function view($id = null)
    {
            if ($this->request->is('ajax'))
        {

                if($this->verif_tweet($this->request->getParam('id')) == 0) // membre inexistant
            {

                throw new NotFoundException(__('Ce tweet n\'existe pas.'));
            }

                if($this->allow_view_tweet($this->Auth->user('username')) == 0) // pas le droit de voir le tweet
            {

                $no_follow = 0;
                $this->set('no_follow', $no_follow);
            }

            else
                // récupération des infos du tweets
        {

            $info_tweet = $this->Tweet->find()->select([
                                                        'Users.username',
                                                        'Tweet.id_tweet',
                                                        'Tweet.id',
                                                        'Tweet.user_id',
                                                        'Tweet.user_timeline',
                                                        'Tweet.contenu_tweet',
                                                        'Tweet.created',
                                                        'Tweet.share',
                                                        'Tweet.nb_commentaire',
                                                        'Tweet.nb_partage',
                                                        'Tweet.nb_like',
                                                        'Tweet.allow_comment',
                                                        ])

                                            ->where(['Tweet.id_tweet' => $this->request->getParam('id')])
                                            ->contain(['Users']);

            $this->set('tweet', $info_tweet);


        // récupération des commentaires du tweet par odre décroissant

            

            $comm_tweet = $this->Commentaires->find()->select([
                                                                'Commentaires.id',
                                                                'Commentaires.comm',
                                                                'Commentaires.user_id',
                                                                'Commentaires.created',
                                                                'Commentaires.edit',
                                                                'Users.username',
                                                                ])
                                                    ->where(['Commentaires.tweet_id' => $this->request->getParam('id')])
                                                    ->order(['Commentaires.created' => 'DESC'])
                                                    ->contain(['Users']);

            $this->set('commentaires', $this->Paginator->paginate($comm_tweet, ['limit' => 8]));
        }
        }
            else
        {
            throw new NotFoundException(__('Cette page n\'existe pas.'));
        }

    }

/**
     * Méthode Add
     *
     * Ajout d'un tweet
     *
     * Sortie : ajout d'un nouveau tweet à la timeline ou problème si il est impossible d'ajouter ce tweet
     *
*/
    public function add()
    {

            if ($this->request->is('ajax'))
        {


            $new_media = 0; // par défaut on envoi pas de média interne

            $tweet = $this->Tweet->newEntity(); // nouvel entité

            $contenu_tweet = htmlspecialchars($this->request->data('contenu_tweet')); // suppression des balises HTML

            //test de la présence d'un média externe

              if(isset($this->request->data['file']))
            {

            $file = $this->request->data['file'];

                if($file['size'] != 0)
            {
              $contenu_tweet = AppController::upload($file, $contenu_tweet); // traitement de l'envoi du fichier et mise à jour du contenu du tweets

              $new_media = 1; //variable pour signaler un nouveau media interne
            }
          }
          
            $idtweet = $this->idtweet(); // génération d'un nouvel identifiant de tweet

                $data = array(
                                'id' => $idtweet,
                                'user_id' => $this->Auth->user('username'),
                                'user_timeline' => $this->Auth->user('username'),
                                'contenu_tweet' => AppController::linkify_content($contenu_tweet),
                                'private' =>$this->get_type_profil($this->Auth->user('username')),
                        // Model.Tweet.afterAdd
                                'new_media' => $new_media
                            );

                $tweet = $this->Tweet->patchEntity($tweet, $data);

                    if ($this->Tweet->save($tweet)) //insertion réussie
                {
                    // évènement qui va extraire les username dans le tweet sauf moi, crée une ligne média si nécessaire
                    $event = new Event('Model.Tweet.afterAdd', $this, ['tweet' => $tweet]);

                    $this->eventManager()->dispatch($event);

                    // remplacement de %23 par # pour les hashtag

                    $data['contenu_tweet'] = preg_replace('/%23/', '#', $data['contenu_tweet']);

                    $this->response->body(json_encode($tweet)); // réponse AJAX pour affichage


                }
                    else
                {
                    $reponse = 'probleme'; // impossible d'ajouter ce tweet
                    $this->response->body($reponse);
                }

                    return $this->response; // envoi d'une réponse AJAX
        }

        else // accès a L'URL hors d'une requête AJAX
    {
        $this->Flash->error(__('Impossible d\'ajouter ce tweet.'));
        return $this->redirect($this->referer());
    }

    }

/**
     * Méthode Delete
     *
     * Supprimer d'un tweet
     *
     * Sortie : tweetsupprimer -> Suppression du tweet | echectweetsupprime -> impossible de supprimer
     *
*/
    public function delete($id = null)
    {

            if ($this->request->is('ajax'))
        {

            $id_tweet = $this->request->getParam('id'); // identifiant du tweet

            $entity = $this->Tweet->get($id_tweet); // récupération de l'entité

            // On récupère l'auteur du tweet et la timeline associée

            $tweet_verif = $this->Tweet->find()
                                        ->select(['user_id','user_timeline'])
                                        ->where(['id_tweet' => $id_tweet]);

                if(!$tweet_verif->isEmpty()) // si ce tweet existe
            {
                    foreach($tweet_verif as $tweet_verif)
                {
                    $user_tweet = $tweet_verif->user_id; // createur du tweet
                    $user_timeline_tweet = $tweet_verif->user_timeline; //timeline d'affichage
                }


                if($user_tweet === $this->Auth->user('username')) // je suis l'auteur du tweet, je supprimme mon tweet et tous les partage
            {
                $result = $this->Tweet->deleteAll(['id' => $entity->id]);
            }
                elseif($user_timeline_tweet === $this->Auth->user('username')) // je suis sur mon profil, que ce soit un partage ou non , suppression de ma timeline uniquement
            {
                $result = $this->Tweet->delete($entity);
            }

            // tableau de reponse

            $data = array('media' => 0); // par défaut on ne supprime pas de média

                        // verification si il y'a une image uploadé
                    if(preg_match('/<img\s+(?=[^>]*?(?<=\s)class\s*=\s*"tweet_media")[^>]*?(?<=\ssrc=")\K[^"]*/', $entity->contenu_tweet, $matches))
                {

                    // ouverture de mon dossier média

                    $folder_media = new Folder(WWW_ROOT . 'img/media/'.$this->Auth->user('username').'/');

                    $media = new File($matches[0]);

                    $media_name = $media->name;

                    $file = new File(WWW_ROOT . 'img/media/'.$this->Auth->user('username').'/'.$media_name.'', false);

                    //suppression du fichier

                    $file->delete();

                    $data['media'] = 1; // suppression d'un média

                }

                        if($result)
                    {
                      $data['reponse'] = 'tweetsupprime';
                    }
                        else
                    {
                      $data['reponse'] = 'echectweetsupprime';
                    }
            }
                        $this->response->body(json_encode($data));
                        return $this->response;
        }
            else // accès a L'URL de suppression hors d'une requête AJAX
        {
            $this->Flash->error(__('Impossible de supprimé.'));
            return $this->redirect($this->referer());
        }
    }

    /**
         * Méthode Media
         *
         * Affichage des teweets contenant un média uploadé, utilisation d'une classe spécifique
         *
         *
    */
        public function media()
        {

          $this->viewBuilder()->layout('profil');

          $username = $this->request->getParam('username');

          $keyword = 'tweet_media'; // classe recherchée pour lister les tweets avec médias

          $this->set('title', 'Média de '.$username.' | Instatux');

          // on test si le membre existe

              if($this->verif_user($username) == 0)
          {

              throw new NotFoundException(__('Cette page n\'existe pas.'));


          }

          // Si je ne suis pas sur mon profil, on test sie je peut le voir

              if($username != $this->Auth->user('username'))
          {
                  if($this->allow_see_profil($username) == 0) // profil privé et non abonné
              {
              $no_follow = 0; // je ne peut y accéder
              $this->set('no_follow', $no_follow);
              }

          }

          if(!isset($no_follow)) // si je suis abonné ou profil public , on récupère la liste des tweets avec média
          {

              $query_media = $this->Tweet->find()->select([
                                                      'Users.username',
                                                      'Tweet.id',
                                                      'Tweet.id_tweet',
                                                      'Tweet.user_id',
                                                      'Tweet.user_timeline',
                                                      'Tweet.contenu_tweet',
                                                      'Tweet.created',
                                                      'Tweet.share',
                                                      'Tweet.nb_commentaire',
                                                      'Tweet.nb_partage',
                                                      'Tweet.nb_like',
                                                      'Tweet.allow_comment',
                                                      ])
                                              ->where(["MATCH(Tweet.contenu_tweet) AGAINST(:search)"])
                                              ->where(['Tweet.user_timeline' => $username])
                                              ->bind(':search',$keyword)
                                              ->order(['Tweet.created' => 'DESC'])
                                              ->contain(['Users']);


              $this->set('tweet_media', $this->Paginator->paginate($query_media, ['limit' => 8]));
            }
        }

/**
             * Méthode Listmedia
             *
             * Recherche des 8 derniers média envoyés par un utilisateur,affiché sur le profil
             *
*/
              public function listmedia()
            {

                if ($this->request->is('ajax'))
              {
                

                $list_media = $this->Media->find()
                                            ->select(['nom_media','tweet_media','user_id'])
                                            ->where(['user_id' => $this->request->getParam('username')])
                                            ->order(['created' => 'DESC'])
                                            ->limit(8);

                $this->set('list_media',$list_media);

                }

        else // accès a L'URL de partage hors d'une requête AJAX
    {
        throw new NotFoundException(__('Cette page n\'existe pas.'));
    }
            }

/**
     * Méthode share
     *
     * Partage d'un tweet
     *
     * Sortie : inexistant -> ce tweet n'existe pas | deja -> j'ai déjà partagé ce tweet | probleme -> impossible de partager |
     * shareok -> partage réussi
     *
*/
    public function share()
    {

            if ($this->request->is('ajax'))
        {
                // on vérifie si le tweet existe

                if($this->verif_tweet($this->request->getParam('id')) === 0)
            {
                $reponse = 'inexistant';
            }
                else
            {

                // on vérifie si je n'ais pas déjà partagé

                    if($this->testshare($this->request->getParam('id')) == 1) // j'ai déjà partager
                {
                    $reponse = 'deja';
                }
                    elseif($this->request->getParam('id_auteur') === $this->Auth->user('username')) // je ne peut partager un tweet à moi qui à était partager par d'autres
                {
                    $reponse = 'probleme';
                }
                    else
                {

                    $tweet = $this->Tweet->newEntity(); // création d'une nouvelle ntité tweet

                        if($this->testnotifshare($this->request->getParam('id_auteur')) === "oui") // on vérifie si l'auteur du tweet veut une notification de partage
                    {
                        $notif = 'oui';
                    }
                        else
                    {
                        $notif = 'non';
                    }

                        $info_tweet = $this->Tweet->find() // on récupère les infos du tweet pour le copier
                                                    ->select([
                                                                'id_tweet',
                                                                'id',
                                                                'user_id',
                                                                'contenu_tweet',
                                                            ])
                                                    ->where(['Tweet.id' => $this->request->getParam('id')]);

                            foreach($info_tweet as $info_tweet)
                        {
                            $user_tweet = $info_tweet->user_id;
                            $contenu_tweet = $info_tweet->contenu_tweet;
                            $id = $info_tweet->id;
                            $id_tweet = $info_tweet->id_tweet;
                        }

                            $data = array(
                                    'id' => $id, // identifiant original du tweet
                                    'user_id' => $user_tweet, // auteur original du tweet
                                    'user_timeline' => $this->Auth->user('username'),
                                    'contenu_tweet' => $contenu_tweet,
                                    'share' => 1, // indique que ce tweet est un partage
                                    'notif' =>$notif // oui ou non
                                );

                            $tweet = $this->Tweet->patchEntity($tweet, $data);

                        if ($this->Tweet->save($tweet))
                    {

// cet évènement déclenche oui ou non la création d'une notification de partage et va mettre à jour la table Partage

                        $event = new Event('Model.Partage.afterAdd', $this, ['tweet' => $tweet, 'id_tweet' => $id_tweet]);
                        $this->eventManager()->dispatch($event);

                        $reponse = 'shareok';
                    }
                        else
                    {
                        $reponse = 'probleme';
                    }

                }
            }
                $this->response->body($reponse); // renvoi d'une réponse AJAX
                return $this->response;
        }

        else // accès a L'URL de partage hors d'une requête AJAX
    {
        $this->Flash->error(__('Impossible de partager.'));
        return $this->redirect($this->referer());
    }
    }


    public function accueuil()
    {

        $this->viewBuilder()->layout('onlinenews');

        $this->set('title', 'Instatux | Actualités'); // titre de la page

        // Récupération des tweets de mes abonnements par odre décroissant

                $abonnement = $this->Tweet->find()
                                            ->select([
                                                        'Users.username',
                                                        'Tweet.id',
                                                        'Tweet.id_tweet',
                                                        'Tweet.user_id',
                                                        'Tweet.user_timeline',
                                                        'Tweet.contenu_tweet',
                                                        'Tweet.created',
                                                        'Tweet.share',
                                                        'Tweet.nb_commentaire',
                                                        'Tweet.nb_partage',
                                                        'Tweet.nb_like',
                                                        'Tweet.allow_comment',
                                                    ])

                                            ->where(['Abonnement.user_id' =>  $this->Auth->user('username') ])
                                            ->contain(['Users'])
                                            ->contain(['Abonnement']);

            $nb_tweet_accueuil = $abonnement->count(); // nombre de tweet

          if($nb_tweet_accueuil == 0) // si 0 -> affichage d'un message spécifique
        {
            $this->set('nb_tweet_accueuil', $nb_tweet_accueuil);
        }

            $this->set('abonnement', $this->paginate($abonnement, ['limit' => 8]));
    }
/**
     * Méthode Actualités
     *
     * Fil d'actualité pour les personnes non connectées
     *
     * N'affiche que les tweets publics et non partagés
     *
     *
*/
    public function actualites()
    {

        $this->viewBuilder()->layout('offlinenews');

        $this->set('title', 'Instatux | Actualités');


        $actu = $this->Tweet->find()
                            ->select([
                                        'Users.username',
                                        'Tweet.id',
                                        'Tweet.id_tweet',
                                        'Tweet.user_id',
                                        'Tweet.user_timeline',
                                        'Tweet.contenu_tweet',
                                        'Tweet.created',
                                        'Tweet.share',
                                        'Tweet.nb_commentaire',
                                        'Tweet.nb_partage',
                                        'Tweet.nb_like',
                                        'Tweet.allow_comment',
                                    ])

                            ->where(['Tweet.private' =>  0]) // tweet public uniquement
                            ->where(['Tweet.share' =>  0]) // tweet non partagé
                            ->order(['Tweet.created' => 'DESC'])
                            ->contain(['Users']);

        $this->set('actu', $this->paginate($actu, ['limit' => 8]));

    }

/**
     * Méthode Allowseeprofil
     *
     * Vérifie si j'ai le droit de consulter un profil
     *
     * Paramètre : $username = $this->request->getPram('username') -> username du profil à vérifier (transmis par URL)
     *
     * Sortie : $voir -> contient le résultat des tests : 0 -> interdiction de voir le profil | 1 : autorisation de voir le profil
     *
     *
*/
      private function allow_see_profil($username)
    {

        // 1) on vérifie si je suis bloqué

        $verif_blocage = $this->Blocage->find()
                                        ->where(['bloqueur' => $username]) // profil à vérifier
                                        ->where(['bloquer' => $this->Auth->user('username')]); // moi

        $result_blocage = $verif_blocage->count();

            if($result_blocage == 1) // je suis bloqué
        {
            return $voir = 0; // interdiction de voir le profil
        }
            else
        {

        // Test du profil courant  : 1 -> profil prive | 0 -> profil public

        $type_profil = $this->Settings->find()
                                        ->select(['type_profil'])
                                        ->where(['user_id' => $username]);

                foreach($type_profil as $type_profil)

            $type_profil = $type_profil->type_profil;

              if($type_profil == 1) // profil privé
            {

                // on vérifie si je suis abonné

                

                $verif_abo = $this->Abonnement->find()->where(['user_id' => $this->Auth->user('username')])
                                                        ->where(['suivi' => $username])
                                                        ->where(['etat' => 1]);
                $result_abo = $verif_abo->count();

                    if($result_abo == 0) // je ne suis pas abonné
                {
                    $voir = 0; // interdiction de voir
                }
                    else
                {
                    $voir = 1; // autorisation de voir
                }

            }

                else // profil public et non bloqué je peut voir les tweets
            {
                $voir = 1;
            }
        }
          return $voir; // variable contenant le résulta des tests
    }

/**
     * Méthode Allowviewtweet
     *
     * Vérifie si j'ai le droit de consulter un tweet
     *
     * Paramètre : $username = $this->request->getPram('username') -> username du profil à vérifier (transmis par URL)
     *
     * Sortie : $voir -> contient le résultat des tests : 0 -> interdiction de voir le profil | 1 : autorisation de voir le profil
     *
     *
*/
        private function allow_view_tweet($username)
    {
        // on récupère l'auteur du tweet , si c'est un partage et si il est privé

            $tweet = $this->Tweet->find()

                                    ->select(['Tweet.user_id', 'share','private'])

                                    ->where(['Tweet.id_tweet' => $this->request->getParam('id')]);

                foreach($tweet as $tweet)
            {
                $auteur_tweet = $tweet->user_id;
                $share = $tweet->share;
                $private = $tweet->private;
            }

                      if($auteur_tweet != $this->Auth->user('username')) // je ne suis pas l'auteur original du tweet
                    {

        // 1) on vérifie si je suis bloqué : bloqueur -> l'autre et bloqué -> moi

                        $verif_blocage = $this->Blocage->find()
                                                        ->where(['bloqueur' => $auteur_tweet])
                                                        ->where(['bloquer' => $this->Auth->user('username')]);

                        $result_blocage = $verif_blocage->count();


                            if($result_blocage == 1) // je suis bloqué
                        {
                            return $voir = 0; // interdiction de voir le tweet
                        }
                            else
                        {
                            // vérification si c'est un tweet privé

                                if($private == 1) // tweet privé
                            {
                                // je ne suis pas l'auteur et que ce n'est pas un tweet partagé

                                    if($auteur_tweet != $this->Auth->user('username') AND $share == 0)
                                {

                                    // on vérifie si je suis abonné

                                    $verif_abo = $this->Abonnement->find()
                                                                    ->where(['user_id' => $this->Auth->user('username')])
                                                                    ->where(['suivi' => $auteur_tweet])
                                                                    ->where(['etat' => 1]);

                                    $result_abo = $verif_abo->count();

                                        if($result_abo == 0) // je ne suis pas abonné
                                    {
                                        $voir = 0; //interdiction de voir le tweet
                                    }
                                        else
                                    {
                                        $voir = 1;
                                    }
                                }
                            }
                                else // tweet public, on peut le voir
                            {
                                $voir = 1;
                            }
                         }
                    }
                    else
                {
                    $voir = 1;
                }

        return $voir;
    }
/**
     * Méthode Allowcomment
     *
     * Activer/désactiver les commentaires
     *
     * Configuration : 1 -> désactiver, 0 -> activer
     *
     * Sortie : commac -> Commentaire activé | commdesac -> Commentaire désactivé | problème : impossible de modifier
     *
     *
*/
    public function allowComment()
    {

            if ($this->request->is('ajax'))
        {

            $query = $this->Tweet->query()
                                    ->update()
                                    ->set(['allow_comment' => $this->request->getParam('etat')])
                                    ->where(['id' => $this->request->getParam('idtweet')])
                                    ->where(['user_timeline' => $this->Auth->user('username')]) // on vérifie que ce tweet est le tweet courant et que j'en suis le timeline
                                    ->execute();

                // mise à jour réussie vers une activation des commentaire

                if($query AND $this->request->getParam('etat') == 0)
            {
              $reponse = 'commac';
            }

                // mise à jour réussie vers une désactivation des commentaire

                elseif($query AND $this->request->getParam('etat') == 1)
            {
              $reponse = 'commdesac';
            }

                // problème
                else
            {
                $reponse = 'probleme';
            }

                    $this->response->body($reponse); // réponse AJAX
                    return $this->response;

        }
            else
        {
            $this->Flash->error(__('Impossible de faire cette action.'));
            return $this->redirect($this->referer());
        }
    }

/**
     * Méthode Verifuser
     *
     * Vérifie si l'utilisateur existe
     *
     * Paramètre : $username -> nom à tester
     *
     * Sortie : 0 -> membre inexistant | 1 -> membre existant
     *
     *
*/
        private function verif_user($username)
    {
        
        $check_user = $this->Users->find()
                                    ->where(['username' => $username ])
                                    ->count();

        return $check_user;
    }
/**
     * Méthode Veritweet
     *
     * Vérifie si un tweet existe
     *
     * Paramètre : $id -> identifiant du tweet
     *
     * Sortie : 0 -> tweet inexistant | 1 -> tweet existant
     *
     *
*/
        private function verif_tweet($id) // on vérifie si le tweet existe
    {

        $check_tweet = $this->Tweet->find()
                                    ->where(['id' => $id])
                                    ->orWhere(['id_tweet' => $id])
                                    ->count();

                                    //dd($check_tweet);

        return $check_tweet;
    }
/**
     * Méthode Get_Type_Profil
     *
     * Récupération du type de profil privé ou public
     *
     *
     * Sortie : 0 -> profil public | 1 -> profil privé
     *
     *
*/
    private function get_type_profil()
    {


        $type_profil = $this->Settings->find()
                                        ->select(['type_profil'])
                                        ->where(['user_id' => $this->Auth->user('username')]);

                    foreach ($type_profil as $type_profil)
                {
                    $type_profil = $type_profil->type_profil;
                }

        return $type_profil;
    }
/**
     * Méthode Testnotifshare
     *
     * Vérifie si la personne ,dont j'ai partagé le tweet, accepte les notifications de partage
     *
     * Paramètre : $username -> nom de la personne à vérifier
     *
     * Sortie : oui -> accepte | non -> refuse
     *
     *
*/
        private function testnotifshare($username)
    {


        $verif_notif = $this->Settings->find()
                                        ->select(['notif_partage'])
                                        ->where(['user_id' => $username]);

                    foreach ($verif_notif as $verif_notif)
                {
                    $settings_notif = $verif_notif['notif_partage'];
                }

             return $settings_notif;
    }
/**
     * Méthode Testshare
     *
     * Vérifie si j'ai déjà partager ce tweet
     *
     * Paramètre : $idtweet : id du tweet à vérifier
     *
     * Sortie : 0 -> pas partagé | 1 -> déjà partagé
     *
     *
*/
        private function testshare($idtweet)
    {
        

        $verif_share = $this->Partage->find()
                                        ->where(['tweet_partage' => $idtweet])
                                        ->where(['sharer' => $this->Auth->user('username')])
                                        ->count();



             return $verif_share;
    }

/**
     * Méthode Idtweet
     *
     * Calcul d'un id de tweet aléatoire
     *
     * Sortie : $idtweet -> id de tweet
     *
     *
*/
        private function idtweet()
    {

        $idtweet = rand();

        // on vérifie si il existe déjà

        $query = $this->Tweet->find()
                                ->select(['id'])
                                ->where(['id' => $idtweet]);

                if ($query->isEmpty())
            {
                return $idtweet;
            }
                else
            {
                idtweet(); // ou $this->idtweet();
            }
    }

}
