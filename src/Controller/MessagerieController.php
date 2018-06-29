<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Messagerie Controller
 *
 * @property \App\Model\Table\MessagerieTable $Messagerie
 */
class MessagerieController extends AppController
{

    public $components = array('RequestHandler');

    public $paginate = [
        'limit' => 8,
        'order' => [
            'Messagerie.created' => 'desc'
        ]
    ];

            public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']); // on empeche l'accès a l'index si je ne suis pas auth
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
        $this->set('title', 'Messagerie'); // titre de la page

        // on recherche toutes les conversations non masquées, statut = 1 de l'utilisateur courant

        $this->loadModel('Conversation');

        $conv = $this->Conversation->find()

        ->select(['conv'])
        //->select(['conv' => $conv->func()->count('conv')])
        ->where(['participant1' => $this->Auth->user('username')])
        ->where(['statut' => 1]);

        // requête des conversations, on recherche tous les id de derniers messages reçu ou envoyés par moi et on les regroupe par conv
        // $conv regroupe toutes les conversations non masquées 

    $matchingComment = $this->Messagerie->find();
    $matchingComment->select(['Messagerie_id' => $matchingComment->func()->max('Messagerie.id')])
    ->where(['destinataire' => $this->Auth->user('username')])
    ->orwhere(['user_id'=>$this->Auth->user('username')])
    ->where(['Messagerie.conv IN' => $conv])
    ->order(['Messagerie.created' => 'DESC'])
    ->group('conv');
    
        // requête des messages, on affiche tous ces messages

        $message = $this->Messagerie->find()

       ->where(['Messagerie.id IN' =>   $matchingComment]);
    
        $this->set(compact('message'));
        

}

