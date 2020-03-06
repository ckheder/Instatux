<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\MailerAwareTrait;


/**
 * Controller Users
 *
 * Gestion des utilisateurs
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{


  use MailerAwareTrait; // utiliser pour l'envoi de mail


      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout', 'delete']);
    }

/**
     * Méthode Add
     *
     * Ajout d'un utilisateur
     *
     * Sortie : inscription puis redirection vers le nouveau profil | tableau regroupant les erreurs en cas de problème
     *
*/
    public function add()
    {

          if ($this->request->is('post'))  // requête POST uniquement
        {

          $user = $this->Users->newEntity(); // nouvel utilisateur

          $data = array(
                          'username' => $this->request->data['username'],
                          'password' => $this->request->data['password'],
                          'email' =>  $this->request->data['email']
                        );

            $user = $this->Users->patchEntity($user, $data);

              if ($this->Users->save($user)) // inscription réussie
            {
                 $this->Auth->setUser($user); // on authentifie l'utilisateur directement

                 // Création de la ligne settings, du dossier utilisateur, avatar par défaut

                $event = new Event('Model.User.afteradd', $this, ['user' => $user]);

                $this->eventManager()->dispatch($event);

                //Envoi d'un mail de bienvenue ( désactivé pour le moment)

                //$this->getMailer('User')->send('welcome', [$user]);

                $this->Flash->success(__('Inscription réussie, bienvenue '.h($this->request->data('username')).' sur Instatux.'));

                // redirection vers le nouveau profil

                return $this->redirect('/'.$this->Auth->user('username').'');

            }

              else
            {

                if($user->errors())
              {
                $error_msg = [];

                  foreach( $user->errors() as $errors)
                {
                      if(is_array($errors))
                    {
                        foreach($errors as $error)
                      {
                            $error_msg[]    =   $error;
                      }
                    }

                      else
                    {
                        $error_msg[]    =   $errors;
                    }
                }

                if(!empty($error_msg))
                {
                    $this->Flash->error(
                        __("<ul><li>".implode("</li><li>", $error_msg)."</li></ul>"), ['escape' => false])
                    ;
                    return $this->redirect('/');
                }
            }
            }
        }

    }
/**
     * Méthode login
     *
     * Connexion d'un utilisateur
     *
     * Sortie : Redirection vers profil | Message d'erreur en cas de problème
     *
*/
        public function login()
    {
        $this->viewBuilder()->layout('error');

          if ($this->request->is('post'))
        {
          $redirectUrl = $this->request->data('urlorigin'); // récupération de l'URL de la page dont un utilisateur non authentifié à tenter l'accès

          $user = $this->Auth->identify(); //identification

            if ($user) // identification réussie
          {
              $this->Auth->setUser($user);

              if($redirectUrl) // si il vient d'une page autre que la page d'accueil, on redirig evers celle-ci
            {
                 return $this->redirect($redirectUrl);
            }

              else // sinon on redirige vers le profil
            {
                 return $this->redirect('/'.$this->Auth->user('username').'');
            }

          }
          else {
            // échec identification

            $this->Flash->error(__('Nom d\' utilisateur ou mot de passe incorrect'));

            // redirection vers l'accueuil
            return $this->redirect($this->Auth->logout());
          }

        }
    }
/**
     * Méthode logout
     *
     * Déconnexion d'un utilisateur
     *
     * Sortie : Redirection vers l'accueuil
     *
*/
    public function logout()
    {

        return $this->redirect($this->Auth->logout());
    }

