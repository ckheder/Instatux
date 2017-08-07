<?php
echo $this->Modal->create(['id' => 'ModalTweettoUser']) ;
                echo $this->Modal->header('Tweeter '.$this->request->getParam('username').'', ['close'=>false]) ;
                echo $this->Form->create('Tweet', array('class'=>'form-inline','url'=>array('controller'=>'Tweet', 'action'=>'add')));

                ?>
                <textarea id="editor1" name="contenu_tweet">@<?=$this->request->getParam('username') ?> </textarea>
                <script>
                CKEDITOR.replace( 'editor1' );
            </script>
                <br />
                <?= $this->Form->hidden('user_timeline', ['value' => $this->request->getParam('username')])  // correspond au user_timeline?>
<div class="text-center">
                <?= $this->Form->button('Tweeter '.$this->request->getParam('username').'', array('class'=>'btn btn-success')) ?>
             
</div>
                <br />

                <?= $this->Form->end(); 
                echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]);

                echo $this->Modal->end() ;


?>