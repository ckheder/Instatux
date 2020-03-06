/**
 * Actionabo.js
 *
 * Gestion des actions relatives à un abonnement
 *
 */

// actualisation des suggestions

$(document).on("click", "#resetsugg", function()
{

  $("#list_sugg").load('/instatux/suggestion');
}
);


// nouvel abonnement ou demande

      $(document).on('click','#aboact',function() {

      var username = $(this).data("username"); // personne à ajouter ou supprimer

      var action = $(this).data("action"); // add ou delete

        if (action == 'add') // ajout d'un abonnement
      {

              $.ajax({
                url: '/instatux/abonnement/add/'+ username +'',

    success: function(data){

      if(data == 'demandeok'){ // demande d'abonnement réussite à un profil privé

    $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Demande d\'abonnement envoyé à ' + username +'.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         this.innerHTML = '<span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;<a href="" data-username="' +username+'" data-action="deleterequest" title="Annuler la demande d\'abonnement" type="button"  id="aboact" onclick="return false;">Demande envoyée</a>'; // bouton signifiant l'envoi d'une demande
    }

      else if(data == 'abook'){ // abonnement réussi à un profil public

        // envoi d'une notification

    $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Vous suivez désormais  '+ username +'.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        //ajout d'un bouton de suppression de cet abonnement

        // depuis un profil, mise à jour du bouton + suppression suggestion si jamais

        if ($('#actionabo').length > 0) {

        document.querySelector('#actionabo').innerHTML = '<span class="glyphicon glyphicon-eye-close"></span>&nbsp;&nbsp;<a href="" data-username="'+username+'" data-action="delete" title="Ne plus suivre '+username+'" type="button"  id="aboact" onclick="return false;">Ne plus suivre</a>';

        //si la suggestion correspond au profil en cours de visiste

        if ($('.sugg[data-username="' + username + '"]').length > 0) {

          $('.sugg[data-username="' + username + '"]').remove();
        }

      }

      //suggestion ccueil

      else if ($('.sugg[data-username="' + username + '"]').length > 0) {

        $('.sugg[data-username="' + username + '"]').remove();
      }

      // depuis la page de mes abonnes, je suis un abonné , mise à jour bouton

      if ($('#actionabo'+username+'').length > 0) {

        document.querySelector('#actionabo'+username+'').innerHTML = '<span class="glyphicon glyphicon-eye-close"></span>&nbsp;&nbsp;<a href="" data-username="'+username+'" data-action="delete" title="Ne plus suivre '+username+'" type="button"  id="aboact" onclick="return false;">Ne plus suivre</a>';
    }


    }
      else if(data == 'blocage')
    { // blocage

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Cet utilisateur vous à bloqué, vous ne pouvez pas vous y abonner.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
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

        //envoi notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Abonnement supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        if ($('#actionabo').length > 0) {

          //si je supprime un abonnement depuis un profil, mise à jour des boutons

        document.querySelector('#actionabo').innerHTML = ' <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<a href="" data-username="'+username+'" data-action="add" title="Suivre '+username+'"  id="aboact" onclick="return false;">Suivre</a>';
      }

      // suppression d'un abonnement depuis la page abonnés/abonnement

      else if ($('#actionabo'+username+'').length > 0) {

        // si la variable suivante existe cela veut dire que' l'on ait sur la page abonnement

          if($('#nbabonnement').length > 0)
        {

          var nbabonnement = document.querySelector('#nbabonnement').innerText; // on récupère le nombre d'abonnement actuel

          nbabonnement--; // on diminue le nombre de demande d'abonnement sur la page des abonnements

          if(nbabonnement != 0) // mise à jour de l'affichage du nombre d'abonnements si il est supérieur à zzéro
        {

          document.querySelector('#nbabonnement').textContent = '' + nbabonnement +'';

        }
          else
        {
          document.querySelector('#nbabo').textContent = 'Aucun abonnement actif à afficher.'; // plus d'abonnement
        }

          $( '.liste_abo[data-username="' + username + '"]' ).remove(); // on efface la personne supprimée de l'affichage
        }

        //on est sur la page abonnés dinc lise à jour du lien
        else {

            document.querySelector('#actionabo'+username+'').innerHTML = '<span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<a href="" data-username="'+username+'" data-action="add" title="Suivre '+username+'" type="button"  id="aboact" onclick="return false;">Suivre</a>';
        }
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

        // annuler un abonnement

     else if( action = 'deleterequest')

        {

              $.ajax({
                url: '/instatux/abonnement/delete/'+ username +'',
    success: function(data){

      if(data == 'removerequest'){

        //envoi notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Demande annulée</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

          //si je supprime un abonnement depuis un profil, mise à jour des boutons

        document.querySelector('#actionabo').innerHTML = ' <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<a href="" data-username="'+username+'" data-action="add" title="Suivre '+username+'"  id="aboact" onclick="return false;">Suivre</a>';

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
