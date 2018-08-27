// marquer les notifications comme lues
    $("#allnotiflue").click(function(){

              $.ajax({
                url: '/instatux/notifications/all',
    success: function(data){

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Toutes les notifications sont marquées comme lues.</span></p>');
        setTimeout(function() {
          $('#etatnotif').fadeOut("slow");
        }, 2000 );
$('.notif_non_lu').toggleClass("notif_lu");
    },
    error: function(data)
    {
        $('#etatnotif').prepend('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de marquées toutes les notifications comme lues.</span></p>');    
    }
                
         });

    });
// fin marquer les notifications comme lues

              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.notif_lu, .notif_non_lu',
  pagination: '#pagination',
  next:       '.next'
});

// infinite ajax scroll
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des notifications"}));
  ias.extension(new IASPagingExtension());
// fin infinite ajax scroll

// suppression de notifications une par une

 $(document).on('click','.deletenotif',function() {

      var idnotif = $(this).data("idnotif"); // identifiant de la notifi

      var className = $(this).parents( "div" ).attr('class'); // récupération de la class de la div parente du lien
    

              $.ajax({
                url: '/instatux/notification/delete/'+ idnotif +'',
    success: function(data){



      if(data == 'suppok'){ // suppression réussi

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Notification effacée.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );


          $('.' + className +'[data-idnotif="' + idnotif + '"]').remove(); // suppression de la notif
        

    }
        else if(data == 'probleme'){ 


     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette notification.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette notification ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

// fin suppression de notifications une par une

// suppression de toutes les notifications
$("#alldeletenotif").click(function(){

              $.ajax({
                url: '/instatux/notifications/deleteall',
    success: function(data){

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Toutes les notifications ont été supprimées.</span></p>');
        setTimeout(function() {
          $('#etatnotif').fadeOut("slow");
        }, 2000 );

        $("#list_tweet").empty();

    },
    error: function(data)
    {
        $('#etatnotif').prepend('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimées toutes les notifications.</span></p>');    
    }
                
         });

    });
// fin suppression de toutes les notifications