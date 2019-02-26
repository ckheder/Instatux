<div class="alert alert-info">
<strong>Info!</strong> Vous pouvez configurer les notifications dans l'onglet "notifications" de vos paramètres.

    </div>
<div class="text-center"><h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Statut</h4></div>
<ul class="statut_notif">
<?php foreach ($settings_notif as $settings_notif): 

//citation
echo '<li><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;Cité dans un tweet :  '.$settings_notif->notif_cite.'</li>';
//partage
echo '<li><span class="glyphicon glyphicon-link"></span>&nbsp;&nbsp;Partage de mes tweets : '.$settings_notif->notif_partage.'</li>';
//abonnement
echo '<li><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Nouveau follower : '.$settings_notif->notif_abo.'</li>';
//commentaire
echo '<li><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Nouveau commentaire : '.$settings_notif->notif_comm.'</li>';
//message
echo '<li><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Nouveau message : '.$settings_notif->notif_message.'</li>';
endforeach;
?>
</ul>
