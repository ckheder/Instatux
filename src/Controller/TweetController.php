<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
//use App\Controller\Component\AuthComponent;

/**
 * Tweet Controller
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
        $this->Auth->deny(['accueuil']); // on bloque l'accès a l'actu des gens connectes
    }

                public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('general');
        $this->set('title', ''.$this->request->getParam('username').' | Instatux'); // titre de la page

        $username = $this->request->getParam('username'); // nom en paramètre

        if($username != $this->Auth->user('username')) // si je ne suis pas sur mon profil
    {


            if($this->allow_see_profil($username) == 0) // profil privé et non abonné
        {
            $no_follow = 0;
            $this->set('no_follow', $no_follow);

        }


    }

    if(!isset($no_follow)) // si je suis abonné ou profil public 
    {
        $tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
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
         // titre de la page
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
// VÉRIFIER SI JE PEUT VOIR UN PROFIL
    private function allow_see_profil($username) // $username = $this->request->getPram('username')
    {

        // 1) on vérifie si je suis bloqué : bloqueur -> l'autre et bloqué -> moi

        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $username])->where(['bloquer' => $this->Auth->user('username')]);

        $result_blocage = $verif_blocage->count();

        if($result_blocage == 1) // je suis bloqué
        {
            return $voir = 0; // interdiction de voir le profil
        }
        else
        {
        // récupération du profil courant 1) profil prive 0/ profil public

        $this->loadModel('Settings');

        $type_profil = $this->Settings->find()->select(['type_profil'])->where(['user_id' => $username]);

        foreach($type_profil as $type_profil)

            $type_profil = $type_profil->type_profil;

            if($type_profil == 1) // profil privé
            {

        // on vérifie si je suis abonné

        $this->loadModel('Abonnement');

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

            return $voir;
    }


    /**
     * View method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('general');
        $this->set('title', 'Commentaires'); // titre de la page


        $info_tweet = $this->Tweet->find()->select([
            'Users.username',
            'Users.avatarprofil',
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
            ]) // récupération des infos du tweet

        ->where(['Tweet.id' => $this->request->getParam('id')])


        ->contain(['Users']);

        $this->set('tweet', $info_tweet);

        // partie commentaire

        $this->loadModel('Commentaires');

        $comm_tweet = $this->Commentaires->find()->select([
          'Commentaires.id',
  'Commentaires.comm',
  'Commentaires.user_id',
  'Commentaires.created',
  'Commentaires.edit',
  'Users.username',
  'Users.avatarprofil',
        ])

        ->where(['Commentaires.tweet_id' => $this->request->getParam('id')])
        ->order(['Commentaires.created' => 'DESC'])
        ->contain(['Users']);


            if($this->allow_view_tweet($this->Auth->user('username')) == 0) // pas le droit de voir le tweet
        {
            $no_follow = 0;
            $this->set('no_follow', $no_follow);


        }
        else
        {
        $this->set('commentaires', $this->Paginator->paginate($comm_tweet, ['limit' => 8]));
    }


    }

        /**
     * allow-view_tweet method
     * test des autorisations de voir un tweet
     * @param string| $username $this->Auth->user('username').
     */

        private function allow_view_tweet($username)
    {

        $tweet = $this->Tweet->find() // on récupère l'auteur du tweet et si c'est un partage et si il est privé

        ->select(['Tweet.user_id', 'share','private'])

        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($tweet as $tweet)
        {
            $auteur_tweet = $tweet->user_id;
            $share = $tweet->share;
            $private = $tweet->private;
        }

        if($auteur_tweet != $this->Auth->user('username'))
        {

        // 1) on vérifie si je suis bloqué : bloqueur -> l'autre et bloqué -> moi

        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $auteur_tweet])->where(['bloquer' => $this->Auth->user('username')]);

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

                if($auteur_tweet != $this->Auth->user('username') AND $share == 0) // je ne suis pas l'auteur et que ce n'est pas un tweet partagé

                {

        // on vérifie si je suis abonné

        $this->loadModel('Abonnement');

        $verif_abo = $this->Abonnement->find()->where(['user_id' => $this->Auth->user('username')])

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

    // parsage des tweets : smiley, @,#,media
    private function linkify_tweet($tweet)
    {
        $tweet = preg_replace('/(^|[^@\w])@(\w{1,15})\b/', // @username
        '$1<a href="$2">@$2</a>',
        $tweet);

        $tweet =  preg_replace('/:([^\s]+):/', '<img src="/instatux/img/emoji/$1.png" alt=":$1:" class="emoji_comm"/>', $tweet); // emoji

        //lien

        $pattern_url = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/';

        if(preg_match_all($pattern_url, $tweet))
        {
            $tweet = preg_replace($pattern_url, '<a href="$1">$1</a>', $tweet);
        }
 
        // traitement média

        if (preg_match('~\[videoYoutube]([^{]*)\[/videoYoutube]~i', $tweet)) // youtube
        {
        $tweet = preg_replace('~\[videoYoutube]([^{]*)\[/videoYoutube]~i', '<iframe src="https://www.youtube.com/embed/$1"  width="100%" height="360" frameborder="0" allowfullscreen></iframe>', $tweet);
        
    }

        elseif (preg_match('~\[videoDailymotion]([^{]*)\[/videoDailymotion]~i', $tweet)) { // dailymotion
        $tweet = preg_replace('~\[videoDailymotion]([^{]*)\[/videoDailymotion]~i', '<p><iframe frameborder="0" width="100%" height="360" src="//www.dailymotion.com/embed/video/$1" allowfullscreen></iframe></p>', $tweet);
    }
            elseif (preg_match('~\[clipTwitch]([^{]*)\[/clipTwitch]~i', $tweet)) { // clip twitch
        $tweet = preg_replace('~\[clipTwitch]([^{]*)\[/clipTwitch]~i', '<p><iframe src="https://clips.twitch.tv/embed?autoplay=false&clip=$1&tt_content=embed&tt_medium=clips_embed" width="100%" height="360" frameborder="0" scrolling="no" allowfullscreen="true"></iframe></p>', $tweet);
    }
                elseif (preg_match('~\[videoTwitch]([^{]*)\[/videoTwitch]~i', $tweet)) { // video twitch
        $tweet = preg_replace('~\[videoTwitch]([^{]*)\[/videoTwitch]~i', '<p><iframe src="https://player.twitch.tv/?autoplay=false&video=v$1" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="100%"></iframe></p>', $tweet);
    }
                elseif (preg_match('~\[InstagramPost]([^{]*)\[/InstagramPost]~i', $tweet)) { // instagram
        $tweet = preg_replace('~\[InstagramPost]([^{]*)\[/InstagramPost]~i', '<p><iframe src="https://www.instagram.com/p/$1/embed/captioned/" width="100%" height="780" frameborder="0" scrolling="no" allowtransparency="true"></iframe></p>', $tweet);
    }
                    elseif (preg_match('~\[imageUrl]([^{]*)\[/imageUrl]~i', $tweet)) { // lien vers une image distante
        $tweet = preg_replace('~\[imageUrl]([^{]*)\[/imageUrl]~i', '<a href="$1" ><img src="$1" width="100%" /></a>', $tweet);
    }

    // lien   



        $tweet =  preg_replace('/#([^\s]+)/',#something
        '<a href="search-%23$1">#$1</a>',
        $tweet);

        $tweet = nl2br($tweet);

        return('<p><p>'.$tweet.'</p></p>');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
               
         if ($this->request->is('ajax')) {
            $tweet = $this->Tweet->newEntity();
            $contenu_tweet = htmlspecialchars($this->request->data('contenu_tweet'));
            //test et traitement envoi d'avatar
            $file = $this->request->data['file'];
            if($file['size'] != 0)
            {
            $contenu_tweet = $this->tweetupload($file, $contenu_tweet);
            }
            $idtweet = $this->idtweet();
            // fin test et traitement envoi avatar
                   $data = array(
                    
            'id' => $idtweet,
            'user_id' => $this->Auth->user('username'),
            'user_timeline' => $this->Auth->user('username'),
            'contenu_tweet' => $this->linkify_tweet($contenu_tweet),
            'private' =>$this->get_type_profil($this->Auth->user('username')),
                        //evenement username
            'avatar_session' => $this->Auth->user('avatarprofil'),
            'auth_name' => $this->Auth->user('username')
            );
            $tweet = $this->Tweet->patchEntity($tweet, $data);



            if ($this->Tweet->save($tweet)) {
                // évènement hashtag/username

                 $event = new Event('Model.Tweet.afterAdd', $this, ['tweet' => $tweet]);

                $this->eventManager()->dispatch($event);

                //fin évènement hashtag
                $this->response->body(json_encode($data));


            } else {
                $reponse = 'probleme';
                $this->response->body($reponse);
            }
                  
    return $this->response;
        }

    }



    /**
     * Delete method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        if ($this->request->is('ajax')) {

 $tweet_verif = $this->Tweet->find();
        $tweet_verif->where([

'user_timeline' =>  $this->Auth->user('username') // id de la personne connecté

            ])
        ->where(['id' => $this->request->getParam('id')]);

        if(!$tweet_verif->isEmpty())
        {
            $id_tweet = $this->request->getParam('id');
            $entity = $this->Tweet->get($id_tweet); // création de l'entité abonnement
            $result = $this->Tweet->delete($entity);
            if($result)
            {
            $reponse = 'tweetsupprime';
        }
        else {
            $reponse = 'echectweetsupprime';
        }
        }




        $this->response->body($reponse);
    return $this->response;


    }
    else
    {
        $this->Flash->error(__('Impossible de supprimé.'));
        return $this->redirect($this->referer());
    }
    }

    // partage d'un tweet
    public function share($id = null)
    {

        if ($this->request->is('ajax')) {

// on vérifie si je n'ais pas déjà partagé

            if($this->testshare($this->request->getParam('id')) == 1) // j'ai déjà partager
            {
                $reponse = 'deja';
            }
            else
            {

// fin vérification si j'ai déjà partagé un tweet

        $tweet = $this->Tweet->newEntity();

        $info_tweet = $this->Tweet->find() // on récupère les infos du tweet pour le recrée
        ->select([
         'user_id',
         'contenu_tweet',
            ])
        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($info_tweet as $info_tweet)
        {
            $user_tweet = $info_tweet->user_id;
            $contenu_tweet = $info_tweet->contenu_tweet;
        }

          if($this->testnotifshare($user_tweet) === "oui") // on vérifie si l'auteur du tweet veut une notification de partage
                {
                    $notif = 'oui';
                }
                else
                {
                    $notif = 'non';
                }

        $data = array(
            'id' => $this->request->getParam('id'),
            'user_id' => $user_tweet,
            'user_timeline' => $this->Auth->user('username'),
            'contenu_tweet' => $contenu_tweet,
            'share' => 1,
            // évènement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil'),
            'id_tweet' => $this->request->getParam('id'),
             'notif' =>$notif
            );
            $tweet = $this->Tweet->patchEntity($tweet, $data);
            if ($this->Tweet->save($tweet)) {


                 $event = new Event('Model.Partage.afterAdd', $this, ['tweet' => $tweet]);
                $this->eventManager()->dispatch($event);


                 $reponse = 'shareok';


            } else {
               $reponse = 'probleme';
            }

}
                                   $this->response->body($reponse);
    return $this->response;


    }

    }
    // tweet actualités connectés

    public function accueuil()
    {
                $this->viewBuilder()->layout('onlinenews');
                $this->set('title', 'Instatux | Actualités'); // titre de la page
                $abonnement = $this->Tweet->find()
                ->select([
            'Users.username',
            'Users.avatarprofil',
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

       ->where([

        'Abonnement.user_id' =>  $this->Auth->user('username')

            ])
        ->contain(['Users'])
        ->contain(['Abonnement']);

        $nb_tweet_accueuil = $abonnement->count();

        if($nb_tweet_accueuil == 0)
        {
            $this->set('nb_tweet_accueuil', $nb_tweet_accueuil);
        }


     $this->set('abonnement', $this->paginate($abonnement, ['limit' => 8]));

    }

    // fin tweet actualités connectés

        // tweet actualités offline => tous les tweets publics

    public function actualites()
    {
                $this->viewBuilder()->layout('offlinenews');
                $this->set('title', 'Instatux | Actualités'); // titre de la page
                $actu = $this->Tweet->find()
                ->select([
            'Users.username',
            'Users.avatarprofil',
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

        ->where(['Tweet.private' =>  0])
        ->where(['Tweet.share' =>  0])
        ->contain(['Users']);


     $this->set('actu', $this->paginate($actu, ['limit' => 8]));

    }

    // fin tweet actualités offline


    public function allowComment() // activer/désactiver les commentaires  1 -> désactiver, 0 -> activer
    {

        if ($this->request->is('ajax')) {

          $query = $this->Tweet->query()
                            ->update()
                            ->set(['allow_comment' => $this->request->getParam('etat')])
                            ->where(['id' => $this->request->getParam('idtweet')])
                            ->where(['user_timeline' => $this->Auth->user('username')]) // on vérifie que ce tweet est le tweet courant et que j'en suis le timeline
                            ->execute();

        if($query AND $this->request->getParam('etat') == 0)
        {
              $reponse = 'commac';


        }
        elseif($query AND $this->request->getParam('etat') == 1)
        {
              $reponse = 'commdesac';


        }
        else
        {
                $reponse = 'probleme';
        }


        $this->response->body($reponse);
    return $this->response;


    }
    else
    {
        $this->Flash->error(__('Impossible de faire cette action.'));
        return $this->redirect($this->referer());
    }
    }


        private function verif_user($username) // on vérifie si l'utilisateur existe
    {
        $this->loadModel('Users');
        $check_user = $this->Users->find()->where(['username' => $username ])->count();
        return $check_user;
    }

    private function get_type_profil() // récupération du type de profil privé ou public
    {
        $this->loadModel('Settings');

        $type_profil = $this->Settings->find()->select(['type_profil'])->where(['user_id' => $this->Auth->user('username')]);

        foreach ($type_profil as $type_profil)
        {
            $type_profil = $type_profil->type_profil;
        }

        return $type_profil;
    }

        private function testnotifshare($username) // on vérifie si la personne à qui j'envoi un message accepte les notifications de message
    {
                $this->loadModel('Settings');

        $verif_notif = $this->Settings->find()->select(['notif_partage'])->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // recupération de la conversation
                {
                $settings_notif = $verif_notif['notif_partage'];
                }

             return $settings_notif;
    }

        private function testshare($idtweet) // on vérifie si j'ai déjà partager ce tweet
    {
                $this->loadModel('Partage');

        $verif_share = $this->Partage->find()->where(['tweet_partage' => $idtweet])->where(['sharer' => $this->Auth->user('username')])->count();



             return $verif_share;
    }

       private function tweetupload($file,$tweet) // on envoi le ficheri pour vérification et le contenu_tweet pour conversion
        {


if($file['error'] != 0)
{
  return $erreur = 'Problème lors de l\'envoi de votre fichier.Veuillez réessayer.';
}

      $imageMimeTypes = array( // type MIME autorisé
      'image/jpg',
      'image/png',
      'image/jpeg');

      $fileMimeType = mime_content_type($file['tmp_name']); // récupération du type MIME
      if (!in_array($fileMimeType, $imageMimeTypes)) // test de l'extension du fichier
            {
                     $erreur = 'Ce n\'est pas une image';
            }

      if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                      {

                $uploadPath = 'img/photos/'.$this->Auth->user('username').'/';

                if(move_uploaded_file($file['tmp_name'], $uploadPath.basename($file['name'])))
                {
                    $tweet = preg_replace('~\[image]([^{]*)\[/image]~i', '<img src="'.$uploadPath.basename($file['name']).'" width="100%" />', $tweet);

                    return $tweet;
                }

                    else
                    {

                      return $reponse = 'Impossible d\'envoyer ce fichier';

                    }

}
else {
  return $erreur;
}


        }

        private function idtweet() // calcul d'un id de comm aléatoire
{

    $idtweet = rand();

    $query = $this->Tweet->find()->select(['id'])->where(['id' => $idtweet]);

     if ($query->isEmpty())
     {
        return $idtweet;
     }
     else
    {
        idtweet();
    }

}





}
