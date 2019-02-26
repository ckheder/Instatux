              var ias = $('#viewtweet').ias({
  container:  '#list_comm',
  item:       '.comm',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "test"}));