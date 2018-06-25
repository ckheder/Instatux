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
      <ul class="nav navbar-nav navbar-left">
 <li>
  <a href="/instatux/actualites" title="Actualités"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Accueil</a></li>

        <li>
      <?= $this->Form->create('', array('class'=>'navbar-form','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
 

   <div class="input-group">
       <?= $this->Form->input('search',['type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required','class' =>'form-control']); ?>
  
    <div class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
     </div>
</form>
</li>
</ul>
       <ul class="nav navbar-nav navbar-right">
        <li>
          <?= $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'login'),'class'=>'navbar-form'));?>

       <?= $this->Form->input('username', ['placeholder'=>'Nom d\'utilisateur', 'label' => '']); ?>
   <?= $this->Form->password('password', ['placeholder'=>'Mot de passe',  'label' => '']); ?>

<?= $this->Form->button('Connexion', array('class'=>'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
        </li>
       </ul>


    </div>
  </div>
</nav>
