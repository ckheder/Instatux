
           

           <li><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;Abonné <?=$nb_abonnes ?></li>

            <li><span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;Abonnement <?= $nb_abonnement ?></li>


            <div class="text-center">
            
<?= $this->Html->link(
    'Modifier mon profil',
    '/settings',
    [ 'class' => 'btn btn-default']
);

?>

</div>
