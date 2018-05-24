  $( function() {
    $( "#tabs" ).tabs();
  } );

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
	$(document).ready(function() {
// gestion des notifications
        // notif de message
    $('#notifmess').change(function(){
    	var notifmessage = $('#notifmess').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_message',
                data: {'notifmessage' : notifmessage},
    success: function(data){
    
     $('#result_message').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_message').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});

// notif cite
	$(document).ready(function() {
    $('#notifcite').change(function(){
    	var notifcite = $('#notifcite').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_cite',
                data: {'notifcite' : notifcite},
    success: function(data){
    
     $('#result_cite').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_cite').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_cite

// notif partage
	$(document).ready(function() {
    $('#notifpartage').change(function(){
    	var notifpartage = $('#notifpartage').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_partage',
                data: {'notifpartage' : notifpartage},
    success: function(data){
    
     $('#result_partage').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_partage').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_partage

// notif abo
	$(document).ready(function() {
    $('#notifabo').change(function(){
    	var notifabo = $('#notifabo').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_abo',
                data: {'notifabo' : notifabo},
    success: function(data){
    
     $('#result_abo').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_abo').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_abo

// notif comm
	$(document).ready(function() {
    $('#notifcomm').change(function(){
    	var notifcomm = $('#notifcomm').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_comm',
                data: {'notifcomm' : notifcomm},
    success: function(data){
    
     $('#result_comm').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_comm').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_comm
// fin gestion des notifications


// gestion des infos utlisateurs
$(document).on('click','#setupprofil',function() {

      var action = $(this).data("action");

              $.ajax({
                url: '/instatux/settings/'+ action +'',
    success: function(data){



      if(data == 'profilpublicok'){ // profil devenu public avec succès

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Votre profil est désormais public.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('etatprofil').innerHTML = '<p class="text-success"><br />Tous le monde peut voir vos publications.<br /><br />Les demandes d \'abonnement seront acceptés automatiquement.</p><div class="text-center"><a href="#"  data-action="prive" title="Rendre mon profil privé"  id="setupprofil" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Rendre mon profil privé</a></div>';

    }
        else if(data == 'profilpriveok'){ // profil devenu privé avec succès


     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Votre profil est désormais privé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('etatprofil').innerHTML = '<p class="text-danger"><br />Seules vos abonnés voient vos publications.<br /><br />Vous pouvez choisir d\'accepter ou non une demande d\'abonnement.</p><div class="text-center"><a href="#"  data-action="public" title="Rendre mon profil public"  id="setupprofil" class="btn btn-success" onclick="return false;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Rendre mon profil public</a></div>'  ;
    
}
    else if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre profil.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }



  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de mettre à jour votre profil.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

// fin mise à jour du profil -> public/privé

// mise à jour description

    $('#form_desc').submit(function(e){

      e.preventDefault();

        $.ajax({
                type: 'POST',
                url: '/instatux/settings/description',
                dataType: 'json',
                data: $('#form_desc').serialize(),
    success: function(data){ // data.avatar_session
    
 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Description mise à jour.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('user_description').innerHTML = '<br />' + data.description + ''  ; // mise à jour  : ajout du lien désactivé comm
$('#description').val('');

    },
    error: function(data)
    {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre description.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );     
    }
                
         });
    });

// fin mise à jour description

// mise à jour localisation

    $('#form_lieu').submit(function(e){

      e.preventDefault();

        $.ajax({
                type: 'POST',
                url: '/instatux/settings/lieu',
                dataType: 'json',
                data: $('#form_lieu').serialize(),
    success: function(data){ // data.avatar_session
    
 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Lieu mis à jour.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('user_lieu').innerHTML = '<li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp; ' + data.lieu +'</li>'  ; // mise à jour  : ajout du lien désactivé comm
$('#lieu').val('');

    },
    error: function(data)
    {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre localisation.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );     
    }
                
         });
    });

// fin mise à jour localisation

// mise à jour site web

    $('#form_website').submit(function(e){

      e.preventDefault();

        $.ajax({
                type: 'POST',
                url: '/instatux/settings/website',
                dataType: 'json',
                data: $('#form_website').serialize(),
    success: function(data){ // data.avatar_session
    
 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Site web mis à jour.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('user_website').innerHTML = '<li><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;<a href=" ' + data.website +'" target="_blank"> ' + data.website +'</a></li>'  ; // mise à jour  : ajout du lien désactivé comm
$('#website').val('');

    },
    error: function(data)
    {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre site web.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );     
    }          
         });
    });


// fin mise à jour site web

// mise à jour avatar

    $('#form_avatar').submit(function(e){

      e.preventDefault();

      var formdatas = new FormData($('#form_avatar')[0]);

      var reg = new RegExp("avatars"); // regex utlisé pour voir si la réponse contient le mot avatar

        $.ajax({
                type: 'POST',
                contentType: false,
                url: '/instatux/settings/avatar',
                data: formdatas,
                processData: false,
    success: function(data){ // data.avatar_session

      var resultat = reg.test(data);

      if(resultat)
      {
    

 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Avatar mis à jour.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('user_avatar').innerHTML = '<img src="http://localhost/instatux/img/' +data+ '" alt="image utilisateur" class="img-circle" max-width="100%" width="128" height="auto">'  ; // mise à jour  : ajout du lien désactivé comm

}
else
{
       $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;&nbsp;' + data + '</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

}

    },
    error: function(data)
    {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors de la mise à jour de votre avatar.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );     
    }          
         });
    });

// fin mise à jour avatar
//fin gestion infos utlisateurs