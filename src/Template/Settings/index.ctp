<!--

 * index.ctp
 *
 * Mise en page settings
 *
 */ -->

<div id="myTabContent" class="tab-content">

  <div class="tab-pane  in active" id="infos">

    <!-- gestion profil -->
            <h3>Mon profil</h3>
          <hr>
              <p class="headsettings">Définir mon profil et mes informations. </p>
          <hr>

<?php
            if($setup_profil == 0) // profil public
          {
?>
            <span id="etatprofil">

        <p>

            <div class="alert alert-success">Votre profil est public.</div>

<br />

Tous le monde peut voir vos publications.

<br />

<br />

Les demandes d 'abonnement seront acceptés automatiquement.

<br />

<br />

        </p>

      <div class="text-center">

        <a href="#"  data-action="prive" title="Rendre mon profil privé"  id="setupprofil" class="btn" onclick="return false;"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Rendre mon profil privé</a>

      </div>


        </span>
<?php
}
            else // profil privé
          {
 ?>

            <span id="etatprofil">

          <p>

              <div class="alert alert-danger">&nbsp;Votre profil est privé.</div>

<br />

<br />

&nbsp;Seules vos abonnés voient vos publications.

<br />

<br />

&nbsp;Vous pouvez choisir d'accepter ou non une demande d'abonnement.

<br />

<br />
        </p>

<!--modifier profil -->

<div class="text-center">

  <a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a>

</div>

        </span>
<?php
 }

 ?>
 <hr>


<!--modifier informations -->

<p class="headsettings">Compléter mes informations. </p>

<hr>

<?= $this->Form->create('', array('id'=>'form_infos','type' => 'file'));?>

<div class="form-group">

<label for="inputType" class="col-sm-4 control-label">Parler de moi </label>

<div class="col-sm-8">
<!--modifier description -->

<?= $this->Form->Textarea('description', ['id' => 'description','label'=>'','placeholder' => 'Brève description de moi-même...']) ?>

</div>
</div>

<!-- fin modifier ma descritpion -->

<!-- modifier mon adresse mail -->

<!--champ mail -->

<div class="form-group">

<label for="inputType" class="col-sm-4 control-label">Nouvelle adresse Mail</label>

<div class="col-sm-8">

<?= $this->Form->input('mail', ['id' =>'mail','type' => 'email','label'=>'','placeholder' => 'Nouvelle adresse mail'],array('class'=>'form-controle')) ?>

</div>

</div>

<!--confirmer mail -->

<div class="form-group">

<label for="inputType" class="col-sm-4 control-label">Confirmer adresse Mail</label>

<div class="col-sm-8">

<?= $this->Form->input('confirmmail', ['id' => 'confirmmail','type'=>'email','label'=>'','placeholder' => 'Confirmer nouvelle adresse mail','autocomplete' => 'off'],array('class'=>'form-controle')) ?>

</div>

</div>
<!-- fin modifier mail -->

<!-- modifier mon lieu -->

<!-- champ lieu -->
<div class="form-group">

      <label for="inputType" class="col-sm-4 control-label">Partager ma localisation</label>

<div class="col-sm-8">

  <?= $this->Form->input('lieu', ['id' =>'lieu','label'=>'','placeholder' => 'Ex: Paris, New York, Montréal,...'],array('class'=>'form-controle')) ?>

</div>

</div>


<!-- fin modifier mon lieu -->

<!-- modifier mon site web -->

<!-- champsite web -->
<div class="form-group">

      <label for="inputType" class="col-sm-4 control-label">Mon site WEB</label>

<div class="col-sm-8">

  <?= $this->Form->input('website', ['id' => 'website', 'type' => 'url','label'=>'','placeholder' => 'Ex: http://www.monsite.com'],array('class'=>'form-controle')) ?>

</div>

</div>


<!-- fin modifier mon site web -->

<!-- modifier mon avatar -->

<p class="headsettings">Changer ma photo de profil. </p>

<hr>

  <p>Nouvel avatar (jpg/jpeg/png) 3mo maximum </p>

  <!-- champ avatar, n'accepte que les images -->

  <input id="inputfile" type="file" name="avatar"   accept="image/*">

    <div class="alert alert-info">

        <strong>Information : </strong>Votre avatar peut mettre un peu de temps à se mettre à jour,actualiser la prochaine page que vous visiterez si votre avatar n'a pas changé.

    </div>

<!-- preview avatar -->

<div class="text-center">

  <p class="text-muted">Prévisualisation</p>

<?= $this->Html->image('default.png', ['alt' => '','id' => 'previewHolder', 'width' =>128, 'height'=> 'auto','class'=>'img-circle']); ?>

</div>

<hr>
<!-- changer mot de passe -->
<p class="headsettings">Changer mon mot de passe. </p>

<hr>

