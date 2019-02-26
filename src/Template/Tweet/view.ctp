<?php
use Cake\I18n\Time;
use Cake\Network\Request;

?>
<p id="notifmodalview"></p>
<?php
 
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

<div class="tweetmodal"> 
     <?php
// dropdown bloquer les commenaires

                if($tweet->user_id == $authName) // si je suis l'auteur du tweet 
                {
                  ?>
                        <div class="dropdown">
                
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php


    if($tweet->allow_comment == 0) // commautorisés
                
            {
?>
                
                <li id="actioncomment">
                  <a href="#" data-etat="1" data-idtweet = "<?= $this->request->getParam('id') ;?>"   title="Désactiver les commentaires"  class="allowcomm" onclick="return false;">Désactiver les commentaires</a>
            </li>              

<?php
                }
                elseif($tweet->allow_comment == 1) 
                {
                  // commentaires non autorisés

                  ?>

<li id="actioncomment">
  <a href="#" data-etat="0" data-idtweet = "<?= $this->request->getParam('id') ;?>"   title="Activer les commentaires"  class="allowcomm" onclick="return false;">Activer les commentaires</a>
</li> <!-- activer les commentaires -->

<?php

                }
                ?>

              </ul>
            </div>
            <?php
          }
          ?><!-- partie info sur le tweet -->
            <?= $this->Html->image('/img/avatar/'.$tweet->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle left avatar_view')) ?>
            <?= $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username ?></span>             
<?php
 

$tweet->contenu_tweet = str_replace('/post', '', $tweet->contenu_tweet) ;

             $contenu_tweet = str_replace('%23', '#', $tweet->contenu_tweet);

              echo '<span class="contenutweet">'.$contenu_tweet.'</span>';


?>
<hr>
<span class="date_tweet_modal"><?= $tweet->created->i18nformat('dd MMMM YYYY - HH:mm'); ?></span>
<hr>
                 <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> 
                 <a href="" data-idtweet="<?= $tweet->id ;?>" data-toggle="modal" data-target="#viewlike" data-remote="false" onclick="return false;"><span id="compteur_like_view-<?= $tweet->id ;?>"><?= $tweet->nb_like ;?></span></a>
                <span id="list_like"><?= $this->cell('Like', ['idtweet' => $tweet->id]) ; ?></span>
               </span>
               <br />
                <span class="nb_comm_share"><span class="viewnbcomm_<?= $tweet->id_tweet ;?>"><?= $tweet->nb_commentaire ;?></span> commentaire(s) - <?= $tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                                                    <?php
                                 if(isset($authName))
              {
                ?>
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                    <a href="#" data-value="<?= $tweet->id ;?>" class="link_like" onclick="return false;">J'aime</a>
               &nbsp;&nbsp;&nbsp;
               <?php


                                    if($tweet->share != 1 AND $tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
                 ?>
                 <span class="sharelink" data-idtweet="<?= $tweet->id ;?>">
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              
                 <a href="#" data-idtweet="<?= $tweet->id ;?>" data-auteurtweet="<?= $tweet->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>
               </span>
               <?php 
            }
          }
            ?>

                     

    </span>
 <!-- fin partie info sur le tweet -->
    <span class="background_comm">    
<?php
if($tweet->allow_comment == 1)
{
 echo '<div class="alert alert-danger">Les commentaires sont désactivés pour cette publication.</div>';
}


 else // si les commentaires sont autorisés
{

if(!isset($authName))
{
   echo '<div class="alert alert-warning">Vous devez vous connecter ou vous inscrire pour commenter.</div>';
}
else
{
  
  echo $this->Form->create('Commentaires', array('url'=>array('controller'=>'commentaires', 'action'=>'add'),'id'=>'form_comm')) ?> <!-- formulaire de comm -->

  

<?= $this->Form->input('comm', ['placeholder' => 'Votre commentaire...', 'label'=> '','class' =>'emojis-plain textarea_comm','id' => 'comm']) ?>
<?= $this->Form->hidden('id', ['value' => $this->request->getParam('id')]) // id du tweet?>
<?= $this->Form->hidden('auttweet', ['value' => $tweet->user->username]) // auteur du tweet?>
<?= $this->Form->end(); ?>

 <!-- fin div info tweet -->


<?php

}
?>
</span>
 <p id="allowcomment"></p>

<div id="list_comm">

        <?php foreach ($commentaires as $commentaires): ?>
            <div class="comm" data-idcomm="<?= $commentaires->id ;?>">
               
               <?php

               if(isset($authName)) // si ej suis identifié
{
  ?>
              
                <!-- bouton dropdown comm -->
                        <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php if($tweet->user_timeline == $authName or $commentaires->user_id == $authUser) // si je suis l'auteur du tweet ou du commentaire, je peut supprimer
    {
        ?>
        <li>
        <a href="#" data-idcomm="<?= $commentaires->id ;?>" data-idtweet="<?= $this->request->getParam('id') ;?>" title="Effacer ce commentaire"  class="deletecomm" onclick="return false;">Effacer ce commentaire</a>
        </li>

        <?php
         }
         if($commentaires->user_id == $authUser) // seul l'auteur d'un commentaire peut en modifier le contenu
              {
        ?>
                    <li>
          <a href="#" title="Modifier ce commentaire" class="updatecomm" data-idcom="<?= $commentaires->id ;?>"  onclick="return false;">Modifier</a>
        </li> 
        <?php  
        }         
         if($commentaires->user_id != $authUser) // je ne peut pas me bloquer ni signaler mes commentaires
    {

        ?>
        <li><a href="#" data-username="<?= $commentaires->user->username ;?>" data-action="add" title="Bloquer <?= $commentaires->user->username ;?>"  id="addblock"  onclick="return false;">Bloquer cet utlisateur</a></li> <!-- bloquer les commentaires -->
            <li><a href="#">Signaler ce commentaire</a></li>
            <?php
         } 
         ?>        
  </ul>
</div>
<?php
}
?>
<!-- fin bouton dropdown comm -->
 <?= $this->Html->image('/img/avatar/'.$commentaires->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail left avatarcomm')) ?>
 <?= $this->Html->link($commentaires->user->username,'/'.$commentaires->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$commentaires->user->username ?></span> - <span class="date_message"><?= $commentaires->created->i18nformat('d MMMM YYYY  HH:mm');
 ?>
 <span class="updatecomm<?= $commentaires->id ;?>">
  <?php
   if($commentaires->edit == 1) // affichage de la mention modifié si le comm à été modifié
{
  echo ' - Modifié';
}
?>
 </span>
</span>
<p></p>
<p class="contenucomm<?= $commentaires->id ;?>"><?= $commentaires->comm ; ?></p> 
</div>



        <?php endforeach; ?>

     


<?php


echo ' </div>';
}


?></div>
<?php
endforeach;

}
?>


         <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>

          </div>
<?php

if(isset($authName)) // je suis co 
{
  ?>
            <script>
var idtweet = "<?= $this->request->getParam('id') ;?>"; // id du tweet
var authname = "<?= $authName ;?>";

          </script>
<?php
echo  $this->Html->script('/js/clientcommentaires.js');

}
else // pas connecter
{
  echo $this->Html->script('/js/iasviewtweetoffline.js');
}

