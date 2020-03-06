<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Aime Controller
 *
 * Gestion complète des likes
 *
 * @property \App\Model\Table\AimeTable
 *
 *
 */
class AimeController extends AppController
{

        public $paginate =
    [
        'limit' => 8,
    ];

        public $components = array('RequestHandler');

        public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Tweet');
    }

    /**
     * Méthode Index
     *
     * Retourne la liste des personnes aimant un post -> fenêtre modal
     *
     * Paramètre : idtweet-> identifiant du tweet dont on veut la liste des likes
     */
        public function index($idtweet)
    {
            if ($this->request->is('ajax'))
        {
            $listlike = $this->Aime->find()
                ->select(['Users.username'])
                ->where(['tweet_aime' => $idtweet])
                ->contain(['Users'])
                ->order(['Aime.created' => 'DESC'])
                ->limit(10); // on limite la pagination à 10 résultats par page

                $nb_like = $listlike->count(); // on compte le nombre de résultat

                    if($nb_like == 0)
                {
                    $this->set('nolike', $nb_like);
                }
                    else
                {
                    $this->set('listlike',$this->Paginator->paginate($listlike, ['limit' => 8]));
                }
         }
            else
        {
            throw new NotFoundException(__('Cette page n\'existe pas.')); // si on tente d'accéder à la page en dehors d'une requête AJAX
        }
    }

    /**
     * Méthode Add
     *
     * Ajout/Suppression d'un like
     *
     * Paramètre : idtweet-> identifiant du tweet dont on veut la liste des likes
     */
        public function add()
    {

        if ($this->request->is('ajax')) {

        // nombre de like avant traitement

        $nb_like = $this->request->data('nb_like');

        // on vérifie si j'aime déjà

        $query = $this->Aime->find()
                                    ->select(['id'])
                                    ->where(['username' => $this->Auth->user('username')])
                                    ->where(['tweet_aime' => $this->request->data('id')]);

            if($query->isEmpty()) // Si on ne like pas déjà
        {

            $new_like = $this->Aime->newEntity(); // On crée une nouvelle entité

            $data = array(
                            'username' => $this->Auth->user('username'), // personne aimant
                            'tweet_aime' => $this->request->data('id') // tweet aimé
                        );

            $new_like = $this->Aime->patchEntity($new_like, $data);

            $this->Aime->save($new_like);

            // mise à jour du nombre de like : +1

            $query = $this->Tweet->query();

            $result = $query
                    ->update()
                    ->set(
                            $query->newExpr('nb_like = nb_like + 1')
                            )
                    ->where(['id' => $this->request->data('id') ])
                    ->execute();

            $nb_like = $nb_like + 1; // on incrémente le nombre de like sur le post

            $action = 'add'; // réponse AJAX d'ajout de like
        }

            else // on récupère l'id du like et on le delete
        {

            foreach($query as $id_like)

            $id_like = $id_like->id; // id du like

            $delete_like = $this->Aime->get($id_like);

            $this->Aime->delete($delete_like); // Suppression du like

        // mise à jour du nombre de like : -1

            $query = $this->Tweet->query();

            $result = $query
                    ->update()
                    ->set($query->newExpr('nb_like = nb_like - 1'))
                    ->where([ 'id' => $this->request->data('id')])
                    ->execute();

            $nb_like = $nb_like - 1; // on décrémente le nombre de like sur le post

            $action = 'delete'; // réponse AJAX  de suppression de like

        }

    // Renvoi des informations en JSON

    $data = array(

                    'nb_like' => $nb_like,
                    'authname' => $this->Auth->user('username'), // pour la cell affichant l'avatar
                    'action' => $action // add->ajout du portrait de la personne à la cell | delete -> suppression du portrait de la personne à la cell

                );

            $this->response->body(json_encode($data));
            return $this->response;
    }
    // accès à la page hors d'une requête Ajax
        else 
    {
      throw new NotFoundException(__('Cette page n\'existe pas.'));
    }

}

}
