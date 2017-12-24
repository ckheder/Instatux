<?php
use Cake\I18n\Time;

if(isset($nb_tweet_accueuil))
{
          
         echo '<div class="alert alert-info">Aucun actualités à afficher.</div>';
        }
        else
        {

          ?>
                <div id="list_tweet">
                    <?php



             foreach ($abonnement as $abonnement): ?>
            
              <div class="tweet">
                                       <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                <li>
                 <?= $this->Html->link('Ne plus suivre '.$abonnement->user_timeline.'',array('controller'=>'abonnement','action'=>'delete',$abonnement->user->username)); ?>
                <!-- je ne m'abonne plus -->
            </li>
                
                    
                    <li>

                    <?= $this->Html->link('Signaler ce post ', ['action' => 'view']); ?>  
                 
             </li> <!--signaler un post-->


                       
  </ul>
</div>
              <?php
                          if($abonnement->share == 1) // si c'est un partage
            {
                echo '<br />';
                echo  $this->cell('Abonnement::avatar_user', ['user' => $abonnement->user_timeline, 'share' => $abonnement->share, $abonnement]) ; 
            } 
            else
            {
            echo  $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'',['class' => 'link_username_tweet']) ;?>
            <span class="alias_tweet">@<?=$abonnement->user->username ?></span> - 
             <?php
            }
  ?>
            <?= $abonnement->created->i18nformat('dd MMMM YYYY'); ?>
                       



                <?= $this->Text->autoParagraph($abonnement->contenu_tweet); ?>

                <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $abonnement->id ;?>"><?= $abonnement->nb_like ;?></span></span>

                <span class="nb_comm_share"><?= $abonnement->nb_commentaire ?> commentaire(s) - <?= $abonnement->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                        <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <?= $this->Html->link('J\'aime', '/like-'.$abonnement->id.'', array('data-value' => ''.$abonnement->id.'','class' => 'link_like')); ?>
               &nbsp;&nbsp;&nbsp;
               <?php
                
                if($abonnement->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                  ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 
              <?php
                    echo $this->Html->link('Commenter ', ['action' => 'view',  $abonnement->id]); 

               ?> - 
               
               <?php }
           
           
               if($abonnement->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
              ?>
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              <?php
                echo $this->Html->link('Partager', '/partage/add/'.$abonnement->id.'/'.$abonnement->user_id.'');
                
            }
    
?>
</span>
            </div>
            <?php endforeach; 
            echo '</div>';

?>


            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>

 <?php         

        } ?>



           

            <script>

              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin de l'actualité"}));
  ias.extension(new IASPagingExtension());

</script>



