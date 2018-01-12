<?php
use Cake\I18n\Time;
 ?>

                <div id="list_actu">


                    <?php

               

             foreach ($actu as $actu): ?>
         
            
              <div class="tweet">

<?php
            echo  $this->Html->image(''.$actu->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($actu->user->username,'/'.$actu->user->username.'',['class' => 'link_username_tweet']) ;?>
            <span class="alias_tweet">@<?=$actu->user->username ?></span>
            
            <?= $actu->created->i18nformat('dd MMMM YYYY'); ?>
                       



                <?= $this->Text->autoParagraph($actu->contenu_tweet); ?>

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
              <?php
                    echo $this->Html->link('Commenter ', ['action' => 'view',  $actu->id]); 

             }
           
             
?>
</span>
            </div>



  <?php

 endforeach; ?>

            </div>




            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>
            <script>

              var ias = jQuery.ias({
  container:  '#list_actu',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin de l'actualité"}));
  ias.extension(new IASPagingExtension());

</script>



