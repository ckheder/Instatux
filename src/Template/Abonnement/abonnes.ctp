<!-- personne qui me suive -->
        <?php
        if(isset($nbabonne_valide)) 
        {
            echo '<div class="alert alert-info">Aucun abonné pour le moment.</div>';
        }
        else
        {
             echo '<div class="alert alert-info"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;'.$count_abonnes.' abonné(s).</div>'; // nombre d'abonnés
        ?>
        <!-- abonnement validé -->

        <div id="listabonne">
        
            <?php foreach ($abonne_valide as $abonne_valide): ?>
          <div class="liste_abo">

            <?= $this->Html->image(''.$abonne_valide->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonne_valide->Users['username']).'')) ?>
            
            <?= $this->Html->link(''.h($abonne_valide->Users['username']).'','/'.h($abonne_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

            <span class="alias_tweet">@<?= $abonne_valide->Users['username'] ;?></span>

             <a href="#" data-username="<?= $abonne_valide->Users['username'] ;?>" data-action="add" title="Bloquer <?= $abonne_valide->Users['username'] ;?>"  id="addblock" class="link_delete_abo" onclick="return false;">Bloquer</a>

           
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