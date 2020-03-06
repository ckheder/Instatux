<!--

 * modalmessage.ctp
 *
 * Fenêtre modale de nouveau message
 *
 */

-->

<?php
        echo $this->Modal->create(['id' => 'modalmessage']) ; // creation modale

        echo $this->Modal->header('Envoyer un message à '.$destinataire.'', ['close'=>false]) ; // titre

        //formulaire nouveau message

        echo $this->Form->create('Messagerie', array('id'=>'new_message','class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add')));

        echo '<br />';

        echo $this->Form->Textarea('message', ['id' =>'textarea_message','placeholder' =>'Votre message...', 'required'=> 'required']) ; // message

        echo $this->Form->hidden('destinataire', ['id' => 'destinataire', 'value' => $destinataire]) ; //message?>


            <br />
            
            <br />

                    <div class="text-center">

                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>

                    </div>

                <br />

                <?= $this->Form->end(); // fin formulaire

                echo $this->Modal->footer([
                                            $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                                        ]); ?>

                 <p id="etatmessage"></p> <!-- indique si le message à été envoyé -->

                 <?php

                echo $this->Modal->end() ; // fermeture modale

                ?>


