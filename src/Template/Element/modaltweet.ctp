<?php
echo $this->Modal->create(['id' => 'ModalTweet']) ;
                echo $this->Modal->header('Nouveau Tweet', ['close'=>false]) ;
                echo $this->Form->create('Tweet', array('class'=>'form-inline','url'=>array('controller'=>'Tweet', 'action'=>'add')));
                ?>
                <textarea id="editor1" name="contenu_tweet"></textarea>
                <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
                <?php
                echo $this->Form->hidden('user_id', array('value'=>$authUser));
                ?>
                <br />
<div class="text-center">
                <?= $this->Form->button('Tweeter', array('class'=>'btn btn-success')) ?>
             
</div>
                <br />

                <?= $this->Form->end(); 
                echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]);
                echo $this->Modal->end() ;


?>