<?php
echo $this->Modal->create(['id' => 'ModalTweet']) ;
                echo $this->Modal->header('Nouveau Tweet', ['close'=>false]) ;
                echo $this->Form->create('Tweet', array('class'=>'form-inline','url'=>array('controller'=>'Tweet', 'action'=>'add')));

                ?>
                <textarea id="editor2" name="contenu_tweet"></textarea>
                <script>
                CKEDITOR.replace( 'editor2' );
            </script>
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