// vérification que l'on peut accéder à une conversation
    
    private function verifconv($username)
    {
        $this->loadModel('Conversation');
        $verif = $this->Conversation->find();
       
        $verif->where(['participant1' => $username])
        ->orwhere(['participant2'=> $username])
        ->where(['conv' => $this->request->getParam('id')]);

        if ($verif->isEmpty())
        {
            return 0; // pas le droit
        }
        else
        {
            return 1; // autorisé
        }
    }

    /**
     * View method
     * voir les messages d'une conversation
     * @param string|null $id Messagerie id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) // voir une conversation
    {
        $this->viewBuilder()->layout('general');
         


         $verif_user = $this->verifconv($this->Auth->user('username'));

         if($verif_user == 0)
         {
            $this->Flash->error(__('Vous n\'avez pas l\'autorisation de voir cette conversation.'));
                return $this->redirect([
                    'controller' => 'messagerie',
    'action' => 'index'
        
]);
               
                die();
         }
         else
         {

   $message = $this->Messagerie->find()->select([ 
  'Messagerie.user_id', 
  'Messagerie.destinataire', 
  'Messagerie.message', 
  'Messagerie.created',  
  'Users.avatarprofil', 
            ])
        ->where(['conv' => $this->request->getParam('id')])
        ->order(['Messagerie.created' => 'DESC'])

        ->contain(['Users']);
   $this->set('message', $this->Paginator->paginate($message, ['limit' => 8]));


             try {
        $this->paginate();
    } catch (NotFoundException $e) {
        // Faire quelque chose ici comme rediriger vers la première ou dernière page.
        // $this->request->getParam('paging') vous donnera les infos demandées.
   }


            // fin pagination

foreach ($message as $message): 
                        
if($message->user_id == $this->Auth->user('username'))
{
 $destinataire = $message->destinataire;
 }
 else
 {
 $destinataire = $message->user_id;
 }

endforeach;

$this->set('title', 'Conversation avec  '.$destinataire.''); // titre de la page

$this->set('destinataire', $destinataire);

}
  
    }

        // parsage des tweets
    private function linkify_tweet($tweet) 
    {
        // remplacement des @ -> lien vers profil
    $tweet = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="$2">@$2</a>',
        $tweet);
        // remplacement des liens par des liens cliquables
    $tweet = preg_replace('#(https?://)([\w\d.&:\#@%/;$~_?\+-=]*)#','<a href="$1$2" target="_blank">$2</a>',$tweet);

    // remplacement des # -> lien vers moteur de recherche
    return preg_replace('/#([^\s]+)/',
        '<a href="search-%23$1">#$1</a>',
        $tweet);
}


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() // envoyer un message, ajout auto à une conv ou création d'une nouvelle
    {

       if ($this->request->is('ajax')) {


         if($this->test_blocage($this->request->data['destinataire'])) // si je suis bloqué
        {

        $reponse = 'blocage';
         $this->response->body($reponse);

        }
        else
        {


$message = $this->Messagerie->newEntity();

if(isset($this->request->data['conversation'])) // on vérifie si j'envoi une conversation -> view.ctp
{
    $conversation = $this->request->data['conversation'];
    $new_conv = 1; // conversation existante
}
else
{
       $this->loadModel('Conversation'); // on vérifie si il y'a déjà une conversation entre nous

$checkconv = $this->Conversation
        ->find()
        ->select(['conv'])
        ->where([

'participant1' =>  $this->Auth->user('username') // moi

            ])
        ->where(['participant2' => $this->request->data['destinataire']]);


 if ($checkconv->isEmpty()) // si pas de résultat, on crée une nouvelle conversation
        {

            $conversation = rand();
            $new_conv = 0; // conversatio in existante

            }
            else
            {
                foreach ($checkconv as $row) // recupération de la conversation
                {
                $conversation = $row['conv'];
                $new_conv = 1; // converstion existante
                }

            }
}

if(isset($this->request->data['avatar']))
{
  $avatar = $this->request->data['avatar'];
}
else
{
   $avatar = $this->Auth->user('avatarprofil');
}

// notification de message pour mon destinataire

if($this->testnotifmessage($this->request->data['destinataire']) === "oui")
                {

                  $notif = "oui";
                }
                else
                {
                  $notif = "non";
                }
// fin notification de message pour mon destinataire


$messages = strip_tags($this->request->data('message')); // echappement des caractères dans le message envoyé
        
            $data = array(
            'user_id' => $this->Auth->user('username'), // expediteur
            'destinataire' => $this->request->data['destinataire'],
            'message' =>  $this->linkify_message($messages), // message
            'conv' => $conversation,
            //evenement abonnement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' =>$avatar,
             'new_conv' => $new_conv,
             'notif' =>$notif
            );

            $message = $this->Messagerie->patchEntity($message, $data);
            
            if ($this->Messagerie->save($message)) 
            {

                    //évènenement

                 $event = new Event('Model.Messagerie.afterAdd', $this, ['message' => $message]);
                $this->eventManager()->dispatch($event);
            
                // fin évènement

        
        
    }
    $this->response->body(json_encode($data));
    }
      return $this->response;      
}
}

        private function test_blocage($username) // on vérifie que le destinataire ne m'a pas bloqué
    {
        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $username])->where(['bloquer' => $this->Auth->user('username') ]);

        $result_blocage = $verif_blocage->count();

             return $result_blocage;
    }

    private function testnotifmessage($username) // on vérifie si la personne à qui j'envoi un message accepte les notifications de message
    {
                $this->loadModel('Settings');

        $verif_notif = $this->Settings->find()->select(['notif_message'])->where(['user_id' => $username]);

        foreach ($verif_notif as $verif_notif) // recupération de la conversation
                {
                $settings_notif = $verif_notif['notif_message'];
                }

             return $settings_notif;
    }

                // parsage des tweets et des emoticones
    private function linkify_message($message) 
    {
    $message = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="../$2">@$2</a>',
        $message);

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

$message = str_replace( array_keys( $smilies ), array_values( $smilies ), $message );
    return preg_replace('/#([^\s]+)/',
        '<a href="../search-%23$1">#$1</a>',
        $message);
}




}