/**
     * Méthode editinfos
     *
     * Mise à jour des informations utilisateurs
     *
     * $allowedit : indique si une mise à jour doit être faite -> 0 : non | 1 -> oui
     *
     * Sortie : $reponse : ok -> mise à jour effectué | probleme -> impossible de faire de mise à jour | utilise -> adresse mail    déjà utilisée | pasmeme -> les adresses mail ne correspondent pas
     *
*/
      public function editinfos()
    {

        if ($this->request->is('ajax'))
      {

        $reponse = 'probleme';

        $allowedit = 0; // modification non autorisée

        $user = $this->Users->get($this->Auth->user('id')); // récupération de l'utilisatuer courant

      // partie input simple

        // mise à jour description

            if(!empty($this->request->data('description'))) // si le champ n'est pas vide
          {
            $description = strip_tags($this->request->data('description'));
            $user->description = $this->parse_desc($description);
            $allowedit = 1;
          }

          // mise à jour lieu

            if(!empty($this->request->data('lieu')))
          {
            $user->lieu = strip_tags($this->request->data('lieu'));
            $allowedit = 1;
          }

          // mise à jour site web

            if(!empty($this->request->data('website')))
          {
            $user->website = strip_tags($this->request->data('website'));
            $allowedit = 1;
          }

        // partie mail

          if(!empty($this->request->data('mail'))) // si le champ mail n'est pas vide
        {
            if($this->request->data('mail') == $this->request->data('confirmmail')) // on vérifie que les deux adresse correspondent
          {

          // on vérifie que l'adresse mail n'est pas déjà utilisé

                $verif = $this->Users->find()
                                      ->select(['email'])
                                      ->where(['email' => $this->request->data('mail')]);

              if ($verif->isEmpty()) // si le mail n'existe pas
            {
              $user->email = $this->request->data('mail');
              $allowedit = 1;
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

      // mot de passe de compte

      if(!empty($this->request->data('password')))
    {
         if(strip_tags($this->request->data('password')) == strip_tags($this->request->data('confirmpassword'))) // mot de passe égaux
        {
          $user->password = $this->request->data('password');
          $allowedit = 1;

        }
                  else
        {
          $reponse = 'pasmemepass'; // les deux mot de passe ne correspondent pas
          $allowedit = 0;
        }
    }

      // avatar

        // avatar envoyé et sans erreur

                  if(!empty($this->request->data['avatar']) AND $this->request->data['avatar']['error'] == 0)
                {

                  $avatar = $this->request->data['avatar'];

                  $reponse = $this->avatar($avatar); // fonction qui va gérer le traitement de l'avatar envoyé
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
        // accès à la page hors d'une requête Ajax
        else {
          throw new NotFoundException(__('Cette page n\'existe pas.'));
        }
      }


/**
     * Méthode Delete
     *
     * Supprimer mon compte
     *
     * Sortie : redirection vers l'accueil en cas de succès | redirection vers les paramètres en cas de problème
     *
*/
      public function delete($id = null)
    {
        $user = $this->Users->get($id); // récupération de l'utilisateur courant

        $deleteuser = $this->Users->delete($user); // suppression de l'utilisateur courant


          if ($deleteuser) // suppression réussie
        {
          //$this->getMailer('User')->send('deleteaccount', [$user]); // envoi d'un mail de confirmation (désactivé)

          // Cet évènement va supprimer toutes les données utilisateurs

            $event = new Event('Model.User.afterdelete', $this, ['user' => $user]);

            $this->eventManager()->dispatch($event);

            $this->Flash->success(__('Compte supprimé.'));

            return $this->redirect('/'); // redirection vers l'accueil
        }

          else
        {
            $this->Flash->error(__('Impossible de supprimer votre compte.'));
            return $this->redirect('/settings');
        }
    }

/**
     * Méthode Avatar
     *
     * Gestion de l'avatar
     *
     * Paramètres : $file -> fichier image contenant l'avatar
     *
     * Sortie : $erreur : fichier trop gros , mauvais fichier | $reponse :  ok ou problème interne
     *
*/
    private function avatar($file)
  {

          $taillemax = 3047171; // taille max soit 3 mo

          $taille = filesize($file['tmp_name']); // récupération de la taille du fichier

            if($taille > $taillemax) // vérification taille
          {
            $erreur = 'Ce fichier est trop volumineux.';
          }

          // type MIME autorisé

            $imageMimeTypes = array(
                                    'image/jpg',
                                    'image/jpeg',
                                    'image/png'
                                  );

            $fileMimeType = mime_content_type($file['tmp_name']); // récupération du type MIME

            if (!in_array($fileMimeType, $imageMimeTypes)) // test de l'extension du fichier
          {
                     $erreur = 'Seules les images jpg/png sont autorisées';
          }

              if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                if($fileMimeType == 'image/png') // si le fichier est un png -> conversion en jpg
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
              else
            {
              return $erreur;
            }
  }
  /**
     * Méthode parse_desc
     *
     * Conversion des @username en lien vers le profil,  # lien cliquable vers le moteur de recherche, URL vers lien cliquable
     *
     * Paramètre : $desc -> description utilisateur
     *
     * Sortie : $desc -> description parsé
*/
      private function parse_desc($desc)
    {
        $desc = preg_replace('/(^|[^@\w])@(\w{1,15})\b/','$1<a href="./$2">@$2</a>',$desc); // @username

        // conversion des # vers lien pour moteur de recherche

        $desc =  preg_replace('/#([^\s]+)/','<a href="./search/hashtag/$1">#$1</a>',$desc); //#something

        // remplacement des liens par des liens cliquables

        $desc = preg_replace("/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/",
        '<a href="$0">$0</a>',$desc);

        return $desc;
    }
}
