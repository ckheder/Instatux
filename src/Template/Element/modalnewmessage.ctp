<?php
echo $this->Modal->create(['id' => 'ModalNewMessage']) ;
                echo $this->Modal->header('Nouveau Message', ['close'=>false]) ;
                ?>

                <?php
                echo $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add')));

                echo $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'destinataire']) ;

                //echo $this->Form->hidden('destinataire', ['id' => 'idmembre', 'placeholder' => 'id']) ;



?>
                <br />
                <br />

                <?=$this->Form->Textarea('message', ['id' =>'textarea_message','placeholder' =>'Votre message...']) ;?>
<!-- <textarea name="message" class="textarea_message" placeholder="Message..."></textarea> -->
<br /> 

                <br />
<div class="text-center">
                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
                <br />

                <?= $this->Form->end(); 
                echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]);
                echo $this->Modal->end() ;


?>