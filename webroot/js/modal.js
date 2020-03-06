/**
 * modal.js
 *
 * Chargement du contenu des modal
 *
 */

$(document).ready(function()
{

//chargement de la modal tweet -> visualisation d'un tweet

$('#viewtweet').on('shown.bs.modal', function (e) {

	var link = $(e.relatedTarget); // récupération de lien

	var idtweet = link.attr("data-idtweet"); // récupération de l'attribut de lien "id tweet"

    //chargement de la modal

    $(this).find(".modal-body").load('/instatux/post/' + idtweet +'');

});

//chargement de la modal like -> visualisation de la liste des personnes aimant un tweet

$('#viewlike').on('shown.bs.modal', function (e) {

	var link = $(e.relatedTarget); // récupération de lien

	var idtweet = link.attr("data-idtweet"); // récupération de l'attribut de lien "id tweet"

    //chargement de la modal

    $(this).find(".modal-body").load('/instatux/like/' + idtweet +'');

});

// empecher le décalage du body au chargement et à la fermeture de lamodal "like"

    $('#viewlike').on('show.bs.modal', function () {
        $('#viewtweet').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

    $('#viewlike').on('hidden.bs.modal', function () {
        $('#viewtweet').css('z-index', 1041); //bring back the first modal overlay to it's normal state when 2nd modal closed
        $('body').addClass('modal-open'); // add `modal-open` class back to body when 2nd modal close so first modal will be scrollable
    });
});



