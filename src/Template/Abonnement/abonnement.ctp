<?php
if($this->request->getParam('username') == $authName) // si je suis sur mon compte
{
  ?>
<div class="alert alert-success">
<strong>Info!</strong> Vous trouverez ici la liste de toutes les personnes que vous suivez.
<br />
<br />
Vous pouvez annuler ces abonnements depuis cette page ou depuis le profil de la personne.

    </div>
    <?php
  }
 
        if(isset($nbabonnement_valide) AND $this->request->getParam('username') == $authName) // si je suis sur mon compte et que je ne suis personne 
        {
            echo '<div class="alert alert-info">Aucun abonnement actif à afficher.</div>';
        }
        else if(isset($nbabonnement_valide) AND $this->request->getParam('username') != $authName) // si je ne suis pas sur mon compte et que la personne ne suit personne
          {
            echo '<div class="alert alert-info">'.$this->request->getParam('username').' ne suit personne pour le moment.</div>';
        }
        else
        {
             ?><div class="alert alert-info" id="nbabonnement"><span class="glyphicon glyphicon-user"></span>&nbsp;<script> var nbabonnement = <?= $count_abonnement ;?> 
           document.getElementById('nbabonnement').innerHTML = nbabonnement;
         </script> abonnement(s).</div><!-- // nombre d'abonnés -->

        <div id="listabovalide">
            <?php foreach ($abonnement_valide as $abonnement_valide): ?>
          <div class="liste_abo" data-username="<?= $abonnement_valide->Users['username'] ;?>">
                
            <?= $this->Html->image(''.$abonnement_valide->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonnement_valide->Users['username']).'')) ?>

            <?= $this->Html->link(''.h($abonnement_valide->Users['username']).'','/'.h($abonnement_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

            <span class="alias_tweet">@<?= $abonnement_valide->Users['username'] ;?></span>

            <?php

            if($this->request->getParam('username') == $authName) // si je suis sur mon compte
{
?>
            <a href="#" data-username="<?= $abonnement_valide->Users['username'] ;?>" data-action="delete" title="Ne plus suivre <?= $abonnement_valide->Users['username'] ;?>"  id="aboact" class="link_delete_abo" onclick="return false;">Supprimer</a>
     <?php
     }
     ?>      
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



    

