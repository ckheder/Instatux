$(document).on('click','#addblock',function() {

      var username = $(this).data("username"); // personne à bloquer/débloquer
      var action = $(this).data("action");

      // bloquer

      if (action == 'add')

      {

              $.ajax({
                url: '/instatux/blocage/add/'+ username +'',
    success: function(data){



      if(data == 'addblockok'){ // blocage réussi

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;' + username + ' est désormais bloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('block').innerHTML = '<a href="#" data-username="' + username + '" data-action="delete" title="Débloquer ' + username + '"  id="addblock" class="btn btn-success" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span></a>'  ; // lien de déblocage
    }

        else if(data == 'alreadyblock'){

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

   else if( action = 'delete')
        {

              $.ajax({
                url: '/instatux/blocage/delete/'+ username +'',
    success: function(data){



      if(data == 'deleteblockok'){ // suppression du blocage confirmé

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp; ' +username +' est désormais débloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         if(document.getElementById('block')) // si je débloque depuis le profil d'une personne
{

        document.getElementById('block').innerHTML = ' <a href="#" data-username="' + username + '" data-action="add" title="Bloquer' + username + '"  id="addblock" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-ban-circle"></span></a>'  ; // mise à jour  : ajout du lien activé comm
    }

 else
{
  $( '.tweet[data-username="' + username + '"]' ).remove(); // delete le truc
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