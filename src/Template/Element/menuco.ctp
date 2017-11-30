 <nav class="navbar navbar-inverse navbar-fixed-top container">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/instatux/actualités"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Actualités</a></li>
        <li><a href="/instatux/notifications"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications&nbsp;<span class="badge badge_notif"><span id="count_nb_notif">0</span></span></a></li>
        <li><a href="/instatux/abonnement"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Abonnement</a></li>
          <li><a href="/instatux/<?= $authName ;?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Moi</a></li>
      </ul>
<?= $this->Form->create('', array('class'=>'navbar-form navbar-left','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
    

   <div class="input-group">
       <?= $this->Form->input('search',['type' => 'search', 'label'=>'', 'placeholder' =>'Recherche...', 'required']); ?>
   </div>
</form>

<?= $this->Form->button('<span class="glyphicon glyphicon-pencil"></span>', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalTweet',
                  'class' => 'btn btn-info navbar-btn',
                  'type' => 'button']);
                  ?>

          

      <ul class="nav navbar-nav navbar-right">
     
       <li><a href="/instatux/messagerie" title="Messagerie"><span class="glyphicon glyphicon-envelope"></span>&nbsp;</a></li>
       <li><a href="/instatux/bloques" title="Utilisateurs bloqués"><span class="glyphicon glyphicon-ban-circle red"></span>&nbsp;</a></li>
       <li><a href="/instatux/settings" title="Paramètres"><span class="glyphicon glyphicon-wrench"></span></a></li>
        <li><a href="/instatux/logout" title="Déconnexion"><span class="glyphicon glyphicon-log-out"></span></a></li>
      </ul>
    </div>
  </div>
</nav>