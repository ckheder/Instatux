<!--

 * display.ctp
 *
 * Affichage des 10 personnes aimant un tweet sur le view.ctp
 *
 */

-->    

<?php 
	foreach ($wholike as $wholike): ?> <!-- username + avatar -->
      
     	<a href="./<?php echo $wholike->Users['username']; ?>" data-username ="<?php echo $wholike->Users['username']; ?>" title="Voir le profil de <?php echo $wholike->Users['username']; ?>"><img src="/instatux/img/avatar/<?php echo $wholike->Users['username']; ?>.jpg" alt="image utilisateur" class="img-circle vcenter likepic"></a>

<?php 
	endforeach ;
?>

