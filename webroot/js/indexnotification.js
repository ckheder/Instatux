$(document).ready(function(){

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
    });
// fin marquer les notifications comme lues

              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.notif_lu, .notif_non_lu',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des notifications"}));
  ias.extension(new IASPagingExtension());