<!--

 * listconv.ctp
 *
 * Liste de mes conversations, affichée à gauche sur la page des messages
 *
 */ -->

<?php

use Cake\I18n\Time;
use App\Controller\AppController;

?>
      
    <div id = "conv">


      <!-- titre -->

<div class="text-center">

          <br />

<h4>

  <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Discussions</h4>

</div>

<!-- liste des conversations -->

                        <?php foreach ($conv as $conv): ?>
           
      <div class="listconv" data-conv ="<?= $conv['conv'] ;?>">

        <span class="date_message">

<?php

// utilisation de la class Time pour calculer la différence en tre maintenant et le moment ou le dernier message à été posté

  $date_conv = new Time($conv['created']); 

  echo  $date_conv->timeAgoInWords([
                                      'accuracy' => ['day' => 'day'],
                                      'end' => '1 year'
                                    ]); ?>

  
      </span>

<!-- avatar destinataire(s) -->

  <?= $this->cell('Messagerie::usersconv', ['conv' => $conv['conv'], 'authname' => $authname]) ; ?>

<div class="bodylistconv">

  <?php

// affichage du message tronqué, grâce au helper Text

       $lastmessage = $this->Text->truncate($conv['message'], 110,
                                                                  [
                                                                    'ellipsis' => '...',
                                                                    'exact' => false,
                                                                    'html' => true
                                                                  ]
                                            );

 
  $lastmessage = str_replace('<br />', '', $lastmessage);

//affichage du nom de celui à posté le dernier message puis le message

  echo $conv['user_id'].' : '.$lastmessage.'';

  ?>

</div>

            </div>

            <?php endforeach; ?>
                  
  <br />
      
</div>
