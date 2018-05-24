
    $('.emojis-plain').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');



              var ias = jQuery.ias({
  container:  '#list_comm',
  item:       '.comm',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin des commentaires"}));
  ias.extension(new IASPagingExtension());


      $(document).ready(function(){

  // effacer commentaire

      $(".deletecomm").click(function() {

      var idcomm = $(this).data("idcomm");
    

              $.ajax({
                url: '/instatux/commentaire/delete/'+ idcomm +'',
    success: function(data){



      if(data == 'suppcommok'){ // suppression réussi

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Commentaire supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         $( '.comm[data-idcomm="' + idcomm + '"]' ).remove();// suppression du comm de la div
    }
        else if(data == 'suppcommfail'){ 


     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

      // autoriser/desactiver comm

      $(document).on('click','.allowcomm',function() {

      var idtweet = $(this).data("idtweet");
      var etat = $(this).data("etat");

              $.ajax({
                url: '/instatux/allowcomment/'+ etat +'/'+ idtweet +'',
    success: function(data){



      if(data == 'commdesac'){ // commentaire désactivé

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Les commentaires sont désormais désactivés.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="0" data-idtweet = "' + idtweet +'"   title="Activer les commentaires"  class="allowcomm" onclick="return false;">Activer les commentaires</a>'  ; // mise à jour  : ajout du lien activé comm
    }
        else if(data == 'commac'){ // commentaire activé


     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Commentaire activé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="1" data-idtweet = "' + idtweet +'"   title="Désactiver les commentaires"  class="allowcomm" onclick="return false;">Désactiver les commentaires</a>'  ; // mise à jour  : ajout du lien désactivé comm
    
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
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});


    }); 

