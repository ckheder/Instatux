<div id="myTabContent" class="tab-content">
  <div class="tab-pane  in active" id="infos">
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
&nbsp;Tous le monde peut voir vos publications.
<br />
<br />
&nbsp;Les demandes d 'abonnement seront acceptés automatiquement.
  <br />
  <br />
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
&nbsp;Seules vos abonnés voient vos publications.<br />
<br />
&nbsp;Vous pouvez choisir d'accepter ou non une demande d'abonnement.
<br />
<br />
</p>
<div class="text-center">
<a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn btn-success" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a>
</div>
</span>
<?php
 }

 ?>
<br />
 <div class="text-center">
 <h4> <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Mes informations</h4>
</div>
<br />
<div class="alert alert-info">
<strong>Info!</strong> Vous pouvez ajouter ou modifier toutes les informations vous concernant et qui seront affichés sur votre profil à l'exception de votre adresse mail et de votre mot de passe.
<br />
<br />
Toutes ces informations sont facultatives.

    </div>
<?= $this->Form->create('', array('id'=>'form_infos','type' => 'file'));?>
<div class="text-center">
<h4><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Parler de moi</h4>
</div>
<?= $this->Form->Textarea('description', ['id' => 'description','label'=>'','placeholder' => 'Brève description de moi-même...']) ?>

<br />
<!-- fin modifier ma descritpion -->
<!-- modifier mon lieu -->

<div class="text-center">
<h4><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Changer mon adresse mail</h4>
</div>
<div class="alert alert-success">

<strong>Important !</strong> Votre adresse mail sert uniquement de contact , elle ne sera ni affichée, ni partagée et ni conservée même en cas de suppression de votre compte.
    </div>

<?= $this->Form->input('mail', ['id' =>'mail','type' => 'email','prepend' => ' <span class="glyphicon glyphicon-envelope"></span> ','label'=>'','placeholder' => 'Nouvelle adresse mail'],array('class'=>'form-controle')) ?>

<?= $this->Form->input('confirmmail', ['id' => 'confirmmail','type'=>'email', 'prepend' => ' <span class="glyphicon glyphicon-envelope"></span> ','label'=>'','placeholder' => 'Confirmer nouvelle adresse mail','autocomplete' => 'off'],array('class'=>'form-controle')) ?>

<!-- fin modifier mon lieu -->
<!-- modifier mon lieu -->

<div class="text-center">
  <br />
<h4><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Ma localisation</h4>
</div>
<?= $this->Form->input('lieu', ['id' =>'lieu','prepend' => ' <span class="glyphicon glyphicon-map-marker"></span> ','label'=>'','placeholder' => 'Ex: Paris, New York, Montréal,...'],array('class'=>'form-controle')) ?>
<!-- fin modifier mon lieu -->
<!-- modifier mon site web -->
<div class="text-center">
  <br />
<h4><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Mon site</h4>
</div>
<?= $this->Form->input('website', ['id' => 'website', 'type' => 'url','prepend' => ' <span class="glyphicon glyphicon-globe"></span> ','label'=>'','placeholder' => 'http://www.monsite.com'],array('class'=>'form-controle')) ?>
<!-- fin modifier mon site web -->
<!-- modifier mon avatar -->
<div class="text-center">
<h4><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Changer ma photo</h4>
</div>
<br />
<p class="text-muted">Nouvel avatar (jpg/jpeg/png) 3mo maximum </p>
<input id="inputfile" type="file" name="avatar"   accept="image/*">
<br />
<div class="alert alert-info">
<strong>Important !</strong> Votre avatar peut mettre un peu de temps à se mettre à jour, n'hésitez pas à actualiser la prochaine page que vous visiterez si votre avatar n'a pas changé.
</div>
<!-- preview avatar -->
<div class="text-center">
  <p class="text-muted">Preview.</p>
<!--<img id="previewHolder"  width="160px" height="160px"/>-->

