// effacer un commentaire
 $(document).on('click','.deleteconv',function() {

      var conv = $(this).data("conv"); // identifiant du comm

      var nb_conv = $('#nb_conv').text(); // nombre de conversations
    

              $.ajax({
                url: '/instatux/conversation/delete/'+ conv +'',
    success: function(data){



      if(data == 'suppconvok'){ // suppression réussi

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Conversation supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        $('.tweet[data-conv="' + conv + '"]').remove(); // suppression de la conv

         nb_conv --;

                  $("#nb_conv").empty('').prepend(nb_conv);
        //si decrementation à zero, nouveau message + suppression des options
        if(nb_conv == 0)
        {
          $("#conv").html('<div class="alert alert-warning text-center"><strong>Aucune conversations.</strong></div>');                                            
        }

    }
        else if(data == 'suppconvfail'){ 


     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});