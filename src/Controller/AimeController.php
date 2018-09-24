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

public $components = array('RequestHandler');
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

                
        
        if ($this->request->is('ajax')) {



        // on vérifie si j'aime déjà

        $query = $this->Aime->find()->select(['id'])->where(['username' => $this->Auth->user('username')])->where(['tweet_aime' => $this->request->getParam('id')]);



        if($query->isEmpty()) // pas de résultat
        {


        $new_like = $this->Aime->newEntity();

                          $data = array(
            'username' => $this->Auth->user('username'),
            'tweet_aime' => $this->request->getParam('id')
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
        'id' => $this->request->getParam('id')
    ])
    ->execute();
       
 
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
        'id' => $this->request->getParam('id')
    ])
    ->execute();

    }

    // récupération du nombre de like

    $tweet = $this->Tweet->find()->select([
            'Tweet.nb_like',
            ])
        ->where(['Tweet.id' => $this->request->getParam('id')]);

        foreach($tweet as $tweet)

            $nb_like = $tweet->nb_like;




            $this->response->body($nb_like);
       return $this->response;



    
       
    }


            // return $this->redirect($this->referer());
}

   
}
