/**
 * indexnotifications.js
 *
 * Gestion des notifications sur la page des notifications
 *
 */

//fonction

// tester si la div des notification est vide

  function isEmpty( el ){
      return !$.trim(el.html())
  }

  function disableLink()
  {
    return $("#alldeletenotif, #allnotiflue").css("color","grey").removeAttr('href').off('click'); 
  }

//desactivation des 2 premiers liens si aucune notification

$(document).ready(function () {

  if ($('.nonotif').length > 0) 
{

    disableLink();
}
});

//marquer une notification comme lue

 $(document).on('click','.readnotif',function() {

      var idnotif = $(this).data("idnotif"); // identifiant de la notification

      var className = $(this).parents( "div" ).attr('class'); // récupération de la class de la div parente du lien

                   $.ajax({
                url: '/instatux/notification/read/'+ idnotif +'',
    success: function(data){

      if(data == 'ok'){ // suppression réussi

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Notification marquée comme lue.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

//affectation de la classe notif_lu

        $('.' + className +'[data-idnotif="' + idnotif + '"]').toggleClass("notif_lu");

//disparition du lien "marquer comme lue"

        $('#' + idnotif + '').remove();

    }
        else if(data == 'probleme'){

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de marquer cette notification comme lue.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de marquer cette notification comme lue.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
});
//fin marquer une notif comme lue

// marquer toutes les notifications comme lues

    $("#allnotiflue").click(function(){

              $.ajax({
                url: '/instatux/notifications/all',
    success: function(data){

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Toutes les notifications sont marquées comme lues.</span></p>');
        setTimeout(function() {
          $('#etatnotif').fadeOut("slow");
        }, 2000 );

//affectation de la classe "notif_lu" à toutes les notifications ayant la classe "notif_non_lu"

$( '.notif_non_lu' ).each(function() {
  $( this ).addClass( "notif_lu" );
});


//disparition des liens "marquer comme lue"

$('.readnotif').remove();
    },
    error: function(data)
    {
        $('#etatnotif').prepend('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de marquées toutes les notifications comme lues.</span></p>');
    }

         });

    });
// fin marquer les notifications comme lues

//Infinite Ajax Scroll des notifications

              var ias = jQuery.ias({
  container:  '#list_notif',
  item:       '.notif_lu, .notif_non_lu',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());

// fin infinite ajax scroll

// suppression de notifications une par une

 $(document).on('click','.deletenotif',function() {

      var idnotif = $(this).data("idnotif"); // identifiant de la notification

      var className = $(this).parents( "div" ).attr('class'); // récupération de la class de la div parente du lien


              $.ajax({
                url: '/instatux/notification/delete/'+ idnotif +'',
    success: function(data){

      if(data == 'suppok'){ // suppression réussi

 //notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Notification effacée.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );


// suppression de la notification

      $('.' + className +'[data-idnotif="' + idnotif + '"]').remove();

// si il n'y en as plus


  if (isEmpty($('#list_notif'))) {

    $("#list_notif").append('<div class="alert alert-info nonotif">Vous n\'avez aucune notification.</div>');

disableLink();
     
  }


    }
        else if(data == 'probleme'){

//notification

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

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Toutes les notifications ont été supprimées.</span></p>');
        setTimeout(function() {
          $('#etatnotif').fadeOut("slow");
        }, 2000 );

//vidage de la div, affichage d'un message et désactivation des liens

        $("#list_notif").empty().append('<div class="alert alert-info nonotif">Vous n\'avez aucune notification.</div>');

disableLink(); 

// affichage d'un nouveau message

        //$(".col-md-9").html('<div class="alert alert-info">Vous n\'avez aucune notification.</div>');
  


//suppression des options

        $("#optionnotif").remove();
    },
    error: function(data)
    {
        $('#etatnotif').prepend('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimées toutes les notifications.</span></p>');
    }

         });

    });
// fin suppression de toutes les notifications

//rejoindre une conversation

$(document).on('click','.joinconv',function() {

var idconve = $(this).attr("data-idconv");

localStorage.setItem("contenu", idconve);

window.location.href = '/instatux/messagerie';

});
