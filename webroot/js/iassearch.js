              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin des résultats"}));
  ias.extension(new IASPagingExtension());