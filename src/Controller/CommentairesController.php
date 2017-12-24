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
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tweets']
        ];
        $commentaires = $this->paginate($this->Commentaires);

        $this->set(compact('commentaires'));
        $this->set('_serialize', ['commentaires']);
    }

    /**
     * View method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentaire = $this->Commentaires->get($id, [
            'contain' => ['Tweets']
        ]);

        $this->set('commentaire', $commentaire);
        $this->set('_serialize', ['commentaire']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

      
        $commentaire = $this->Commentaires->newEntity();
        if ($this->request->is('post')) {
            $data = array(
            'comm' =>  $this->linkify_tweet($this->request->data('comm')),
            'tweet_id' => $this->request->data('id'), // id du tweet
            'user_id' => $this->Auth->user('id'),
            
            // pour évènement
            'userosef' => $this->request->data('userosef'), // auteur du tweet
            'user_session' => $this->Auth->user('id'), // id de session
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil')
            );
            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);

        
          
            if ($this->Commentaires->save($commentaire)) {

              if( $this->request->data['userosef'] != $this->Auth->user('username'))
                  {
                     if($this->testnotifcomm($this->request->data['userosef']) == "oui")
                {
              // évènement
              $event = new Event('Model.Commentaires.afterAdd', $this, ['commentaire' => $commentaire]);
                $this->eventManager()->dispatch($event);
              }
                //fin évènement
              }

                $this->Flash->success(__('Commentaire posté avec succès.'));

            } else {
                $this->Flash->error(__('Impossible de commenter.'));

            }
        }

                        return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
$this->request->data['id']
        
]);


    }

    /**
     * Edit method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $tweet = null)
    {
        $this->viewBuilder()->layout('profil');


        $commentaire = $this->Commentaires->get($id, [
            'contain' => []
        ]);

        // vérif auteur
        $auteur_verif = $this->Commentaires->find();
        $auteur_verif->where([

'auteur' =>  $this->Auth->user('id')

            ])
        ->where(['id'=>$id]);

      
        // fin vérif auteur

  if (!$auteur_verif->isEmpty())
        {

        if ($this->request->is(['post', 'put'])) {

// tableau de données

            $data = array(
            'id'=>$id, // id du comm
            'comm' =>  $this->request->data['comm'], // commentaire
            'tweet_id' => $tweet, // id du tweet
            'user_id' => $this->Auth->user('id') // utilisateur
            );


            $commentaire = $this->Commentaires->patchEntity($commentaire, $data);
            if ($this->Commentaires->save($commentaire)) {
                $this->Flash->success(__('Commentaire modifié avec succès !.'));

                        return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
    '?' => [
        'id' => $tweet
        
]]);
                    }
            }
            } else {
                $this->Flash->error(__('Modification impossible.'));
            }
        
        
        $this->set(compact('commentaire'));
        $this->set('_serialize', ['commentaire']);
    
}
    /**
     * Delete method
     *
     * @param string|null $id Commentaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $tweet = null)
    {

        // vérif auteur

        $auteur_verif = $this->Commentaires->find();
        $auteur_verif->where([

'user_id' =>  $this->Auth->user('id')

            ])
        ->where(['id'=>$id]);

        // vérif si c'est l'auteur du tweet

        $auteur_tweet = $this->Commentaires->Tweet->find();

        $auteur_tweet->where([

'id' =>  $tweet

            ])
         ->where(['user_id'=>$this->Auth->user('id')]);
       
        
        if (!$auteur_verif->isEmpty() or !$auteur_tweet->isEmpty()) // si résultat on supprime
        {
       //$this->request->allowMethod(['post', 'delete']);
        $commentaire = $this->Commentaires->get($id);
        if ($this->Commentaires->delete($commentaire)) 
        {
            $this->Flash->success(__('Commentaire supprimé.'));
        } 

        return $this->redirect([
    'controller' => 'tweet',
    'action' => 'view',
    
        $tweet
        
]);
    }

    else 
    {
            $this->Flash->error(__('Impossible de supprimé ce commentaire.'));
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
":smile:" => '<img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" />',
":laughing:" => '<img src="/instatux/img/emoji/laughing.png" alt="" class="emoji_comm"/>',
":blush:" => '<img src="/instatux/img/emoji/blush.png" alt="" class="emoji_comm"/>',
":smiley:" => '<img src="/instatux/img/emoji/smiley.png" alt="" class="emoji_comm"/>',
":relaxed:" => '<img src="/instatux/img/emoji/relaxed.png" alt="" class="emoji_comm"/>',
":smirk:" => '<img src="/instatux/img/emoji/smirk.png" alt="" class="emoji_comm"/>',
":heart_eyes:" => '<img src="/instatux/img/emoji/heart_eyes.png" alt="" class="emoji_comm"/>',
":kissing_heart:" => '<img src="/instatux/img/emoji/kissing_heart.png" alt="" class="emoji_comm"/>',
":kissing_closed_eyes:" => '<img src="/instatux/img/emoji/kissing_closed_eyes.png" alt="" class="emoji_comm"/>',
":flushed:" => '<img src="/instatux/img/emoji/flushed.png" alt="" class="emoji_comm"/>',
":relieved:" => '<img src="/instatux/img/emoji/relieved.png" alt="" class="emoji_comm"/>',
":satisfied:" => '<img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>',
":grin:" => '<img src="/instatux/img/emoji/grin.png" alt="" class="emoji_comm"/>',
":wink:" => '<img src="/instatux/img/emoji/wink.png" alt="" class="emoji_comm"/>',
":anguished:" => '<img src="/instatux/img/emoji/anguished.png" alt="" class="emoji_comm"/>',
":astonished:" => '<img src="/instatux/img/emoji/astonished.png" alt="" class="emoji_comm"/>',
":bowtie:" => '<img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/>',
":broken_heart:" => '<img src="/instatux/img/emoji/broken_heart.png" alt="" class="emoji_comm"/>',
":clap:" => '<img src="/instatux/img/emoji/clap.png" alt="" class="emoji_comm"/>',
":confused" => '<img src="/instatux/img/emoji/confused.png" alt="" class="emoji_comm"/>',
":disappointed:" => '<img src="/instatux/img/emoji/disappointed.png" alt="" class="emoji_comm"/>',
":dizzy_face:" => '<img src="/instatux/img/emoji/dizzy_face.png" alt="" class="emoji_comm"/>',
":fearful:" => '<img src="/instatux/img/emoji/fearful.png" alt="" class="emoji_comm"/>',
":grinning:" => '<img src="/instatux/img/emoji/grinning.png" alt="" class="emoji_comm"/>',
":hushed:" => '<img src="/instatux/img/emoji/hushed.png" alt="" class="emoji_comm" />',
":neutral_face:" => '<img src="/instatux/img/emoji/neutral_face.png" alt="" class="emoji_comm"/>',
":open_mouth:" => '<img src="/instatux/img/emoji/open_mouth.png" alt="" class="emoji_comm"/>',
":rage:" => '<img src="/instatux/img/emoji/rage.png" alt="" class="emoji_comm"/>',
":scream:" => '<img src="/instatux/img/emoji/scream.png" alt="" class="emoji_comm"/>',
":sleeping:" => '<img src="/instatux/img/emoji/sleeping.png" alt="" class="emoji_comm"/>',
":stuck_out_tongue_winking_eye:" => '<img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt="" class="emoji_comm"/>',
":stuck_out_tongue_closed_eyes:" => '<img src="/instatux/img/emoji/stuck_out_tongue_closed_eyes.png" alt="" class="emoji_comm"/>',
":stuck_out_tongue:" => '<img src="/instatux/img/emoji/stuck_out_tongue.png" alt="" class="emoji_comm"/>',
":sunglasses:" => '<img src="/instatux/img/emoji/sunglasses.png" alt="" class="emoji_comm"/>',
":tired_face:" => '<img src="/instatux/img/emoji/tired_face.png" alt="" class="emoji_comm"/>',
":trollface:" => '<img src="/instatux/img/emoji/trollface.png" alt="" class="emoji_comm"/>',
":unamused:" => '<img src="/instatux/img/emoji/unamused.png" alt="" class="emoji_comm"/>',
":worried:" => '<img src="/instatux/img/emoji/worried.png" alt="" class="emoji_comm"/>'
);

$tweet = str_replace( array_keys( $smilies ), array_values( $smilies ), $tweet );
    return preg_replace('/#([^\s]+)/',
        '<a href="../search-%23$1">#$1</a>',
        $tweet);
}

}
