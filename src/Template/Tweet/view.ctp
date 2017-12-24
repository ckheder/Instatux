<?php
use Cake\I18n\Time;
use Cake\Network\Request;


 
                        if(isset($no_follow))
            {
                echo '<div class="alert alert-danger">
                        Impossible d\'afficher cette publication
                        <br />
                        Raisons possibles : 
                        <ul>
                        <li>Ce profil est privé, vous devez vous abonner pour en voir le contenu.</li>
                        <li>Cet utilisateur vous à bloqué.</li>
                        </ul>
                        
                        </div>';

            }
            else
            {


 foreach ($tweet as $tweet): ?>

<div class="tweet"> <!-- partie info sur le tweet -->
            <?= $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle left')) ?>
            <?= $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username ?></span> - 
            

             <span class="date_message"><?= $tweet->created->i18nformat('dd MMMM YYYY'); ?></span>

<p><?= $tweet->contenu_tweet; ?></p>



                 <span class="nb_like"><span id="compteur_like-<?= $tweet->id ;?>"><?= $tweet->nb_like ;?></span> like(s)</span>
                <span class="nb_comm_share"><?= $tweet->nb_commentaire ?> commentaire(s) - <?= $tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <?= $this->Html->link('J\'aime', '/like-'.$tweet->id.'', array('data-value' => ''.$tweet->id.'','class' => 'link_like')); 

                            ?>
               &nbsp;&nbsp;&nbsp;
               <?php

                                    if($tweet->share != 1 AND $tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
                 ?>
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              <?php
                echo $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.''); 
                
            }
            ?>

                     

    </span>     
</div> <!-- fin partie info sur le tweet -->

<?php if(!$tweet->allow_comment == 1) // si les commentaires sont autorisés
{

  
  echo $this->Form->create('Commentaires', array('url'=>array('controller'=>'commentaires', 'action'=>'add'))) ?>

  

<?= $this->Form->input('comm', ['placeholder' => 'Votre commentaire...', 'label'=> '','class' =>'emojis-plain textarea_comm']) ?>
<?= $this->Form->hidden('id', ['value' => $this->request->getParam('id')]) // id du tweet?>
<?= $this->Form->hidden('userosef', ['value' => $tweet->user->username]) // auteur du tweet?>
<br />
<div class="text-center">
<?= $this->Form->button('Envoyer', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end(); ?>
<hr>
<?php

//Bloquer les commentaires 

if($tweet->user_id == $authName AND $tweet->allow_comment == 0)
{
    echo $this->Form->create('', array('url'=>array('controller'=>'tweet', 'action'=>'allow_comment')));
    echo $this->Form->hidden('allow_comment', ['value' => $tweet->allow_comment]); 
    echo $this->Form->hidden('id_tweet', ['value' => $this->request->getParam('id')]); ?>

<div class="text-center">

<?= $this->Form->button('Désactiver les commentaires', array('class'=>'btn btn-danger')) ?>
<hr>
</div>
<?= $this->Form->end();
}

// Fin bloquer les commentaires 

if($tweet->nb_commentaire == 0)
{
    echo '<div class="alert alert-info">Aucun commentaire pour cette publication</div>';
}
else
{
    ?>
<div class="text-center"><h3><?= $tweet->nb_commentaire ;?>&nbsp commentaire(s)</h3></div>

<div id="list_comm">

        <?php foreach ($commentaires as $commentaires): ?>
            <div class="comm">
               
              
                <!-- bouton dropdown comm -->
                        <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php if($tweet->user_timeline == $authName or $commentaires->user_id == $authUser)
    {
        ?>
        <li>
        <?= $this->Html->link("Effacer ce commentaire", ['controller' => 'Commentaires','action' => 'delete', $commentaires->id, $tweet->id]);
         } 
         ?>
             
         </li>
    
        <?php if($commentaires->user_id != $authUser)
    {

        ?>
        <li><?= $this->Html->link('Bloquer '.$commentaires->user->username.'', ['controller' => 'Blocage','action' => 'add', $commentaires->user->username]); ?></li> <!-- bloquer les commentaires -->
            <li><a href="#">Signaler ce commentaire</a></li>
            <?php
         } 
         ?>
             
         
  </ul>
</div>
<!-- fin bouton dropdown comm -->
 <?= $this->Html->image(''.$commentaires->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail left avatarcomm')) ?>
 <?= $this->Html->link($commentaires->user->username,'/'.$commentaires->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$commentaires->user->username ?></span> - <span class="date_message"><?= $commentaires->created->i18nformat('dd MMMM YYYY'); ?></span>

<p><?= $this->Text->autoParagraph($commentaires->comm) ; ?></p>


      
</div>



        <?php endforeach; ?>

      </div>
      <?php
  
}
}
else
{
// commentaires non autorisés
 echo '<div class="alert alert-danger">Les commentaires sont désactivés pour cette publication</div>';
 if($tweet->user_id == $authName)
{
    echo $this->Form->create('', array('url'=>array('controller'=>'tweet', 'action'=>'allow_comment')));
    echo $this->Form->hidden('allow_comment', ['value' => $tweet->allow_comment]); 
    echo $this->Form->hidden('id_tweet', ['value' => $this->request->getParam('id')]); ?>

<div class="text-center">

<?= $this->Form->button('Activer les commentaires', array('class'=>'btn btn-success')) ?>
<hr>
</div>
<?= $this->Form->end();
}

}

   endforeach; 

    }
         ?>

         <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>


                <script>
    $('.emojis-plain').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');



    </script>
            <script>



              var ias = jQuery.ias({
  container:  '#list_comm',
  item:       '.comm',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin des commentaires"}));
  ias.extension(new IASPagingExtension());

</script>



           



