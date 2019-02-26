<?php
if($this->request->getParam('username') == $authName) // si je suis sur mon compte
{
  ?>
<div class="alert alert-success">
<strong>Info!</strong> Vous trouverez ici la liste de toutes les personnes qui vous suivent.
<br />
<br />
N'hésitez pas à bloquer depuis cette page ceux dont vous ne voulez pas qu'ils voient vos publications ou vous contactent.

    </div>
     <?php
  }
        
        if(isset($nbabonne_valide) AND $this->request->getParam('username') == $authName) 
        {
            echo '<div class="alert alert-info">Aucun abonné pour le moment.</div>';
        }
         else if(isset($nbabonne_valide) AND $this->request->getParam('username') != $authName) // si je ne suis pas sur mon compte et que la personne ne suit personne
          {
            echo '<div class="alert alert-info">Personne ne suit '.$this->request->getParam('username').' pour le moment.</div>';
        }
        else
        {
             echo '<div class="alert alert-info"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;'.$count_abonnes.' abonné(s).</div>'; // nombre d'abonnés
        ?>
        <!-- abonnement validé -->

        <div id="listabonne">
        
            <?php foreach ($abonne_valide as $abonne_valide): ?>
          <div class="liste_abo">

            <?= $this->Html->image('/img/avatar/'.$abonne_valide->Users['username'].'.jpg', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonne_valide->Users['username']).'')) ?>
            
            <?= $this->Html->link(''.h($abonne_valide->Users['username']).'','/'.h($abonne_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

            <span class="alias_tweet">@<?= $abonne_valide->Users['username'] ;?></span>
             <?php
                        if($this->request->getParam('username') == $authName) // si je suis sur mon compte
{

?>
<span id="etatblocageabonnes">

  <?= $this->cell('Abonnement::testblocage', ['authname' => $authName, 'suivi' => $abonne_valide->Users['username']]) ; ?>

</span>
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
    'url' => array('controller' => '/abonne/'.$this->request->getParam('username').'')
        
    ]);?>

            <?= $this->Paginator->next('Next page'); ?>

            <!--http://localhost/instatux/abonnement/abonnement/test?page=2 avec
              http://localhost/instatux/abonnement/test?page=2
 -->

          </div>

            <script>
              var ias = jQuery.ias({
  container:  '#listabonne',
  item:       '.liste_abo',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des abonnés"}));
  ias.extension(new IASTriggerExtension({offset: 2}));
            </script>


<!-- fin abonnement validé -->