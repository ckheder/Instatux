
$(document).on('click','.link_like',function() {

var id = $(this).data('value');
 
$.ajax({
    url: '/instatux/like-'+id +'',
    success: function(data){
         $('#compteur_like-' +id +'')
            .html(data);
          
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
