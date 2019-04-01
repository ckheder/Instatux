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
            'email' =>  $this->request->data['email']
            );

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                 $this->Auth->setUser($user);

                 // évènement de création de la ligne settings

                $event = new Event('Model.User.afteradd', $this, ['user' => $user]);

                $this->eventManager()->dispatch($event);

                //Envoi d'un mail de bienvenue

                //$this->getMailer('User')->send('welcome', [$user]);

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
    public function editinfos()
    {

      if ($this->request->is('ajax')) {

        $reponse = 'probleme';

        $allowedit = 0; // modification non autorisée

$user = $this->Users->get($this->Auth->user('id'));

// partie input simple

if(!empty($this->request->data('description')))
{
$user->description = $this->request->data('description');
$allowedit = 1;
}
if(!empty($this->request->data('lieu')))
{
$user->lieu = $this->request->data('lieu');
$allowedit = 1;
}
if(!empty($this->request->data('website')))
{
$user->website = $this->request->data('website');
$allowedit = 1;
}

// partie mail

if(!empty($this->request->data('mail'))) // si le champ mail n'est pas vide
        {
          if($this->request->data('mail') == $this->request->data('confirmmail')) // on vérifie que les deux adresse correspondent
          {
          // on vérifie que l'adresse mail n'est pas déjà utilisé

                  $verif = $this->Users->find()->select(['email'])

        ->where(['email' => $this->request->data('mail')]);

        if ($verif->isEmpty())
        {

$user->email = $this->request->data('mail');
  }
  else
  {
    $reponse = 'utilise'; // adresse mail déjà utlisée
    $allowedit = 0;
  }
}

  else
  {
    $reponse = 'pasmeme'; // les deux adresses ne correspondent pas
    $allowedit = 0;

  }
}

  // mot de passe égaux

  if(!empty($this->request->data('password')))
  {

         if($this->request->data('password') == $this->request->data('confirmpassword'))
        {

          $user->password = $this->request->data('password');
          $allowedit = 1;

        }
      }

      // avatars
      if(!empty($this->request->data['avatar']) AND $this->request->data['avatar']['error'] == 0)
                {

                  $avatar = $this->request->data['avatar'];

                    $reponse = $this->avatar($avatar);
                }
      
      // modification autorisée
if($allowedit == 1)
{
   if ($this->Users->save($user))
            {
              $reponse = 'ok';
            }
}

      $this->response->body(json_encode($reponse));
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



          public function editpassword()
    {

      if ($this->request->is('ajax')) {

        if($this->request->data('password') == $this->request->data('confirmpassword'))
        {

$user = $this->Users->get($this->Auth->user('id'));
$user->password = $this->request->data('password');

            if ($this->Users->save($user))
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

                $deleteuser = $this->Users->delete($user);

    // suppression user

        if ($deleteuser) {
          //$this->getMailer('User')->send('deleteaccount', [$user]);
                          $event = new Event('Model.User.afterdelete', $this, ['user' => $user]);

                $this->eventManager()->dispatch($event);
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

                return $this->redirect('/'.$this->Auth->user('username').'');


            }
            $this->Flash->error(__('Nom d\' utilisateur ou mot de passe incorrect'));
            return $this->redirect($this->Auth->logout());

        }
    }
    // déconnexion
    public function logout()
    {

        return $this->redirect($this->Auth->logout());
    }
    /** changer l'avatar
    ** mise à jour de l'avatar
    **/
    private function avatar($file)
        {

$taillemax = 3047171; // taille max soit 3 mo

$taille = filesize($file['tmp_name']); // taille du fichier
  // taille du fichier
      if($taille > $taillemax) // vérification taille + envoi
      {
        $erreur = 'Ce fichier est trop volumineux.';
      }
      $imageMimeTypes = array( // type MIME autorisé
      'image/jpg',
      'image/jpeg',
      'image/png');

      $fileMimeType = mime_content_type($file['tmp_name']); // récupération du type MIME
      if (!in_array($fileMimeType, $imageMimeTypes)) // test de l'extension du fichier
            {
                     $erreur = 'Seules les images jpg/png sont autorisées';
            }

      if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                      {
                          if($fileMimeType == 'image/png')
                        {
                       
                        $tempfilename = $file['tmp_name']; 

                        $filename = imagecreatefrompng($tempfilename);

                        $chemin = 'img/avatar/'.$this->Auth->user('username') . '.jpg';
                        
                        if(imagejpeg($filename, $chemin , 70))
                        {
                          return $reponse = 'ok';
                          imagedestroy($file);
                        }
                         else
                 {
                  return $reponse = 'probleme';
                 }

                        }
                        else
                        {

                $fileName = $this->Auth->user('username') . '.jpg';

                $uploadPath = 'img/avatar/';

                $uploadFile = $uploadPath.$fileName;
              

                if(move_uploaded_file($file['tmp_name'],$uploadFile))
                {
                    return $reponse = 'ok';
                }

                    else
                    {

                      return $reponse = 'Impossible d\'envoyer ce fichier';

                    }
}
}
else {
  return $erreur;
}


        }


}
