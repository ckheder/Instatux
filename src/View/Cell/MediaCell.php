<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Media cell
 */
class MediaCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('Media');

        $list_media = $this->Media->find()->select(['nom_media','tweet_media','user_id'])->where(['user_id' => $this->request->getParam('username')])->order(['created' => 'DESC'])->limit(8);

        $this->set('list_media',$list_media);
    }
}
