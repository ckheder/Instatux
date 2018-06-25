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
            'userosef' => $this->request->data('userosef'), // auteur du tweet, pas du comm
            'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );
            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);

        
          
            if ($this->Commentaires->save($commentaire)) {

              if( $this->request->data['userosef'] != $this->Auth->user('username')) // si je ne suis pas l'auteur du tweet, on vérifie si j'accepte les notifs de comm
                  {
                     if($this->testnotifcomm($this->request->data['userosef']) == "oui")
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

        $smilies = array(   
":smile:" => '<img src="/instatux/img/emoji/smile.png" alt=":smile:" class="emoji_comm" />',
":laughing:" => '<img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>',
":blush:" => '<img src="/instatux/img/emoji/blush.png" alt=":blush:" class="emoji_comm"/>',
":smiley:" => '<img src="/instatux/img/emoji/smiley.png" alt=":smiley:" class="emoji_comm"/>',
":relaxed:" => '<img src="/instatux/img/emoji/relaxed.png" alt=":relaxed:" class="emoji_comm"/>',
":smirk:" => '<img src="/instatux/img/emoji/smirk.png" alt=":smirk:" class="emoji_comm"/>',
":heart_eyes:" => '<img src="/instatux/img/emoji/heart_eyes.png" alt=":heart_eyes:" class="emoji_comm"/>',
":kissing_heart:" => '<img src="/instatux/img/emoji/kissing_heart.png" alt=":kissing_heart:" class="emoji_comm"/>',
":kissing_closed_eyes:" => '<img src="/instatux/img/emoji/kissing_closed_eyes.png" alt=":kissing_closed_eyes:" class="emoji_comm"/>',
":flushed:" => '<img src="/instatux/img/emoji/flushed.png" alt=":flushed:" class="emoji_comm"/>',
":relieved:" => '<img src="/instatux/img/emoji/relieved.png" alt=":relieved:" class="emoji_comm"/>',
":satisfied:" => '<img src="/instatux/img/emoji/satisfied.png" alt=":satisfied:" class="emoji_comm"/>',
":grin:" => '<img src="/instatux/img/emoji/grin.png" alt=":grin:" class="emoji_comm"/>',
":wink:" => '<img src="/instatux/img/emoji/wink.png" alt=":wink:" class="emoji_comm"/>',
":anguished:" => '<img src="/instatux/img/emoji/anguished.png" alt=":anguished:" class="emoji_comm"/>',
":astonished:" => '<img src="/instatux/img/emoji/astonished.png" alt=":astonished:" class="emoji_comm"/>',
":bowtie:" => '<img src="/instatux/img/emoji/bowtie.png" alt=":bowtie:" class="emoji_comm"/>',
":broken_heart:" => '<img src="/instatux/img/emoji/broken_heart.png" alt=":broken_heart:" class="emoji_comm"/>',
":clap:" => '<img src="/instatux/img/emoji/clap.png" alt=":clap:" class="emoji_comm"/>',
":confused" => '<img src="/instatux/img/emoji/confused.png" alt=":confused:" class="emoji_comm"/>',
":disappointed:" => '<img src="/instatux/img/emoji/disappointed.png" alt=":disappointed:" class="emoji_comm"/>',
":dizzy_face:" => '<img src="/instatux/img/emoji/dizzy_face.png" alt=":dizzy_face:" class="emoji_comm"/>',
":fearful:" => '<img src="/instatux/img/emoji/fearful.png" alt=":fearful:" class="emoji_comm"/>',
":grinning:" => '<img src="/instatux/img/emoji/grinning.png" alt=":grinning:" class="emoji_comm"/>',
":hushed:" => '<img src="/instatux/img/emoji/hushed.png" alt=":hushed:" class="emoji_comm" />',
":neutral_face:" => '<img src="/instatux/img/emoji/neutral_face.png" alt=":neutral_face:" class="emoji_comm"/>',
":open_mouth:" => '<img src="/instatux/img/emoji/open_mouth.png" alt=":open_mouth:" class="emoji_comm"/>',
":rage:" => '<img src="/instatux/img/emoji/rage.png" alt=":rage:" class="emoji_comm"/>',
":scream:" => '<img src="/instatux/img/emoji/scream.png" alt=":scream:" class="emoji_comm"/>',
":sleeping:" => '<img src="/instatux/img/emoji/sleeping.png" alt=":sleeping:" class="emoji_comm"/>',
":stuck_out_tongue_winking_eye:" => '<img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt=":stuck_out_tongue_winking_eye:" class="emoji_comm"/>',
":stuck_out_tongue_closed_eyes:" => '<img src="/instatux/img/emoji/stuck_out_tongue_closed_eyes.png" alt=":stuck_out_tongue_closed_eyes:" class="emoji_comm"/>',
":stuck_out_tongue:" => '<img src="/instatux/img/emoji/stuck_out_tongue.png" alt=":stuck_out_tongue:" class="emoji_comm"/>',
":sunglasses:" => '<img src="/instatux/img/emoji/sunglasses.png" alt=":sunglasses:" class="emoji_comm"/>',
":tired_face:" => '<img src="/instatux/img/emoji/tired_face.png" alt=":tired_face:" class="emoji_comm"/>',
":trollface:" => '<img src="/instatux/img/emoji/trollface.png" alt=":trollface:" class="emoji_comm"/>',
":unamused:" => '<img src="/instatux/img/emoji/unamused.png" alt=":unamused:" class="emoji_comm"/>',
":worried:" => '<img src="/instatux/img/emoji/worried.png" alt=":worried:" class="emoji_comm"/>'
);

$tweet = str_replace( array_keys( $smilies ), array_values( $smilies ), $tweet );
    return preg_replace('/#([^\s]+)/',
        '<a href="../search-%23$1">#$1</a>',
        $tweet);
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

}
