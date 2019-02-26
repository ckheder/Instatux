<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Aime Controller
 *
 * @property \App\Model\Table\AimeTable $Aime
 *
 * @method \App\Model\Entity\Aime[] paginate($object = null, array $settings = [])
 */
class AimeController extends AppController
{

            public $paginate = [
        'limit' => 8,

    ];

public $components = array('RequestHandler');

                public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
  
    /** index liste des aimants d'un post
 */
    public function index($idtweet)
    {
        if ($this->request->is('ajax')) {
                $listlike = $this->Aime->find()->select(['Users.username'])->where(['tweet_aime' => $idtweet])->contain(['Users'])->order(['Aime.created' => 'DESC'])->limit(10);

                $nb_like = $listlike->count();

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
throw new NotFoundException(__('Cette page n\'existe pas.'));
}
    }

    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
   
        if ($this->request->is('ajax')) {

            $nb_like = $this->request->data('nb_like'); // nombrez de like avant traitement


        // on vérifie si j'aime déjà

        $query = $this->Aime->find()->select(['id'])->where(['username' => $this->Auth->user('username')])->where(['tweet_aime' => $this->request->data('id')]);



        if($query->isEmpty()) // pas de résultat
        {


        $new_like = $this->Aime->newEntity();

                          $data = array(
            'username' => $this->Auth->user('username'),
            'tweet_aime' => $this->request->data('id')
            );

            $new_like = $this->Aime->patchEntity($new_like, $data);

            $this->Aime->save($new_like);

            // mise à jpour du nombre de like

            $this->loadModel('Tweet');

  $query = $this->Tweet->query();
$result = $query
    ->update()
    ->set(
        $query->newExpr('nb_like = nb_like + 1')
    )
    ->where([
        'id' => $this->request->data('id')
    ])
    ->execute();
       
    $nb_like = $nb_like + 1;

    $action = 'add';
    }
    else // on récupère l'id du like et on le delete
    {
        foreach($query as $id_like)

  
        $id_like = $id_like->id;
                

                $delete_like = $this->Aime->get($id_like);

        $this->Aime->delete($delete_like);

                    // mise à jpour du nombre de like

            $this->loadModel('Tweet');

  $query = $this->Tweet->query();
$result = $query
    ->update()
    ->set(
        $query->newExpr('nb_like = nb_like - 1')
    )
    ->where([
        'id' => $this->request->data('id')
    ])
    ->execute();
$nb_like = $nb_like - 1;

$action = 'delete';
    }

    $data = array(
       'nb_like' => $nb_like,
        'authname' => $this->Auth->user('username'),
        'action' => $action

    );

            $this->response->body(json_encode($data));
       return $this->response;

    
    }
        
}

   
}
