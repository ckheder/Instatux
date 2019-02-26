     // message envoyé depuis la modal sur cell,  et page d'accueild e la messagerie

    $('#new_message').submit(function(e){

      e.preventDefault();

      // test destinataire vide

              if ($.trim($('#autocomplete').val()).length != 0){

                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Destinataire non renseigné.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#autocomplete').val('');
       return false;
        }

      // test message vide

              if ($.trim($('#textarea_message').val()).length != 0){

                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Votre message est vide.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#textarea_message').val('');
       return false;
        }

        $.ajax({
                type: 'POST',
                url: '/instatux/message/add',
                dataType: 'json',
                data: $('#new_message').serialize(),
    success: function(data){

          if(data == 'blocage'){ // message non envoyé car je suis bloqué


     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Message non envoyé, cet utilisateur vous à bloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

    else  // message envoyé avec succès
    {

      if(data.origin === 1) // redirection parce que je viens de la page de messagerie
      {
                var url = 'http://localhost/instatux/conversation-'+ data.conv +'';
    
        window.location.href = url;
      }

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Message envoyé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#textarea_message').val(''); // vidage de la textarea
  $('#modalmessage').modal('hide'); // fermeture de la modale
}

  },
    error: function(data)
    {
 $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible d\'envoyer votre message.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

// auto completion des abonnés

if ($('#autocomplete').length > 0) {

      $(function() 
      {

    $( "#autocomplete" ).autocomplete({

source:'/instatux/abonnement/indexmessagerie',
html: true, 
        open: function(event, ui) {
          $(".ui-autocomplete").css("z-index", 1000);

        }

      })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {

        return $( "<li><div><img src='/instatux/img/avatar/"+item.value+".jpg'><span>"+item.value+"</span></div></li>" ).appendTo( ul );

      };



});
    };

