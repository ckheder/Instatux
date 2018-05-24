<?php $search = str_replace('%23', '#', $search); ?>
<div class="text-center"><h3>Résultat pour <?= $search ?></h3></div>
<br />
<?php // résultat users
                         foreach ($resultat_users as $resultat_users): ?>
                         <div class="tweet">

                          <?= $this->Html->image(''.$resultat_users->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>
<?= $this->Html->link(h($resultat_users->username),'/'.h($resultat_users->username).'',['class' => 'link_username_tweet']) ;?>
<span class="alias_tweet">@<?=$resultat_users->username ?></span>
<?php
              if(isset($authName))
              {
               if($resultat_users->username != $authName) // si ce n'est pas moi, on vérifie si je suis le résultat de recherche
               {
                
                echo $this->cell('Abonnement::test_abo', ['authname' => $authName, 'suivi' =>$resultat_users->username]) ;  
               }
             }
             echo '<br />';
               echo $resultat_users->description;

              

?>
               
              </div>
<?php endforeach; //fin résultat users ?>


<div id="list_tweet">

<?php

                         foreach ($resultat_tweet as $resultat_tweet): ?>
            <div class="tweet">
                <?= $this->Html->image(''.$resultat_tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>
            	<?= $this->Html->link(h($resultat_tweet->user->username),'/'.h($resultat_tweet->user->username).'',['class' => 'link_username_tweet']) ; ?>

                <span class="alias_tweet">@<?=$resultat_tweet->user->username ?></span> - 

                <?= $resultat_tweet->created->i18nformat('dd MMMM YYYY'); 
                                     
            $resultat_tweet_contenu = str_replace('</p>', '', $resultat_tweet->contenu_tweet);
            ?>
                
                <?= $this->Text->autoParagraph($resultat_tweet_contenu) ?>
                                 <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $resultat_tweet->id ;?>"><?= $resultat_tweet->nb_like ;?></span></span>

                <span class="nb_comm_share"><?= $resultat_tweet->nb_commentaire ?> commentaire(s) - <?= $resultat_tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                                  <?php
                                 if(isset($authName))
              {
                ?>
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <?= $this->Html->link('J\'aime', '/like-'.$resultat_tweet->id.'', array('data-value' => ''.$resultat_tweet->id.'','class' => 'link_like')); 

                     ?>
               &nbsp;&nbsp;&nbsp;
               <?php

                     }  
                               
                if($resultat_tweet->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<br /><br /><div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                 ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 
                  
               <?= $this->Html->link('Commenter', '/post/'.$resultat_tweet->id.''); 

               ?>
               &nbsp;&nbsp;&nbsp;
               <?php

               
           }
            if(isset($authName))
              {
           
               if($resultat_tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
                 ?>
              <span class="sharelink" data-idtweet="<?= $resultat_tweet->id ;?>">
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              
                

                <a href="#" data-idtweet="<?= $resultat_tweet->id ;?>" data-auteurtweet="<?= $resultat_tweet->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>
              </span>
                <?php
                
            }
          }
            ?>
          </span>
                </div>
            <?php endforeach; ?>

            </div>

            <div id="pagination">

              <?= $this->Paginator->options([
    'url' => ['-'.$search.'']
        
    ]);

           echo $this->Paginator->next('Next page'); ?>

           

          </div>

<?= $this->Html->script('/js/iassearch.js') ?>
          

