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

        // on recherche toutes les conversations non masquées, statut = 1 de l'utilisateur courant, on récupère le destinataire et la date de dernier message

        $this->loadModel('Conversation');

        $conv = $this->Conversation->find();

        $conv->select([
          'Messagerie.conv',
          'Users.avatarprofil',
          'participant2',
          'created' => $conv->func()->max('Messagerie.created'),
        ])
        ->leftjoin(
            ['Users'=>'users'],

            ['Users.username = (Conversation.participant2)']
    )
                ->leftjoin(
            ['Messagerie'=>'messagerie'],

            ['Messagerie.conv = (Conversation.conv)']
    )
        ->where(['participant1' => $this->Auth->user('username')])
        ->where(['statut' => 1])
        ->contain(['Users'])
        ->group('Messagerie.conv');
    
        $this->set(compact('conv'));


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
    $message = preg_replace('/(^|[^@\w])@(\w{1,15})\b/', // @username
        '$1<a href="./$2">@$2</a>',
        $message);
  $message = preg_replace('/:([^\s]+):/', '<img src="/instatux/img/emoji/$1.png" alt="$1" class="emoji_comm"/>', $message); // emoji
    $message = preg_replace('/#([^\s]+)/', '<a href="./search-%23$1">#$1</a>', $message); // #something

       $message = preg_replace("/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/",
        '<a href="$0">$0</a>',$message); // url
       
      return $message; 
}

}

