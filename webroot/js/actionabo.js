  // nouvel abonnement ou demande

      $(document).on('click','#aboact',function() {

      var username = $(this).data("username");
      var action = $(this).data("action"); // add ou delete

       if (action == 'add')

      {

              $.ajax({
                url: '/instatux/abonnement/add/'+ username +'',
    success: function(data){

      if(data == 'demandeok'){ // demande d'abonnement réussite à un profil privé

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Demande d\'abonnement envoyé à ' + username +'.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         document.getElementById('actionabo').innerHTML = '<a href="" title="Demande envoyé à ' + username +'"  id="aboact" class="btn btn-warning" >Demande envoyé à  ' + username +'</a>'; // bouton signifiant l'envoi d'une demande
    }

            else if(data == 'abook'){ // abonnement réussi à un profil public

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;' + username +' fais désormais parti de vos abonnés.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actionabo').innerHTML = '<button data-toggle="modal" data-target="#modalmessage" class="btn btn-primary navbar-btn" title="Envoyer un message à ' + username + '" type="button"><span class="glyphicon glyphicon-envelope"></span></button> - <a href="#" data-username="' + username +'" data-action="delete" title="Ne plus suivre ' + username +'"  id="aboact" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-minus"></span></a>'; // bouton signifiant l'envoi d'une demande
       
    }
        else if(data == 'problème'){ // problème requete

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }


  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
        }

        )}  

        // fin nouvel abo / demande 

        // supprimer un abonnement

     else if( action = 'delete')

        {

              $.ajax({
                url: '/instatux/abonnement/delete/'+ username +'',
    success: function(data){

      if(data == 'suppok'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Abonnement supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actionabo').innerHTML = '<a href="#" data-username="' + username +'" data-action ="add" title="Suivre ' + username +'"  id="aboact" class="btn btn-success navbar-btn" onclick="return false;"><span class="glyphicon glyphicon-plus"></span></a>'; // bouton signifiant l'envoi d'une demande

}

        else if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }


  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
}

});