<div class="alert alert-danger">

    <strong>Important !</strong> Votre nouveau de passe devrait contenir des chiffres, des lettres et des symboles alphanumérique(#,@,$,...) pour plus de sécurité.

</div>

<br />
<!--champ mot de passe -->

<div class="form-group">

      <label for="inputType" class="col-sm-4 control-label">Nouveau mot de passe</label>

<div class="col-sm-8">

    <?= $this->Form->input('password', ['id' => 'pwd', 'type'=>'password','label'=>'','placeholder' => 'Entrer mot de passe'],array('class'=>'form-controle')) ?>

</div>

</div>

<!-- confirmer nouveau mot de passe -->
<div class="form-group">

      <label for="inputType" class="col-sm-4 control-label">Confirmer mot de passe</label>

<div class="col-sm-8">

<?= $this->Form->input('confirmpassword', ['id' => 'confirmpwd','type'=>'password','label'=>'','placeholder' => 'Confirmer mot de passe','autocomplete' => 'off'],array('class'=>'form-controle')) ?>

</div>

</div>

<br />

<!-- bouton de validation/ réinitialisation -->

<div class="text-center">

<?= $this->Form->button('Enregistrer', ['class' => 'btn btn-primary','type'=>'submit']) ?>&nbsp;<?= $this->Form->button('Réinitialiser', ['class' => 'btn btn-default','type' => 'reset']) ?>

<br />

</div>

<?= $this->Form->end(); ?>

<hr>

  </div>

<div class="tab-pane" id="notifs">

          <br />
          <p class="headsettings">Configuration des notifications. </p>
          <hr>

  <!-- gestion notification -->

<p>

<!-- notification de message -->

<!-- popover information -->

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="

Les notifications de messages vous informent en cas de nouveaux messages que ce soit dans une conversation en cours ou si quelqu'un avec qui vous ne parlez pas vous à envoyé un message.">

<span class="glyphicon glyphicon-question-sign"></span></a>

Notification de message

<span id="result_message" class="spannotif"></span>

<div class="btn-group" data-action="message" id="notifmessage">

   <?php  

          if($notif_message == 'oui')
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


</p>

<!-- fin notification de message -->
<br />
<!-- notification de citation -->
<p>

<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de citation vous informent si votre @ à étaient utilisés dans un tweet soit de vos abonnés soit de quelqu'un d'autre, vous pouvez ainsi détecté les insultes ou autre et le signaler.">

<span class="glyphicon glyphicon-question-sign"></span></a>

Notification de citation

<span id="result_cite" class="spannotif"></span>

<div class="btn-group" data-action="cite" id="notifcite">

   <?php  

          if($notif_cite == 'oui')
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


</p>
<!-- fin notification de citation -->
<br />
<!-- notification de partage -->
<p>
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de partage vous informent si l'une de vos publications à étaient partagée, attention cependant les commentaires sont indépendant d'une publication à l'autre, assurez vous que vos publications soient vues par les bonnes personnes.">

<span class="glyphicon glyphicon-question-sign"></span></a>

Notification de partage

<span id="result_partage" class="spannotif"></span>

<div class="btn-group" data-action="partage" id="notifpartage">

   <?php 

          if($notif_partage == 'oui')
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
</p>

<!-- notification de partage -->
<br />
<!-- notification d'abonnement -->
<p>
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications d'abonnement vous informent d'un nouvel abonnement à votre profil, attention cependant vous ne pouvez paramétrer ces notifications que dans le cas d'un profil public.">

<span class="glyphicon glyphicon-question-sign"></span></a>

Notification d'abonnement

<span id="result_abo" class="spannotif"></span>

<div class="btn-group" data-action="abo" id="notifabo">

   <?php 

          if($notif_abo == 'oui')
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


<!-- fin notification d'abonnement -->
</p>
<br />
<!-- notification commentaire -->
<p>
<a href="#"  data-toggle="popover" data-trigger="hover" data-content="
Les notifications de commentaires vous informent si vos abonnés , dans le cas d'un profil privé ou si quelqu'un à commenté l'une de vos publications.Vous pourrez ainsi les consulter, les modérer, signaler tous commentaires injurieux ou bloquer les commentaires d'une publication.">

<span class="glyphicon glyphicon-question-sign"></span></a>

Notification de commentaires

<span id="result_comm" class="spannotif"></span>

<div class="btn-group" data-action="comm" id="notifcomm">

   <?php  

          if($notif_comm == 'oui')
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



</p>

    <!-- fin notification de commentaire -->

    <!-- fin notifications -->

</div>

<!-- gestion des utilisateurs bloqués -->

   <div class="tab-pane " id="blocks">


            <h3>Utilisateurs bloqués</h3>
          <br />
          <p class="headsettings">Les utilisateurs bloqués n'ont aucune intéraction avec vous : ils ne peuvent pas voir vos publications, s'abonner, partager vos publications, vous envoyer de message ou encore commenter ce que vous postez.</p>
          <hr>


    <?php
            if(isset($nb_bloques)) // aucun utilisateur bloqué
          {
            echo '<div class="alert alert-info">Aucun utilisateur bloqué.</div>';
          }

            else
          {

            echo '<div id="list_block">';

            foreach ($listebloques as $listebloques): ?>

            <div class="liste_abo" data-username="<?= $listebloques->Users['username'] ?>">

              <!-- avatar -->

              <?= $this->Html->image('/img/avatar/'.$listebloques->Users['username'].'.jpg', array('alt' => 'image utilisateur', 'class'=>' img-circle')) ?>

              <!-- lien vers profil -->

              <p>

              <?= $this->Html->link(h($listebloques->Users['username']),'/'.h($listebloques->Users['username']).'',['class' => 'link_username_tweet']) ?>

              <!-- alias -->

              <span class="alias_abo">@<?= $listebloques->Users['username']; ?></span>

              <br />

                  <?= $listebloques->Users['description']; ?>

            </p>

              <!-- lien de déblocage -->

                <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $listebloques->Users['username'] ;?>" data-action="delete" title="Débloquer <?= $listebloques->Users['username'] ;?>"  id="addblock" onclick="return false;">Débloquer</a>

              </div>

            <?php endforeach; 

            echo '</div>';

} 

?>
  </div>
</div>
