/**
 * nbnotif.js
 *
 * Actualisation du nombre de notification sur la barre de menu
 *
 */

var auto_refresh = setInterval(
  function ()
  {
    $('#count_nb_notif').load('/instatux/notifications/count').fadeIn("slow");
  }, 10000);