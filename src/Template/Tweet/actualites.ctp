<?php
use Cake\I18n\Time;
 ?>

                <div id="list_actu_offline">


                    <?php

               

             foreach ($actu as $actu): ?>
         
            
              <div class="tweet">

<?php
            echo  $this->Html->image('/img/avatar/'.$actu->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
            echo  $this->Html->link($actu->user->username,'/'.$actu->user->username.'',['class' => 'link_username_tweet']) ;?>
            <span class="alias_tweet">@<?=$actu->user->username ?></span>
            
            <?= $actu->created->i18nformat('dd MMMM YYYY - HH:mm');
                       

                $resultat_tweet_contenu = preg_replace('/%23/', '#', $actu->contenu_tweet); 

                
                echo $resultat_tweet_contenu ?>

                <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $actu->id ;?>"><?= $actu->nb_like ;?></span></span>

                <span class="nb_comm_share"><?= $actu->nb_commentaire ?> commentaire(s) - <?= $actu->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                    
                <?php
                
                if($actu->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                  ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 

     <a href="" data-idtweet="<?= $actu->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false" onclick="return false;">Lire</a>
                                    <?php



             }
           
             
?>
</span>
            </div>



  <?php

 endforeach; ?>

            </div>

            <div id="pagination">
            <?= $this->Paginator->next('Page suivante'); ?>

          </div>

<?= $this->Html->script('offlinenews.js') ?>



