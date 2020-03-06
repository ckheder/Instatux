/**
 * settings.js
 *
 * Mise à jour des paramètres
 *
 */

// désactivation du copier coller pour les champs mail et mot de passe de confirmation

$(document).ready(function(){

    $('#confirmmail, #confirmpwd').on("cut copy paste",function(e) 
  {

    e.preventDefault();

  });
});


// popover info bulle

$('[data-toggle="popover"]').popover();

// gestion des notifications

var action; // sera utilisé pour déterminer quelle notification sera modifié

var choix; // sera utilisé pour déterminer le choix de notification : oui ou non

// mise à jour des préférences de notification

    $('button').click(function(e){

      action = $(this).parent().data("action"); // on récupère l'action du parent : message, abo, comm

      if (typeof action !== 'undefined') {

                    choix  = $(this).val(); // valeur du bouton cliqué : oui ou non

      update_preference_notif(action, choix) // on apelle la fonction de mise à jour

            }

      });

    function update_preference_notif(action, choix) // action : message,comm,abo,... choix : oui/non
    {
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_'+ action +'',
                data: {'choix' : choix},

    success: function(data){

      //mise à jour des préférences d notification réussies

     $('#result_'+ action +'').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
        setTimeout(function() {
          $('#result_'+ action +'').fadeOut("slow");
        }, 2000 );
    },
    error: function(data)
    {
         $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de modifier vos préférences de notifications.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });

//mise à jour des boutons

  $('#notif'+ action +' button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-danger');
  $('#notif'+ action +' button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-success btn-default')


     }

// fin gestion des notifications

// gestion des infos utlisateurs

// gestion du type de profil

$(document).on('click','#setupprofil',function() {

      var action = $(this).data("action"); // public ou prive

      $.ajax({
                url: '/instatux/settings/setup_profil',
                dataType: "text json",
                type: "POST",
                data: {action: action},
    success: function(data){

      if(data === 'profilpublicok'){ // profil devenu public avec succès

//notification


     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Votre profil est désormais public.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );



        document.getElementById('etatprofil').innerHTML = '<p><div class="alert alert-success">Votre profil est public.</div><br />Tous le monde peut voir vos publications.<br /><br />Les demandes d \'abonnement seront acceptés automatiquement.<br /><br /></p><div class="text-center"><a href="#"  data-action="prive" title="Rendre mon profil privé"  id="setupprofil" class="btn" onclick="return false;"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Rendre mon profil privé</a></div>';

    }
        else if(data === 'profilpriveok'){ // profil devenu privé avec succès

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Votre profil est désormais privé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

//mise à jour visuelle        

        document.getElementById('etatprofil').innerHTML = '<p><div class="alert alert-danger">Votre profil est privé.</div><br />Seules vos abonnés voient vos publications.<br /><br />Vous pouvez choisir d\'accepter ou non une demande d\'abonnement.<br /><br /></p><div class="text-center"><a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a></div>';

}
    else if(data === 'probleme'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre profil.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }



  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de mettre à jour votre profil ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
});

// fin mise à jour du profil -> public/privé

// mise à jour informations

//partie avatar

$("#inputfile").on('change', function (event) {


     var imgPath = $(this)[0].value;

     var size = $(this)[0].files[0].size; // taille fichier

     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase(); // extension


     if (extn == "jpg" || extn == "jpeg" || extn == "png") { // fichier jpg/jpeg/png

       if(size <= 3047171) // taille inférieur ou égale à 3mo
       {
         if (typeof (FileReader) != "undefined") { // si vieux navigateur

             var reader = new FileReader();

             reader.onload = function()
             {
                var output = document.getElementById('previewHolder');
                output.src = reader.result;
             }

             reader.readAsDataURL(event.target.files[0]);

         } else {

//notification vieux navigateur
           $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Votre navigateur ne permet pas de lire ce fichier.</span></p>');
setTimeout(function() {
 $('.notif').fadeOut("slow");
}, 2000 );
         }
       }else {

//notification fichier trop gros

         $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Ce fichier est trop gros.</span></p>');
setTimeout(function() {
$('.notif').fadeOut("slow");
}, 2000 );
       }
     } else {

//notification extension fichier

       $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Seules les images jpg/png sont autorisées.</span></p>');
setTimeout(function() {
$('.notif').fadeOut("slow");
}, 2000 );
     }
 });


//envoi des informations

  $('#form_infos').submit(function(e){

      e.preventDefault();

      // vérif password si envoyé

          if ($.trim($('#pwd').val()).length != 0){

      // vérif si les mots de passe correspondent

          if($('#pwd').val() != $('#confirmpwd').val())
        {

          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Les deux mots de passe ne correspondent pas.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // on vide les champs

        $('#pwd').val('');

        $('#confirmpwd').val('');

       return false;
        }
       }

  // fin vérif password si envoyé

      // vérif mail si envoyé

       if ($.trim($('#mail').val()).length != 0){

         // vérification du format de l'adresse mail
         var mail = $('#mail').val();
         var filter = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i; // regex mail

         if (!filter.test(mail)) { // format invalide
           $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Adresse mail de format invalide.</span></p>');
         setTimeout(function() {
           $('.notif').fadeOut("slow");
         }, 2000 );

         // on vide les champs

        $('#mail').val('');

        $('#confirmmail').val('');

        return false;
         }

        if($('#mail').val() != $('#confirmmail').val()) // les dux adresses mail ne correspondent pas
        {
          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Les deux adresses mails ne correspondent pas.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // on vide les champs

        $('#mail').val('');

        $('#confirmmail').val('');

        return false;
        }
       }

      // fin vérif mail si envoyé

        $.ajax({
                type: 'POST',
                contentType: false,
                url: '/instatux/editinfos',
                dataType: 'json',
                data: new FormData(this),
                processData: false,
    success: function(data){

      if(data == "ok") // mise à jour réussie
      {

 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Vos informations ont bien été mise à jours.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

//réinitialisation du formulaire

$('#form_infos')[0].reset();
}
  else if(data == "utilise") // adresse mail déjà utilisée
{
    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Cette adresse mail est déjà utilisé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // on vide les champs

        $('#mail').val('');

        $('#confirmmail').val('');
}
  else if(data == "pasmemepass") // adresse mail déjà utilisée
{
    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Les deux mots de passe ne correspondent pas.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // on vide les champs

        $('#pwd').val('');

        $('#confirmpwd').val('');
}
else if(data == "probleme")
{
                      $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de vos informations.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
}
else {
  {
    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp; ' + data +'.</span></p>');
setTimeout(function() {
$('.notif').fadeOut("slow");
}, 2000 );
  }
}

    },
    error: function(data)
    {

      $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre description ajax.</span></p>');
      setTimeout(function() {
      $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
    });
