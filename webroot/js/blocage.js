/**
 * blocage.js
 *
 * Gestion du blocage des utilisateurs
 *
 */

 // tester si la div des bloquer est vide

  function isEmpty( el ){
      return !$.trim(el.html())
  }

$(document).on('click','#addblock',function() {

      var username = $(this).data("username"); // personne à bloquer/débloquer
      var action = $(this).data("action"); // add / delete

      // bloquer

        if (action == 'add')
      {

              $.ajax({
                url: '/instatux/blocage/add/'+ username +'',
    success: function(data){

      if(data == 'addblockok'){ // blocage réussi

// notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;' + username + ' est désormais bloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

          if(document.getElementById('block')) // je suis sur profil
        {

        document.getElementById('block').innerHTML = '<span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;<a href="#" data-username=" '+ username + '" data-action="delete" title="' + username +'"  id="addblock" onclick="return false;">Débloquer</a>'  ; // lien de déblocage
        }
          else if(document.getElementById('etatblocageabonnes')) // je suis sur abonnes.ctp
      {
        document.getElementById('etatblocageabonnes').innerHTML = '<a href="#" data-username="' + username + '" data-action="delete" title="Débloquer ' + username + '"  id="addblock" class="link_delete_abo" onclick="return false;">Débloquer</a>'  ; // lien de déblocage
      }
                              }

        else if(data == 'alreadyblock') // utilisateur déjà bloqué
      {

//notification

        $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp; ' + username + ' est déjà bloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }
        
    
    else if(data == 'probleme'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de bloquer cet utilisateur.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }



  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de bloquer cet utilisateur.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
   })
   }
   // fin bloquer

   // débloquer un utilisateur

          else if( action == 'delete')
        {

              $.ajax({
                url: '/instatux/blocage/delete/'+ username +'',
    success: function(data){



      if(data == 'deleteblockok'){ // suppression du blocage confirmé

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp; ' +username +' est désormais débloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         if(document.getElementById('block')) // si je débloque depuis le profil d'une personne
        {

        document.getElementById('block').innerHTML = '<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;<a href="#" data-username="'+username+'" data-action="add" title="Bloquer '+username+'"  id="addblock" onclick="return false;">Bloquer</a>'  ;

        }
        else if(document.getElementById('etatblocageabonnes')) // je suis sur abonnes.ctp
      {
        document.getElementById('etatblocageabonnes').innerHTML = '<a href="#" data-username="' + username + '" data-action="add" title="Bloquer ' + username + '"  id="addblock" class="link_delete_abo" onclick="return false;">Bloquer</a>'  ; // lien de déblocage
      }

        else
      {
        $( '.liste_abo[data-username="' + username + '"]' ).remove(); // supprimer une personne depuis la page utilisateur bloqué

          if (isEmpty($('#list_block'))) {

    $("#list_block").append('<div class="alert alert-info">Aucun utilisateur bloqué.</div>');

                                          }
      }
      
    }
         
    else if(data == 'probleme'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de débloquer cet utilisateur.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de débloquer cet utilisateur.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
   });
   }
   });     