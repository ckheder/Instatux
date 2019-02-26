<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;

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
        $this->viewBuilder()->layout('messagerie');
        $this->set('title', 'Messagerie'); // titre de la page

        // on recherche toutes les conversations non masquées, statut = 1 de l'utilisateur courant, on récupère le destinataire et la date de dernier message

        $this->loadModel('Conversation');

        $conv = $this->Conversation->find();

        $conv->select([
          'Messagerie.conv',
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

        $nb_conv = $conv->count();

        $this->set('nb_conv', $nb_conv);


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
            $this->Flash->error(__('Vous n\'avez pas l\'autorisation de voir cette conversation, soit elle n\'existe pas , soit vous n\'en faites pas partie soit la personne avec qui vous parliez n\'existe plus.'));
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
            ])
        ->where(['conv' => $this->request->getParam('id')])
        ->order(['Messagerie.created' => 'DESC']);


   $this->set('message', $this->Paginator->paginate($message, ['limit' => 8]));


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



    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() // envoyer un message, ajout auto à une conv ou création d'une nouvelle
    {

       if ($this->request->is('ajax')) {

        $page = $this->request->referer(true); // url d'origine

         $url_messagerie = str_replace('/instatux','',Router::url(['_name' => 'messagerie']));// url messagerie

         if($this->test_blocage($this->request->data['destinataire']) == 1) // si je suis bloqué
        {

        $reponse = 'blocage';
         $this->response->body(json_encode($reponse));
         return $this->response;
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

            if($page == $url_messagerie) // je vien de la page messagerie
    {

      $data['origin'] = 1;
    }
       $this->response->body(json_encode($data)); 
          
    }
    else {
                $reponse = 'probleme';
                $this->response->body(json_encode($reponse));

            }


    }
  return $this->response;      
}
}

        private function test_blocage($username) // on vérifie que le destinataire ne m'a pas bloqué
    {
        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $username])->where(['bloquer' => $this->Auth->user('username') ])->count();

             return $verif_blocage;
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
        // remplacement des @ -> lien vers profil
    $message = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="$2">@$2</a>',
        $message);

    $message =  preg_replace('/:([^\s]+):/', '<img src="/instatux/img/emoji/$1.png" alt=":$1:" class="emoji_comm"/>', $message); // emoji

    $message = preg_replace('/#([^\s]+)/', '<a href="../instatux/search/hashtag/$1">#$1</a>', $message);
       
       
        // remplacement des liens par des liens cliquables
  $message = preg_replace("/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/",
        '<a href="$0">$0</a>',$message);

    // remplacement des # -> lien vers moteur de recherche
    return $message;
}

}

