<?php
                echo $this->Modal->create(['id' => 'modalmessage']) ;
                echo $this->Modal->header('Envoyer un message à '.$destinataire.'', ['close'=>false]) ;
                echo $this->Form->create('Messagerie', array('id'=>'new_message','class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add')));
                echo $this->Form->Textarea('message', ['id' =>'textarea_message','placeholder' =>'Votre message...']) ;
                echo $this->Form->hidden('destinataire', ['value' => $destinataire]) ;
                echo $this->Form->hidden('user_message', ['value' => $destinataire])  // nom du destinataire ;?>
                <br />
                <br />
<div class="text-center">
                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
                <br />

                <?= $this->Form->end(); 
                 echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]); ?>
                 <p id="etatmessage"></p>
                 <?php
                echo $this->Modal->end() ;
                ?>


