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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('profil');
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
        $this->viewBuilder()->layout('profil');
         

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

        $message = $this->Messagerie->find('all')
        ->where(['conv' => $this->request->getParam('id')])
        ->order(['Messagerie.created' => 'DESC'])


        ->contain(['Users']);

$this->set('verif_user',1);
 $this->set(compact('message'));

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
    $tweet = preg_replace('/(^|[^@\w])@(\w{1,15})\b/',
        '$1<a href="$2">@$2</a>',
        $tweet);
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
         if($this->test_blocage($this->request->data['destinataire'])) // si je suis bloqué
        {

        $this->Flash->error(__('Message non envoyé, cet utilisateur vous à bloqué.'));

        return $this->redirect($this->referer());
        

        }
        else
        {


$message = $this->Messagerie->newEntity();

if(isset($this->request->data['conversation'])) // on vérifie si j'envoi une conversation
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
        
            $data = array(
            'user_id' => $this->Auth->user('username'), // expediteur
            'destinataire' => $this->request->data['destinataire'],
            'message' =>  $this->linkify_tweet($this->request->data['message']), // message
            'conv' => $conversation,
            //evenement abonnement
            'nom_session' => $this->Auth->user('username'),//nom de session
            'avatar_session' => $this->Auth->user('avatarprofil'),
             'new_conv' => $new_conv
            );

            $message = $this->Messagerie->patchEntity($message, $data);
            
            if ($this->Messagerie->save($message)) 
            {
                    //évènenement

                 $event = new Event('Model.Messagerie.afterAdd', $this, ['message' => $message]);
                $this->eventManager()->dispatch($event);

                // fin évènement
                $this->Flash->success(__('Message envoyé.'));
                
            }
            else
            {
                $this->Flash->success(__('Message non envoyé.'));
            }

           return $this->redirect($this->referer());
        
    }
    }

        private function test_blocage($username) // on vérifie que le destinataire ne m'a pas bloqué
    {
        $this->loadModel('Blocage');

        $verif_blocage = $this->Blocage->find()->where(['bloqueur' => $username])->where(['bloquer' => $this->Auth->user('username') ]);

        $result_blocage = $verif_blocage->count();

             return $result_blocage;
    }


}
