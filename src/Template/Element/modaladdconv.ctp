<!--

 * modaladdconv.ctp
 *
 * Fenêtre invitation à rejoindre une conversation
 *
 */

-->

<?php
        echo $this->Modal->create(['id' => 'modaladdconv']) ; // creation modale

        echo $this->Modal->header('Inviter à rejoindre une conversation', ['close'=>false]) ; ?>

        <div class="alert alert-info">

            <strong>Info!</strong> Les personnes que vous invitez pourront voir les anciens messages de la conversation.

<br />

            N'invitez que des personnes avec qui vous souhaitez parler en groupe, il n'est pas encore possible d'exclure une personne de la conversation.

        </div>

        <!--formulaire invitation -->

        <?= $this->Form->create('', array('id'=>'adduserconv','url'=>array('controller'=>'Conversation', 'action'=>'adduser'))); ?>

<br />

<div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user"></span> 
                </div>

            <!-- input nom d'utilisateur -->

           <?= $this->Form->text('adduser', ['id' => 'adduser', 'placeholder'=>'Nom de la personne à ajouter']); ?> 
        
</div>
            <!-- input caché contenant le type de conversation : duo/multiple -->

        <?= $this->Form->hidden('typeconve', ['id'=>'typeconve','value' => $type_conv]); ?>

            <!-- input caché contenant l'identifiant de la conversation -->

        <?= $this->Form->hidden('conv', ['value' => $this->request->getParam('id')]) ;?>

            <br />

                    <div class="text-center">

                <?= $this->Form->button('Envoyer invitation', array('class'=>'btn btn-primary')) ?>

                    </div>

                <br />

                <?= $this->Form->end(); ?> <!-- fin formulaire -->

                <?= $this->Modal->footer([
                                            $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                                        ]); ?>

                 <?= $this->Modal->end() ; ?><!-- fermeture modale -->