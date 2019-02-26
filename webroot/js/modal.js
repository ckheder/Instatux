//modal view tweet
$(document).ready(function()
{

$('#viewtweet').on('shown.bs.modal', function (e) {

	var link = $(e.relatedTarget);

	var idtweet = link.attr("data-idtweet");

$(this).find(".modal-body").load('/instatux/post/' + idtweet +'');


});

$('#viewlike').on('shown.bs.modal', function (e) {

	var link = $(e.relatedTarget);

	var idtweet = link.attr("data-idtweet");

$(this).find(".modal-body").load('/instatux/like/' + idtweet +'');


});

    $('#viewlike').on('show.bs.modal', function () {
        $('#viewtweet').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

    $('#viewlike').on('hidden.bs.modal', function () {
        $('#viewtweet').css('z-index', 1041); //bring back the first modal overlay to it's normal state when 2nd modal closed
        $('body').addClass('modal-open'); // add `modal-open` class back to body when 2nd modal close so first modal will be scrollable
    });
});



