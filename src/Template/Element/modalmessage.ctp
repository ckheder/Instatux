<?php
                echo $this->Modal->create(['id' => 'modalmessage']) ;
                echo $this->Modal->header('Envoyer un message à '.$this->request->getParam('username').'', ['close'=>false]) ;
                echo $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'addprofil')));
                echo $this->Form->Textarea('message', ['rows' => '2', 'cols' => '60', 'placeholder' =>'Votre message...']) ;
                echo $this->Form->hidden('destinataire', ['value' => $this->request->getParam('username')]) ;
                echo $this->Form->hidden('user_message', ['value' => $this->request->getParam('username')])  // nom du destinataire ;?>
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
