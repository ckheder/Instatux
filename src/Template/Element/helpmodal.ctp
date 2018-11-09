
<?php
echo $this->Modal->create(['id' => 'HelpModal', 'close'=>false]) ;
                echo $this->Modal->header('Aide Générale') ;
?>
<div class="text-center"><h4><span class="glyphicon glyphicon-pencil"></span>&nbsp;Rédaction d'un tweet</h4></div>
<ul>
<li>Les tweets sont limités à 250 caractères.</li>
<li>Un seul média peut être partagé par post, cependant il est possible de partager plusieurs liens vers des médias.</li>
<li>La taille des photos envoyées est limité à 3mo.</li>
 </ul> 
<div class="text-center"><h4><span class="glyphicon glyphicon-facetime-video"></span>&nbsp;Insérer un média</h4></div>
	<div class="alert alert-info">
    Un média représente une vidéo ou une photo provenant de divers sources (liste ci-dessous) qui peut être affiché directement dans un post au lieu d'être sur la forme de lien.
<ul>

<li>Seuls les photos publiques d'Instagram peuvent être partagées.</li>
<li>Les posts Facebook, Twitter ou encore Reddit ne sont pas supportés en raison de la politique de non traçage des utilisateurs par le navigateur Mozilla Firefox.</li>
<li>Tous média qui ne peut être prévisualisé sera posté sous forme de lien.</li>
 </ul>   
    </div>
    <div class="text-center"><h5>Médias supportés</h5></div>
<ul class="list_aide">
	<li><p><img src="/instatux/img/icons/yt.png">Youtube
	<br /><span>Exemple : https://www.youtube.com/watch?v=GNRZ65SfslM.</span><br /></p></li>
	<li><p><img src="/instatux/img/icons/daily.png">Dailymotion
	<br /><span>Exemple : https://www.dailymotion.com/video/x60gir3.</span><br /></p></li>
	<li><p><img src="/instatux/img/icons/twi.png">Twitch
	<br /><span>Exemple :  https://www.twitch.tv/videos/323486560.
	<br />Exemple :  https://clips.twitch.tv/DreamyNiceStorkPastaThat.</span><br /></p></li>
	<li><p><img src="/instatux/img/icons/insta.png">Instagram
	<br /><span>Exemple : https://www.instagram.com/p/BpB8mbBlGcK/.</span><br /></p></li>
</ul>

<!-- fin div content popover -->
<?php
                echo $this->Modal->end() ;
                ?>
