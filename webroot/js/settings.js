// désactivation du copier coller pour les champs mail et mot de passe de confirmation

$(document).ready(function(){
  $('#confirmmail, #confirmpwd').on("cut copy paste",function(e) {
    e.preventDefault();
  });
});


// popover infoi bulle

    $('[data-toggle="popover"]').popover();

// gestion des notifications

var action; // sera utilisé pour déterminer quelle notification sera modifié

var choix; // sera utilisé pour déterminer le choix de notification : oui ou non

        // notif de message
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
  $('#notif'+ action +' button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-danger');
  $('#notif'+ action +' button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-success btn-default')


     }

// fin gestion des notifications


// gestion des infos utlisateurs
$(document).on('click','#setupprofil',function() {

      var action = $(this).data("action");

              $.ajax({
                url: '/instatux/settings/'+ action +'',
    success: function(data){



      if(data == 'profilpublicok'){ // profil devenu public avec succès



     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Votre profil est désormais public.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('etatprofil').innerHTML = '<p class="text-success"><br />&nbsp;Tous le monde peut voir vos publications.<br /><br />&nbsp;Les demandes d \'abonnement seront acceptés automatiquement.</p><br /><div class="text-center"><a href="#"  data-action="prive" title="Rendre mon profil privé"  id="setupprofil" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Rendre mon profil privé</a></div>';

    }
        else if(data == 'profilpriveok'){ // profil devenu privé avec succès


     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Votre profil est désormais privé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('etatprofil').innerHTML = '<p class="text-danger"><br />&nbsp;Seules vos abonnés voient vos publications.<br /><br />&nbsp;Vous pouvez choisir d\'accepter ou non une demande d\'abonnement.</p><br /><div class="text-center"><a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn btn-success" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a></div>'  ;

}
    else if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre profil.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }



  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de mettre à jour votre profil.</span></p>');
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
     var size = $(this)[0].files[0].size;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

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
           $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Votre navigateur ne permet pas de lire ce fichier.</span></p>');
setTimeout(function() {
 $('.notif').fadeOut("slow");
}, 2000 );
         }
       }else {
         $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Ce fichier est trop gros.</span></p>');
setTimeout(function() {
$('.notif').fadeOut("slow");
}, 2000 );
       }
     } else {
       $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Seules les images jpg/png sont autorisées.</span></p>');
setTimeout(function() {
$('.notif').fadeOut("slow");
}, 2000 );
     }
 });

    $('#form_infos').submit(function(e){

      e.preventDefault();


      // vérif password si envoyé

       if ($.trim($('#pwd').val()).length != 0){

        if($('#pwd').val() != $('#confirmpwd').val())
        {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Les deux mots de passe ne correspondent.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
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
       $('#mail').val('');
        $('#confirmmail').val('');
        return false;
         }

        if($('#mail').val() != $('#confirmmail').val()) // les dux adresses mail ne correspondent pas
        {
          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Les deux adresses mails ne correspondent.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
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

      if(data == "ok")
      {

 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Vos informations ont bien été mise à jours.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

$('#form_infos')[0].reset();
}
else if(data == "utilise")
{
                      $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Cette adresse mail est déjà utilisé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#mail').val('');
         $('#confirmmail').val('');
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
