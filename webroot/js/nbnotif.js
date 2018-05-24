var auto_refresh = setInterval(
  function ()
  {
    $('#count_nb_notif').load('/instatux/notifications/count').fadeIn("slow");
  }, 10000);