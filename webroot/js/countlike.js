// gestion des like

// ajouter/supprimer un like
$(document).on('click','.link_like',function() {

var id = $(this).data('value'); // id du tweet

var nb_like = $('#compteur_like-' + id +'').text();//compteur à mettre à jour

$.ajax({
    type: 'POST',
    url: '/instatux/like',
    dataType: "json",
    data: {id: id, nb_like: nb_like},
    success: function(data){

      // ajout/suppression de portrait

               if ($('#list_like').length > 0) { // je suis sur view

   //ajout

   if(data.action == 'add') // on ajoute mon avatar au début de la liste
   {
    $('#list_like').prepend('<a href="./'+ data.authname+'" data-username ="'+data.authname +'" title="Voir le profil de '+ data.authname+'"><img src="/instatux/img/avatar/'+ data.authname+'.jpg" alt="image utilisateur" class="img-circle vcenter likepic"></a>');
    $('#compteur_like-' + id+'').empty('').prepend(' ' + data.nb_like + ''); // mise à jour du nombre de like sur index.ctp
   }
   else if(data.action == 'delete')
   {
    $( 'a[data-username="' + data.authname + '"]' ).remove();
    $('#compteur_like-' + id+'').empty('').prepend(' ' + data.nb_like + ''); // mise à jour du nombre de like sur index.ctp
   }

}
else // je suis sur index
{
  $('#compteur_like-' + id+'').empty('').prepend(' ' + data.nb_like + '');
}    
         $('#compteur_like_view-' + id +'').html(data.nb_like);  // mise à jour du nombre de like sur view.ctp        
    },
    error: function(data)
    {
              $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de liker ce contenu.</span></p>');
      setTimeout(function() {
      $('.notif').fadeOut("slow");
        }, 2000 );
    }
});
}); 
