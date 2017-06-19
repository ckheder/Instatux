<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

  

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
        $this->Auth->allow(['add', 'logout']);
    }

// fonction de redirection après connexion
    public function redirection()
    {
    
        return $this->redirect(array("controller" => "Tweet", 
                          "action" => "index",
                         $username)
);


    }
        public function profil($id = null)
    {
    
        return $this->redirect(array("controller" => "Tweet", 
                          "action" => "index",
                          $id)
);


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
            'description' => $this->request->data['description'],
            'avatarprofil' =>  "avatars/default.png"
            );

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                 $this->Auth->setUser($user);

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
                    return $this->redirect('/');;
                }
            }
            }
        }
        //$this->set(compact('user'));
        //$this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {

$usersTable = TableRegistry::get('Users');
$user = $usersTable->get($this->Auth->user('id'));
$user->description = $this->request->data('description');

            if ($usersTable->save($user)) {
                $this->Flash->success(__('Modification effectuée.'));

           return $this->redirect('/settings');
            } else {
                $this->Flash->error(__('Modification non effectuée.'));
                return $this->redirect('/settings');
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        // effacer avatar
        $query_avatar = $this->Users->find('all'); // on récupère l'avatar actuel
                $query_avatar->where([

                'id' =>  $this->Auth->user('id')

                ]);

                foreach ($query_avatar as $row) 
                {
                  if(!is_null($row->avatarprofil))
                {
                $avatar = WWW_ROOT.'img/'.$row->avatarprofil;
                unlink($avatar);
              }
                }
        // fin effacer avatar
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
            return $this->redirect('/');
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            return $this->redirect('/settings');
        }

        
    }



    //connexion
        public function login()
    {
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

  if(!empty($this->request->data['file']['name'])) 
            {

  $infosfichier = pathinfo($this->request->data['file']['name']);
  $extension_upload = $infosfichier['extension'];
  // taille du fichier
      if($this->request->data['file']['size'] <= 125000)
      { 
        $extensions_autorisees = array('jpg','jpeg','png');// vérification extension
        if(in_array($extension_upload,$extensions_autorisees))
            {

                //$fileName = $this->request->data['file']['name'];
                $avatarexploded = explode(".",$this->request->data['file']['name']);
                $fileName = time() . '_' . rand(100, 999) . '.' . end($avatarexploded);
                $uploadPath = 'img/avatars/';
                $uploadFile = $uploadPath.$fileName;
        
                $query_avatar = $this->Users->find('all'); // on récupère l'avatar actuel
                $query_avatar->where([

                'id' =>  $this->Auth->user('id')

                ]);

                foreach ($query_avatar as $row) 
                {

                // destruction de l'ancien
                $avatar = WWW_ROOT.'img/'.$row->avatarprofil;
                }
                
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile))
                {
                    $uploadFile = str_replace('img/', '', $uploadFile);
                    if(!is_null($avatar))
                    {
                        unlink($avatar);
                    }       
                        // mise à jour avatar
                        $query = $this->Users->query();
                        $query->update()
                        ->set(['avatarprofil' => $uploadFile])
                        ->where(['id' => $this->Auth->user('id')])
                        ->execute();

                        // fin maj database
                    
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                        return $this->redirect('/settings');
                }
                    else
                    {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                        return $this->redirect('/settings');
                    }
           }
                    else
                    {
                      $this->Flash->error(__('extensions incorrects.'));
                        return $this->redirect('/settings');
                    }
      }
                    else
                    {
                      $this->Flash->error(__('taille.'));
                        return $this->redirect('/settings');
                    }
                
              }
            else
            {
                $this->Flash->error(__('Please choose a file to upload.'));
                return $this->redirect('/settings');
            }
            
        }

public function indexmessagerie() // liste de mes abonnements pour la messagerie
    {


                if ($this->request->is('ajax')) {
           
            $this->autoRender = false;            
            $name = $this->request->query('term');            
                $abonnement = $this->Users->find()->contain(['Abonnement']);
                
        $abonnement->where([

'Abonnement.user_id' =>  $this->Auth->user('id')

            ])
        ->where(['username LIKE '  => '%'.$name.'%']);
        

    

$resultArr = [];

            foreach($abonnement as $result) 
            {
              $resultArr[] = array('label' =>$result['username'] , 'value' => $result['username'] );
            
               
            }
            echo json_encode($resultArr); 

}
}
        
        



}
