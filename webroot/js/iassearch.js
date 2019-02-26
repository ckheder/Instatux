

     var ias = jQuery.ias({
  container:  '#list_search',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des résultats"}));
  ias.extension(new IASPagingExtension());