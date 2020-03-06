/**
 * messagerie.js
 *
 * Gestion de l'envoi de message : profil, index messagerie
 *
 */

 //emoji

    $('.emojis-plain').emojiarea({wysiwyg: false});

    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});

    var $wysiwyg_value = $('#emojis-wysiwyg-value');

    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');

  //envoi de message

  $('#new_message').submit(function(e){

      e.preventDefault();

      // test destinataire vide

          if ($.trim($('#autocomplete').val()).length = 0)
        {

// notification destinataire vide

          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Destinataire non renseigné.</span></p>');

        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // vidage de l'autocomplete

        $('#autocomplete').val('');

        return false;

        }

      // test message vide

            if ($.trim($('#textarea_message').val()).length = 0)
          {

// notification message vide

            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Votre message est vide.</span></p>');

            setTimeout(function() 
          {
            $('.notif').fadeOut("slow");
          }, 2000 );

// vidage du textarea

        $('#textarea_message').val('');

        return false;

        }

        $.ajax({
                type: 'POST',
                url: '/instatux/message/add',
                dataType: 'json',
                data: $('#new_message').serialize(),

    success: function(data){

          if(data == 'blocage') // message non envoyé car je suis bloqué
        {

          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Message non envoyé, cet utilisateur vous à bloqué.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }

        else  // message envoyé avec succès
      {

        if(data.origin === 1) // rechargement de la div de gauche contenant mes conversations (cas de l'envoi d'un message depuis la page d'accueil de la messagerie)
      {
                
         $(".conv").load('/instatux/listconv');

         $('#autocomplete').val(''); // vidage de l'input destinataire

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

  //effacer une conversation


$(document).on('click','#deleteconv',function() {

      var idconv = $(this).data("idconv"); // identifiant de la conversation

             $.ajax({
                        url: '/instatux/conversation/delete/'+ idconv +'',
                        dataType: "text json",
                        type: "POST",
                        data: {idconv: idconv},
    success: function(data){

      if(data.reponse == 'suppconvok') // suppression de conversation réussie
    { 

      //on vide la div

      $('#displayconv').empty('').append('<div class="alert alert-danger noconv">Conversation Supprimée</div>'); 

        $(".conv").load('/instatux/listconv', function()
      {
        $(".btnnewmessage").show();
      });

    }
    
        else if(data.reponse == 'suppconvfail'){ // suppression échouée

  //notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

   })
   });

//on rejoins une conversation en cliquant dessus sur la liste des conversations de gauche

$(document).on('click','.listconv',function() {

  var idconv = $(this).attr("data-conv"); // récupération de l'identifiant de la conversation
  
  joinconv(idconv);

});

//rejoindre depuis une notification

var strContenu = localStorage.getItem("contenu"); // 

if (strContenu !== null) {

joinconv(strContenu);

    localStorage.removeItem("contenu");

}

  function joinconv(idconv)
{

  jQuery.ias().destroy();

  //chargement de la div

  $('#displayconv').load('/instatux/conversation-' + idconv +'');

}


