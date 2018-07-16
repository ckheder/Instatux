<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Commentaires Controller
 *
 * @property \App\Model\Table\CommentairesTable $Commentaires
 */
class CommentairesController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
         if ($this->request->is('ajax')) {

            if ($this->allowcomment($this->request->data('id')) == 1) // commentaire désactivé
            {
                                $reponse = 'commdesac';
                $this->response->body($reponse);
            }

            else
            {

        $commentaire = $this->Commentaires->newEntity();
// suppression des balises éventuelles

          $comm = strip_tags($this->request->data('comm'));

          $idcomm = $this->idcomm();

            $data = array(
            'id' => $idcomm,
            'comm' =>  $this->linkify_tweet($comm),
            'tweet_id' => $this->request->data('id'), // id du tweet
            'user_id' => $this->Auth->user('id'),
            
            // pour évènement
            'auttweet' => $this->request->data('auttweet'), // auteur du tweet, pas du comm
            'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );
            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);

        
          
            if ($this->Commentaires->save($commentaire)) {

              if( $this->request->data['auttweet'] != $this->Auth->user('username')) // si je ne suis pas l'auteur du tweet, on vérifie si j'accepte les notifs de comm
                  {
                     if($this->testnotifcomm($this->request->data['auttweet']) == "oui")
                {
              // évènement
              $event = new Event('Model.Commentaires.afterAdd', $this, ['commentaire' => $commentaire]);
                $this->eventManager()->dispatch($event);
              }
                //fin évènement
              }

                        
            $this->response->body(json_encode($data));
 

            } else {
                $reponse = 'probleme';
                $this->response->body($reponse);

            }

   
}
return $this->response;
    }
  }

    /**
     * Edit method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {

        if ($this->request->is('ajax')) {

            $comm = strip_tags($this->request->data('comm')); // élimination de balise




        $query = $this->Commentaires->query()
                            ->update()
                            ->set(['comm' => $this->linkify_tweet($comm), 'edit' => 1])
                            ->where(['id' => $this->request->getParam('id')])
                            ->Where(['user_id' => $this->Auth->user('id')])
                            ->execute();

        if($query)
        {
            $data = array(
'idcomm' => $this->request->getParam('id'),
'comm' => $this->linkify_tweet($comm),
'reponse' => 'Commentaire modifié avec succès'
            );

$this->response->body(json_encode($data));
        }
        else {
                $reponse = 'probleme';
                $this->response->body($reponse);

            }

   return $this->response;




}

    
}
    /**
     * Delete method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) // id-> id du commentaire, 

    {

      if ($this->request->is('ajax')) {
        $commentaire = $this->Commentaires->get($this->request->getParam('id'));

        if ($this->Commentaires->delete($commentaire)) 
        {
            
$reponse = 'suppcommok';
    
}
    else 
    {
            $reponse = 'suppcommfail';
        }

                        $this->response->body($reponse);
    return $this->response;

 }



    }

    private function testnotifcomm($username) // on vérifie si l'auteur du tweet accepte les notifications de commentaire'
    {
                $this->loadModel('Settings');

        $verif_notif = $this->Settings->find()->select(['notif_comm'])->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // recupération de la conversation
                {
                $settings_notif = $verif_notif['notif_comm'];
                }

             return $settings_notif;
    }

            // parsage des tweets et des emoticones
    private function linkify_tweet($tweet) 
    {
    $tweet = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="../$2">@$2</a>',
        $tweet);

$tweet =  preg_replace('/:([^\s]+):/', '<img src="/instatux/img/emoji/$1.png" alt=":$1:" class="emoji_comm"/>', $tweet); // emoji
    $tweet =  preg_replace('/#([^\s]+)/',
        '<a href="../search-%23$1">#$1</a>',
        $tweet);

   $tweet = preg_replace("/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/",
        '<a href="$0">$0</a>',$tweet);


    return $tweet;
}

private function idcomm() // calcul d'un id de comm aléatoire
{

    $idcomm = rand();

    $query = $this->Commentaires->find()->select(['id'])->where(['id' => $idcomm]);

     if ($query->isEmpty())
     {
        return $idcomm;
     }
     else
    {
        idcomm();
    }

}

private function allowcomm($idtweet) // test de l'activation des commentaires
{
    $this->loadModel('Tweet');

    $allowcomment = $this->Tweet->find()->select(['allow_comment'])->where(['id' => $idtweet]);

        foreach ($allowcomment as $$allowcomment) // recupération du résultat
                {
                $allowcomm = $allowcomment['allow_comment'];
                }

             return $allowcomm;
}

}
