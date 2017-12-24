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
     
        <li><a href="/instatux/settings" title="Paramètres"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Configuration</a></li>
          <li><a href="/instatux/<?= $authName ;?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Moi</a></li>

      </ul>
<?= $this->Form->create('', array('class'=>'navbar-form navbar-left','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
    

   <div class="input-group">
       <?= $this->Form->input('search',['type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required','class' =>'form-control']); ?>
  
    <div class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
       </div>
</form>

<?= $this->Form->button('<span class="glyphicon glyphicon-pencil"></span>', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalTweet',
                  'class' => 'btn btn-info navbar-btn',
                  'type' => 'button']);
                  ?>

          

      <ul class="nav navbar-nav navbar-right">
     <li><a href="/instatux/notifications" title="Notifications"><span class="glyphicon glyphicon-bell"></span><span id="count_nb_notif"></span></a></li>
       <li><a href="/instatux/messagerie" title="Messagerie"><span class="glyphicon glyphicon-envelope"></span></a></li>
      
       <li><a href="/instatux/abonnement/<?= $authName ;?>" title="Abonnement"><span class="glyphicon glyphicon-eye-open"></span></a></li>
       
        <li><a href="/instatux/logout" title="Déconnexion"><span class="glyphicon glyphicon-log-out"></span></a></li>
      </ul>
    </div>
  </div>
</nav>