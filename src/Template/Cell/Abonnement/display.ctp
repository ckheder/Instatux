
            <?php 

            if($this->request->getParam('username') != $authname)
{
            if($abonnement === 0)
             {
                echo $this->Html->link(
                's\'abonner',
                array(
                
                'controller'=>'abonnement',
                'action'=>'add',
                $id_membre
                


                )
                ,
                ["class" => "btn btn-success"]
                );
                

                
            }
            elseif($abonnement === 1)
            {
                
                echo $this->Modal->create(['id' => 'Modal']) ;
                echo $this->Modal->header('Message', ['close'=>false]) ;
                echo $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'addprofil')));
                echo $this->Form->Textarea('message', ['rows' => '2', 'cols' => '68', 'placeholder' =>'Votre message...']) ;
                echo $this->Form->hidden('destinataire', ['value' => $id_membre]) ;
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
                <br />
                <span class="glyphicon glyphicon-envelope"></span>&nbsp;
                <?php echo $this->Html->link('Envoyer un message','#', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#Modal',
                  'class' => 'message_profil']);
                  ?>
                    <br />
          <br />
          <span class="glyphicon glyphicon-remove"></span>&nbsp;
          <?= $this->Html->link('Se désabonner', '/abonnement/delete/'.$id_membre.'',['class' => 'message_delete_abo']) ; ?>
          <br />
          
          <?php
            }
          } 
          ?>
        
          <br />
          <?php
           echo '<span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;Abonné '.$nb_abonnes;
                ?>
                <br />
                <br />
                <?php
             echo '<span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;Abonnement '.$nb_abonnement;
?>
<br />
<br />

