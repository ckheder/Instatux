// assigner la classe active au lien cliqué
$(document).ready(function() {
  // get current URL path and assign 'active' class
  var pathname = window.location.pathname;
  $('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
});

// accepter ou refuser une demande d'abonnement
    $("#accept, #refuse").each(function(){

      $(this).click(function() {

      var act = $(this).data("action"); // action choisi : accepter/refuser abonnement

      var username = $(this).data("username");

              $.ajax({
                url: '/instatux/abonnement/' + act + '/' + username +'',
    success: function(data){

      if(data == 'aboaccept'){ // abonnement accepté

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;' + username +' fais désormais parti de vos abonnés.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    else if(data == 'aborefuse'){ // abonnement refuse

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Abonnement refusé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
        else if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    $( '.tweet[data-username="' + username + '"]' ).remove();

    nbattente--; // on diminue le nombre de demande d'abonnement

document.getElementById('nbattente').innerHTML = nbattente + ' demande(s) en attente.'; // mise à jour du champs

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});
    });


