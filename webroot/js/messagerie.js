     // message envoyé depuis la modal sur cell, moteur de recherche et page d'accueild e la messagerie



    $('#new_message').submit(function(e){

      e.preventDefault();

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


        var url = 'http://localhost/instatux/conversation-' + data.conv +'';
    
        window.location.href = url;


      

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

      $(function() 
      {

    $( "#autocomplete").autocomplete({

source:'/instatux/abonnement/indexmessagerie',



})});

