<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\MailerAwareTrait;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{


  use MailerAwareTrait;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $users =  $this->User->find();
        //$tweet->where(['user_id' => $this->Auth->user("id")]);
        $users->where(['user_id' => $this->request->query('id')]);
        
    }
 public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout', 'delete']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

          $data = array(
            'username' => $this->request->data['username'], 
            'password' => $this->request->data['password'],
            'email' =>  $this->request->data['email'],
            'avatarprofil' =>  "avatars/".$this->request->data['username'].".jpg"
            );

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                 $this->Auth->setUser($user);

                 // évènement de création de la ligne settings 

                $event = new Event('Model.User.afteradd', $this, ['user' => $user]);

                $this->eventManager()->dispatch($event);

                $this->getMailer('User')->send('welcome', [$user]);

                $this->Flash->success(__('Inscription réussie, bienvenue '.h($this->request->data('username')).' sur Instatux.'));
                return $this->redirect('/'.$this->Auth->user('username').'');
                
            } else {
              
                //$this->Flash->error(__('The user could not be saved. Please, try again.', $errors));
                //return $this->redirect('/');

              if($user->errors()){
                $error_msg = [];
                foreach( $user->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[]    =   $error;
                        }
                    }else{
                        $error_msg[]    =   $errors;
                    }
                }

                if(!empty($error_msg)){
                    $this->Flash->error(
                        __("<ul><li>".implode("</li><li>", $error_msg)."</li></ul>"), ['escape' => false])
                    ;
                    return $this->redirect('/');
                }
            }
            }
        }
        //$this->set(compact('user'));
        //$this->set('_serialize', ['user']);
    }

    /**
     * Edit method for description
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editdescription()
    {

      if ($this->request->is('ajax')) {

$usersTable = TableRegistry::get('Users');
$user = $usersTable->get($this->Auth->user('id'));
$user->description = $this->request->data('description');

$data = array('description' => $user->description);

$usersTable->save($user);


                        $this->response->body(json_encode($data));
    return $this->response;
        }
      }

        /**
     * Edit method for location
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editlieu()
    {

      if ($this->request->is('ajax')) {

$usersTable = TableRegistry::get('Users');
$user = $usersTable->get($this->Auth->user('id'));
$user->lieu = ucfirst($this->request->data('lieu'));

$data = array('lieu' => $user->lieu);

            $usersTable->save($user);

             $this->response->body(json_encode($data));
    return $this->response;
        }

        }

    public function editwebsite() // mise à jour du site web d'un utilisateur
    {

      if ($this->request->is('ajax')) {

$usersTable = TableRegistry::get('Users');
$user = $usersTable->get($this->Auth->user('id'));



$user->website = $this->request->data('website');

$usersTable->save($user);

$data = array('website' => $user->website);


        $this->response->body(json_encode($data));
    return $this->response;
        }
      }

          public function editpassword()
    {

      if ($this->request->is('ajax')) {

        if($this->request->data('password') == $this->request->data('confirmpassword'))
        {

$usersTable = TableRegistry::get('Users');
$user = $usersTable->get($this->Auth->user('id'));
$user->password = $this->request->data('password');

            if ($usersTable->save($user))
            {
$reponse = 'ok';
}
else
{
  $reponse = 'probleme';
}                     
  }
  else
  {
    $reponse = 'pasmeme';

  }
  
      $this->response->body($reponse);
 return $this->response;
        }

        }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);

// suppression avatar

                $avatar = WWW_ROOT.'img/avatars/'.$this->Auth->user('username'). '.jpg';
                unlink($avatar);
              

              // suppression de la ligne settings

              $this->loadModel('Settings');

              $query = $this->Settings->query();
            $query->delete()
    ->where(['user_id' => $this->Auth->user('username')])
    ->execute();

    // suppression des abonnements

              $this->loadModel('Abonnement');

              $query = $this->Abonnement->query();
            $query->delete()
    ->where(['user_id' => $this->Auth->user('username')])
    ->orWhere(['suivi' => $this->Auth->user('username')])
    ->execute();

    // suppression notification

                  $this->loadModel('Notifications');

              $query = $this->Notifications->query();
            $query->delete()
    ->where(['user_name' => $this->Auth->user('username')])
    ->execute();

    // suppression conversation

                  $this->loadModel('Conversation');

              $query = $this->Conversation->query();
            $query->delete()
    ->where(['participant1' => $this->Auth->user('username')])
    ->orWhere(['participant2' => $this->Auth->user('username')])
    ->execute();

    // suppression user
                

        if ($this->Users->delete($user)) {
          $this->getMailer('User')->send('deleteaccount', [$user]);
            $this->Flash->success(__('Compte supprimé.'));
            return $this->redirect('/');
        } else {
            $this->Flash->error(__('Impossible de supprimer votre compte.'));
            return $this->redirect('/settings');
        }

        
    }



    //connexion
        public function login()
    {
      $this->viewBuilder()->layout('general');
      $this->set('title' ,'Connexion requise');
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Bonjour '.$this->Auth->user('username').' !');



                return $this->redirect('/'.$this->Auth->user('username').'');
              

            }
            $this->Flash->error(__('Nom d\' utilisateur ou mot de passe incorrect'));
            return $this->redirect($this->Auth->logout());
            
        }
    }
    // déconnexion
    public function logout()
    {
      $this->Flash->success('Vous êtes déconnecté, à bientôt !');
        return $this->redirect($this->Auth->logout());
    }
    /** changer l'avatar
    ** mise à jour de l'avatar
    **/
    public function avatar()
        {

          if ($this->request->is('ajax')) {


  if(!empty($this->request->data['file']['name'])) 
            {

  $infosfichier = pathinfo($this->request->data['file']['name']);
  $extension_upload = $infosfichier['extension'];
  // taille du fichier
      if($this->request->data['file']['size'] <= 125000)
      { 
        $extensions_autorisees = array('jpg','jpeg');// vérification extension
        if(in_array($extension_upload,$extensions_autorisees))
            {

                //$avatarexploded = explode(".",$this->request->data['file']['name']);
                $fileName = $this->Auth->user('username') . '.jpg'; // renommer le fichier envoyé en suite de chiffre

                //$fileName = time() . '_' . rand(100, 999) . '.' . end($avatarexploded);


                $uploadPath = 'img/avatars/';

                $uploadFile = $uploadPath.$fileName; 
                
                // destruction de l'ancien
                       
   
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile))
                {
                    $uploadFile = str_replace('img/', '', $uploadFile);

                      //$dir = new Folder(WWW_ROOT . 'img/avatars');

                        // mise à jour avatar
                        $query = $this->Users->query();
                        $query->update()
                        ->set(['avatarprofil' => $uploadFile])
                        ->where(['id' => $this->Auth->user('id')])
                        ->execute();

                        $this->request->session()->write('Auth.avatarprofil', $uploadFile);
                        // fin maj database
                    $reponse = $uploadFile;
         
                }
              
                    else
                    {

                      $reponse = 'Impossible d\'envoyer ce fichier';

                        
                    }
           }
                    else
                    {
                      $reponse = 'extension de fichier incorrect';


                    }
      }
                    else
                    {
                      $reponse = 'fichier trop volumineux.';

                        
                        
                    }
                
              }
            else
            {
                $reponse = 'Choisissez un fichier à envoyer.';
                     
                        
            }
 $this->response->body($reponse);
return $this->response;
        }
            
        }

}
