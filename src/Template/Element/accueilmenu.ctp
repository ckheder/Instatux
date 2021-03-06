 <!--

 * accueilmenu.ctp
 *
 * Menu d'accueuil du site
 *
 */

-->

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
    <a href="/instatux/actualites" title="Actualités"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Accueil</a></li>
<li>
      <!-- formulaire de recherche -->
      <?= $this->Form->create('', array('class'=>'navbar-form','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>

   <div class="input-group">

       <?= $this->Form->input('search',['id'=>'search','type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required']);?> 
      <div class="input-group-btn">

        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

      </div>
    </div>

      <?= $this->Form->end(); ?>
</li>
</ul>
<!-- connexion -->
<div class="text-center logintitle">
  <h4>Connexion</h4>
</div>
       <ul class="nav navbar-nav navbar-right">
        <li>
          <!-- formulaire connexion -->
      <?= $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'login'),'class' =>'navbar-form','id' =>'formco'));?>

      <!-- username -->

      <?= $this->Form->input('username', ['placeholder'=>'Nom d\'utilisateur', 'label' => '','id' => 'inputusernamehome']); ?>

      <!-- mot de passe -->

      <?= $this->Form->password('password', ['placeholder'=>'Mot de passe',  'label' => '', 'id' => 'inputpasswordhome']); ?>

      <!-- bouton de connexion -->

      <?= $this->Form->button('Connexion', array('class'=>'btn btn-primary btnlogin')) ?>

      <?= $this->Form->end() ?>

      <!-- fin formulaire connexion -->
        </li>
        <li>
          <a href="#" id="forgetmdp">Mot de passe oublié ? </a>
        </li>
       <li>
        <!-- bouton de connexion (visible uniquement sur l'accueil offline) -->

          <?= $this->Form->button('Connexion', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalConnexion',
                  'class' => 'btn btn-primary navbar-btn btnlogin',
                  'id' => 'btnco',
                  'type' => 'button']);
                  ?>
      </li>
       </ul>
    </div>
  </div>
</nav>
