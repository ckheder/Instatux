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

         document.querySelector('#actionabo').innerHTML = ' <button type="button" class="btn btn-info">En attente</button>'; // bouton signifiant l'envoi d'une demande
    }

            else if(data == 'abook'){ // abonnement réussi à un profil public

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Vous suivez désormais  '+ username +'.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.querySelector('#actionabo').innerHTML = '<button data-username="' + username +'" data-action="delete" title="Ne plus suivre '+ username +'" type="button"  id="aboact" class="btn btn-danger navbar-btn" onclick="return false;">Ne plus suivre</button> - <button data-toggle="modal" data-target="#modalmessage" class="btn btn-primary navbar-btn" title="Envoyer un message à ' + username +'" type="button">Envoyer un message</button>'; // bouton signifiant l'envoi d'une demande 
                
       
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

        if ($('#actionabo').length > 0) {

        document.querySelector('#actionabo').innerHTML = '<button data-username="' + username+ '" data-action="add" title="Suivre ' + username +'"  id="aboact" class="btn btn-success" onclick="return false;">Suivre</button>'; // bouton signifiant l'envoi d'une demande
        }
        else
        {
        nbabonnement--; // on diminue le nombre de demande d'abonnement

        if(nbabonnement != 0)
        {

document.querySelector('#nbabonnement').innerHTML = nbabonnement + ' abonnement(s).'; // mise à jour du champs
}
else
{
  document.querySelector('#nbabonnement').innerHTML = 'Aucun abonnement actif à afficher.'; // mise à jour du champs, plus d'abonnements
}

$( '.liste_abo[data-username="' + username + '"]' ).remove();
}

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