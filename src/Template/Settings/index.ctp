
<div id="tabs">
  <ul>
    <li><a href="#setup_information">Mes informations</a></li>
    <li><a href="#setup_profil">Paramètres</a></li>
    <li><a href="#users_blocks">Utilisateurs bloqués</a></li>
  </ul>
  <div id="setup_information">

<?= $this->Form->create('', array('id'=>'form_desc'));?>

<?= $this->Form->Textarea('description', ['id' => 'description','label'=>'','placeholder' => 'Parler de moi...']) ?>

<br />
<div class="text-center">
<?= $this->Form->button('Enregistrer', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>
<!-- fin modifier ma descritpion -->
<!-- modifier mon lieu -->
<?= $this->Form->create('', array('id'=>'form_lieu'));?>
<p class="text-muted">
    <br />
Partager ma localisation
</p>
<?= $this->Form->input('lieu', ['id' =>'lieu','prepend' => ' <span class="glyphicon glyphicon-map-marker"></span> ','label'=>'','placeholder' => 'Ex: Paris, New York, Montréal,...'],array('class'=>'form-controle')) ?>
<br />
<div class="text-center">
<?= $this->Form->button('Enregistrer', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>
<!-- fin modifier mon lieu -->
<!-- modifier mon site web -->


<?= $this->Form->create('', array('id' =>'form_website'));?>
<p class="text-muted">
  <br />
Partager mon site web ou un site que j'apprécie.
</p>
<?= $this->Form->input('website', ['id' => 'website', 'type' => 'url','prepend' => ' <span class="glyphicon glyphicon-globe"></span> ','label'=>'','placeholder' => 'http://www.monsite.com'],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Enregistrer', array('class'=>'btn btn-info')) ?>
<br />
<br />
</div>
<?= $this->Form->end() ?>
<!-- fin modifier mon site web -->
<!-- modifier mon avatar -->
<div class="text-center">
<h4><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Changer ma photo</h4>
</div>
<br />
<?= $this->Form->create('',array('id' => 'form_avatar','type' => 'file')) ?>
<p class="text-muted">Nouvel avatar (jpg/jpeg) 1mo maximum </p>
<?= $this->Form->input('', array('id' => 'inputfile','name' => 'file','type' => 'file')); ?>
<br />
<div class="text-center">
<?= $this->Form->button('Enregistrer', array('class'=>'btn btn-info')) ?>
<?= $this->Form->end();?>
<br />
<br />
</div>
<div class="text-center">
<h4><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Supprimer mon compte</h4>
</div>
<p class="text-warning">
<span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;La suppresion de votre compte entraînera l'effacement complet de tous vos posts mais pas ceux qui auront été partagés par les personnes qui vous suivent.
</p>
<div class="text-center">
<?=$this->Html->link(
    'Supprimer mon compte',
    ['controller' => 'users', 'action' => 'delete', $authUser],
    [ 'class' => 'btn btn-danger navbar-btn']
);

?>

</div>
  </div>
  <div id="setup_profil">
    <div class="text-center">
<h4> <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Mon profil</h4>
</div>
<?php 
if($setup_profil == 0) // profil public
{
?>
<span id="etatprofil">
<p class="text-success">
  <br />
Tous le monde peut voir vos publications.
<br />
<br />
  Les demandes d 'abonnement seront acceptés automatiquement.
</p>
<div class="text-center">
<a href="#"  data-action="prive" title="Rendre mon profil privé"  id="setupprofil" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Rendre mon profil privé</a>
</div>
</span>
<?php
}
else // profil privé
{
 ?>
 <span id="etatprofil">
<p class="text-danger">
  <br />
Seules vos abonnés voient vos publications.<br />
<br />
Vous pouvez choisir d'accepter ou non une demande d'abonnement.
</p>
<div class="text-center">
<a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn btn-success" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a>
</div>
</span>
<?php
 }

 ?>
<!-- fin mise à jour type profil -->
<!-- notifications -->
<hr>
<div class="text-center">
<h4> <span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications</h4>
</div>
<!-- notification de message -->

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de messages vous informent en cas de nouveaux messages que ce soit dans une conversation en cours ou si quelqu'un avec qui vous ne parlez pas vous à envoyé un message.
"><span class="glyphicon glyphicon-question-sign"></span></a>

<label for"notifmessage">Notification de message</label>
<select name="notif_message" id="notifmess">
  <option value="oui" <?php if($notif_message == 'oui') echo 'selected' ; ?> >oui</option>
  <option value="non"<?php if($notif_message == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_message" class="spannotif"></span>

<!-- fin notification de message -->
<br />
<!-- notification de citation -->

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de citation vous informent si votre @ à étaient utilisés dans un tweet soit de vos abonnés soit de quelqu'un d'autre, vous pouvez ainsi détecté les insultes ou autre et le signaler.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for"notifcite">Notification de citation</label>
<select name="notif_cite" id="notifcite">
  <option value="oui" <?php if($notif_cite == 'oui') echo 'selected' ; ?> >oui</option>
  <option value="non"<?php if($notif_cite == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_cite" class="spannotif"></span>
<!-- fin notification de citation -->
<br />
<!-- notification de partage -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de partage vous informent si l'une de vos publications à étaient partagée, attention cependant les commentaires sont indépendant d'une publication à l'autre, assurez vous que vos publications soient vues par les bonnes personnes.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for"notifcite">Notification de partage</label>
<select name="notif_partage" id="notifpartage">
  <option value="oui" <?php if($notif_partage == 'oui') echo 'selected' ; ?> >oui</option>
  <option value="non"<?php if($notif_partage == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_partage" class="spannotif"></span>

<!-- notification de partage -->
<br />
<!-- notification d'abonnement -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications d'abonnement vous informent d'un nouvel abonnement à votre profil, attention cependant vous ne pouvez paramétrer ces notifications que dans le cas d'un profil public.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for"notifabo">Notification d'abonnement</label>
<select name="notif_abo" id="notifabo">
  <option value="oui" <?php if($notif_abo == 'oui') echo 'selected' ; ?> >oui</option>
  <option value="non"<?php if($notif_abo == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_abo" class="spannotif"></span>
<!-- fin notification d'abonnement -->
<br />
<!-- notification commentaire -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de commentaires vous informent si vos abonnés , dans le cas d'un profil privé ou si quelqu'un à commenté l'une de vos publications.Vous pourrez ainsi les consulter, les modérer, signaler tous commentaires injurieux ou bloquer les commentaires d'une publication.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for"notifcomm">Notification de commentaires</label>
<select name="notif_comm" id="notifcomm">
  <option value="oui" <?php if($notif_comm == 'oui') echo 'selected' ; ?> >oui</option>
  <option value="non"<?php if($notif_comm == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_comm" class="spannotif"></span>

    <!-- fin notification de commentaire -->
<hr>
<!-- fin notifications -->
<!-- changer mot de passe -->
<div class="text-center">
<h4> <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Changer de mot de passe</h4>
</div>
<?= $this->Form->create('', array('id' =>'form_password'));?>
<p class="text-muted">
  <br />
Votre nouveau de passe devrait contenir des chiffres, des lettres et des symboles alphanumérique(#,@,$,...) pour plus de sécurité.
</p>
<?= $this->Form->input('password', ['id' => 'pwd', 'type'=>'password','prepend' => ' <span class="glyphicon glyphicon-lock"></span> ','label'=>'','placeholder' => 'nouveau mot de passe'],array('class'=>'form-controle')) ?>
<!-- confirmer nouveau mot de passe -->
<?= $this->Form->input('confirmpassword', ['id' => 'confirmpwd','type'=>'password', 'prepend' => ' <span class="glyphicon glyphicon-lock"></span> ','label'=>'','placeholder' => 'confirmer nouveau mot de passe'],array('class'=>'form-controle')) ?>

<br />
<div class="text-center">
<?= $this->Form->button('Enregistrer', array('class'=>'btn btn-info')) ?>
<br />
<br />
</div>
<?= $this->Form->end() ?>
<!-- fin changer mot de passe -->
</div>
  <div id="users_blocks">
    <p class="text-warning">
    
    Les utilisateurs bloqués n'ont aucune intéraction avec vous, c'est à dire qu'ils ne peuvent pas voir vos publications, s'abonner ou encore commenter ce que vous postez.

    </p>
    <hr>
    <?php
            if(isset($nb_bloques))
        {
         echo '<div class="alert alert-info">Aucun utilisateur bloqué</div>';
        }

        else
        {
            
       
    
       
            foreach ($listebloques as $listebloques): ?>

            <div class="tweet" data-username="<?= $listebloques->user->username ?>">
          
            
                            <?= $this->Html->image(''.$listebloques->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>' img-thumbail vcenter')) ?>
                
            <?= $this->Html->link(h($listebloques->user->username),'/'.h($listebloques->user->username).'',['class' => 'link_username_tweet']) ?>
            
            <span class="alias_abo">@<?=$listebloques->user->username ?></span> 

            <span id = "abosearch">
                
 <a href="#" data-username="<?= $listebloques->user->username ;?>" data-action="delete" title="Débloquer <?= $listebloques->user->username ;?>"  id="addblock" class="btn btn-success navbar-btn" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span></a>

</span>
                
              </div>
            
                
            <?php endforeach; ?>


<?php } ?>
  </div>
</div>

          <?= $this->Html->script('settings.js') ?>