<?= $this->Html->image('default.png', ['alt' => '','id' => 'previewHolder', 'width' =>128, 'height'=> 'auto','class'=>'img-circle']); ?>
</div>
<!-- changer mot de passe -->
<div class="text-center">
<h4> <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Changer de mot de passe</h4>
</div>
<div class="alert alert-danger">
<strong>Important !</strong> Votre nouveau de passe devrait contenir des chiffres, des lettres et des symboles alphanumérique(#,@,$,...) pour plus de sécurité.
</div>
<?= $this->Form->input('password', ['id' => 'pwd', 'type'=>'password','prepend' => ' <span class="glyphicon glyphicon-lock"></span> ','label'=>'','placeholder' => 'nouveau mot de passe'],array('class'=>'form-controle')) ?>
<!-- confirmer nouveau mot de passe -->
<?= $this->Form->input('confirmpassword', ['id' => 'confirmpwd','type'=>'password', 'prepend' => ' <span class="glyphicon glyphicon-lock"></span> ','label'=>'','placeholder' => 'confirmer nouveau mot de passe','autocomplete' => 'off'],array('class'=>'form-controle')) ?>

<br />
<div class="text-center">
<div class="btn-group" role="group">
<?= $this->Form->button('Enregistrer', ['class' => 'btn btn-success','type'=>'submit']) ?><?= $this->Form->button('Réinitialiser', ['class' => 'btn btn-default','type' => 'reset']) ?>
<br />
<br />
</div>
</div>
<?= $this->Form->end() ?>
<!-- fin changer mot de passe -->
  </div>
<div class="tab-pane" id="notifs">
  <!-- notifications -->

<div class="text-center">
<h4> <span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications</h4>
</div>
<div class="alert alert-info">
<strong>Info!</strong> Vous pouvez gérer ici toutes les notifications que vous souhaitez recevoir sur divers évènements.
<br />
<br />
Vous ne recevrez des notifications que sur le site, aucune notification ne sera envoyé par mail.

    </div>
<!-- notification de message -->

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de messages vous informent en cas de nouveaux messages que ce soit dans une conversation en cours ou si quelqu'un avec qui vous ne parlez pas vous à envoyé un message.
"><span class="glyphicon glyphicon-question-sign"></span></a>

<label for="notifmessage">Notification de message</label>

<div class="btn-group" data-action="message" id="notifmessage">

   <?php if($notif_message == 'oui')
   {
    ?>
     <button type="button" value="non" class="btn btn-default notif unlocked_inactive">Non</button>
      <button type="button" value="oui" class="btn btn-success locked_active">Oui</button>

  <?php
}
  elseif($notif_message == 'non')
  {
    ?>
      <button type="button" value="non" class="btn btn-danger notif locked_active">Non</button>
  <button type="button" value="oui" class="btn btn-default unlocked_inactive">Oui</button>
    <?php
  }
  ?>
</div>
<span id="result_message" class="spannotif"></span>

<!-- fin notification de message -->
<br />
<!-- notification de citation -->

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de citation vous informent si votre @ à étaient utilisés dans un tweet soit de vos abonnés soit de quelqu'un d'autre, vous pouvez ainsi détecté les insultes ou autre et le signaler.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for="notifcite">Notification de citation</label>
<div class="btn-group" data-action="cite" id="notifcite">
   <?php if($notif_cite == 'oui')
   {
    ?>
      <button type="button" value="non" class="btn btn-default unlocked_inactive">Non</button>
  <button type="button" value="oui" class="btn btn-success locked_active">Oui</button>

  <?php
}
  elseif($notif_cite == 'non')
  {
    ?>
      <button type="button" value="non" class="btn btn-danger locked_active">Non</button>
  <button type="button" value="oui" class="btn btn-default unlocked_inactive">Oui</button>
    <?php
  }
  ?>
</div>
<span id="result_cite" class="spannotif"></span>
<!-- fin notification de citation -->
<br />
<!-- notification de partage -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de partage vous informent si l'une de vos publications à étaient partagée, attention cependant les commentaires sont indépendant d'une publication à l'autre, assurez vous que vos publications soient vues par les bonnes personnes.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for="notifpartage">Notification de partage</label>
<div class="btn-group" data-action="partage" id="notifpartage">
   <?php if($notif_partage == 'oui')
   {
    ?>
      <button type="button" value="non" class="btn btn-default unlocked_inactive">Non</button>
  <button type="button" value="oui" class="btn btn-success locked_active">Oui</button>

  <?php
}
  elseif($notif_partage == 'non')
  {
    ?>
      <button type="button" value="non" class="btn btn-danger locked_active">Non</button>
  <button type="button" value="oui" class="btn btn-default unlocked_inactive">Oui</button>
    <?php
  }
  ?>
</div>
<span id="result_partage" class="spannotif"></span>

<!-- notification de partage -->
<br />
<!-- notification d'abonnement -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications d'abonnement vous informent d'un nouvel abonnement à votre profil, attention cependant vous ne pouvez paramétrer ces notifications que dans le cas d'un profil public.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for="notifabo">Notification d'abonnement</label>
<div class="btn-group" data-action="abo" id="notifabo">
   <?php if($notif_abo == 'oui')
   {
    ?>
      <button type="button" value="non" class="btn btn-default unlocked_inactive">Non</button>
  <button type="button" value="oui" class="btn btn-success locked_active">Oui</button>

  <?php
}
  elseif($notif_abo == 'non')
  {
    ?>
      <button type="button" value="non" class="btn btn-danger locked_active">Non</button>
  <button type="button" value="oui" class="btn btn-default unlocked_inactive">Oui</button>
    <?php
  }
  ?>
</div>
<span id="result_abo" class="spannotif"></span>
<!-- fin notification d'abonnement -->
<br />
<!-- notification commentaire -->
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de commentaires vous informent si vos abonnés , dans le cas d'un profil privé ou si quelqu'un à commenté l'une de vos publications.Vous pourrez ainsi les consulter, les modérer, signaler tous commentaires injurieux ou bloquer les commentaires d'une publication.
"><span class="glyphicon glyphicon-question-sign"></span></a>
<label for="notifcomm">Notification de commentaires</label>
<div class="btn-group" data-action="comm" id="notifcomm">
   <?php if($notif_comm == 'oui')
   {
    ?>
      <button type="button" value="non" class="btn btn-default unlocked_inactive">Non</button>
  <button type="button" value="oui" class="btn btn-success locked_active">Oui</button>

  <?php
}
  elseif($notif_comm == 'non')
  {
    ?>
      <button type="button" value="non" class="btn btn-danger locked_active">Non</button>
  <button type="button" value="oui" class="btn btn-default unlocked_inactive">Oui</button>
    <?php
  }
  ?>
</div>
<span id="result_comm" class="spannotif"></span>

    <!-- fin notification de commentaire -->
<!-- fin notifications -->
  </div>
   <div class="tab-pane " id="blocks">
    <div  class="alert alert-warning">

    <strong> Important ! </strong> Les utilisateurs bloqués n'ont aucune intéraction avec vous, c'est à dire qu'ils ne peuvent pas voir vos publications, s'abonner, partager vos publications ou encore commenter ce que vous postez.
    <br />
<br />
     Vous pouvez les débloquer à tout moment.

    </div>
    <?php
            if(isset($nb_bloques))
        {
         echo '<div class="alert alert-info">Aucun utilisateur bloqué.</div>';
        }

        else
        {

            foreach ($listebloques as $listebloques): ?>

            <div class="tweet" data-username="<?= $listebloques->user->username ?>">


                            <?= $this->Html->image('/img/avatar/'.$listebloques->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>' img-circle vcenter')) ?>

            <?= $this->Html->link(h($listebloques->user->username),'/'.h($listebloques->user->username).'',['class' => 'link_username_tweet']) ?>

            <span class="alias_abo">@<?=$listebloques->user->username ?></span>

            <span id = "deleteblock">

 <a href="#" data-username="<?= $listebloques->user->username ;?>" data-action="delete" title="Débloquer <?= $listebloques->user->username ;?>"  id="addblock" class="btn btn-success navbar-btn" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span></a>

</span>

              </div>


            <?php endforeach; ?>


<?php } ?>
  </div>
  <div class="tab-pane " id="deleteaccount">
<div class="alert alert-warning">
<span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;La suppresion de votre compte entraînera l'effacement complet de tous vos posts mais pas ceux qui auront été partagés par les personnes qui vous suivent.
<br />
<br />
Un mail de confirmation vous sera envoyé pour confirmer la suppression de votre compte.
<br />
<br />
Cette action est irréversible.
</div>
<div class="text-center">
<?=$this->Html->link(
    'Supprimer mon compte',
    ['controller' => 'users', 'action' => 'delete', $authUser],
    [ 'class' => 'btn btn-danger navbar-btn']
);

?>

</div>
  </div>
</div>
