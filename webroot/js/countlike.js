
$('.link_like').click(function(event) {
   event.preventDefault();

var id = $(this).data('value');
 
$.ajax({
    type: "GET",
    url: '/instatux/like-'+id +'',
    success: function(data){
         $('#compteur_like-' +id +'')
            .html(data);
          
    },
    error: function(data)
    {
        alert('fail');
    }
});
}); 
