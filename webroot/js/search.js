/**
 * search.js
 *
 * Auto complétion pour le moteur de recherche
 *
 */

      $(function() 
      {

    $( "#search" ).autocomplete({

minLength: 1,

source:'/instatux/search/searchusers',

open: function(event, ui) {
          
  var term = $('#search').val(); 

var addnew = "<br /><li>&nbsp;<a href='/instatux/search-"+term+"'>Recherche complète pour "+term+"</a></li>";

          $(".ui-autocomplete").append(addnew);

        },

response: function(event, ui) {
  
    if (!ui.content.length) {

       var noResult = { value:"",label:"Aucun résultats" };
                   
         ui.content.push(noResult); 
                  
     }
},

      })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {

          if(item.value == '')
          {

            return $ ( "<li>&nbsp;Aucune suggestion trouvée</li>" ).appendTo( ul );
          }
          else
          {

        return $( "<li><div class=\"test\"><img src='/instatux/img/avatar/"+item.value+".jpg'>&nbsp;<a href='/instatux/"+item.value+"'>"+item.value+"</a><span class=\"alias_tweet_search\">@"+item.value+"</span></div></li>" ).appendTo( ul );
}
      };

});

