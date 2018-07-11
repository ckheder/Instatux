 <!-- personne que je suis -->
    <?php
        if(isset($nbabonnement_valide)) 
        {
            echo '<div class="alert alert-info">Aucun abonnement actif à afficher.</div>';
        }
        else
        {
             ?><div class="alert alert-info" id="nbabonnement"><span class="glyphicon glyphicon-user"></span>&nbsp;<script> var nbabonnement = <?= $count_abonnement ;?> 
           document.getElementById('nbabonnement').innerHTML = nbabonnement;
         </script> abonnement(s).</div><!-- // nombre d'abonnés -->

        <!-- abonnement validé -->
        <div id="listabovalide">
            <?php foreach ($abonnement_valide as $abonnement_valide): ?>
          <div class="liste_abo" data-username="<?= $abonnement_valide->Users['username'] ;?>">
                
            <?= $this->Html->image(''.$abonnement_valide->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonnement_valide->Users['username']).'')) ?>

            <?= $this->Html->link(''.h($abonnement_valide->Users['username']).'','/'.h($abonnement_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

            <span class="alias_tweet">@<?= $abonnement_valide->Users['username'] ;?></span>

            <a href="#" data-username="<?= $abonnement_valide->Users['username'] ;?>" data-action="delete" title="Ne plus suivre <?= $abonnement_valide->Users['username'] ;?>"  id="aboact" class="link_delete_abo" onclick="return false;">Supprimer</a>
           
 </div>
            <?php endforeach; ?>

</div>

<?php
}
?>
            <div id="pagination">

                            <?= $this->Paginator->options([
    'url' => array('controller' => '/abonnement/'.$this->request->getParam('username').'')
        
    ]);?>

            <?= $this->Paginator->next('Next page'); ?>

          </div>
<!-- fin abonnement validé -->

<script>
              var ias = jQuery.ias({
  container:  '#listabovalide',
  item:       '.liste_abo',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des abonnements"}));
  ias.extension(new IASTriggerExtension({offset: 2}));

</script>

    

