
	$(document).ready(function() {
    $('#notifmess').change(function(){
    	var notifmessage = $('#notifmess').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_message',
                data: {'notifmessage' : notifmessage},
    success: function(data){
    
     $('#result_message').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_message').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});

// notif cite
	$(document).ready(function() {
    $('#notifcite').change(function(){
    	var notifcite = $('#notifcite').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_cite',
                data: {'notifcite' : notifcite},
    success: function(data){
    
     $('#result_cite').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_cite').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_cite

// notif partage
	$(document).ready(function() {
    $('#notifpartage').change(function(){
    	var notifpartage = $('#notifpartage').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_partage',
                data: {'notifpartage' : notifpartage},
    success: function(data){
    
     $('#result_partage').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_partage').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_partage

// notif abo
	$(document).ready(function() {
    $('#notifabo').change(function(){
    	var notifabo = $('#notifabo').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_abo',
                data: {'notifabo' : notifabo},
    success: function(data){
    
     $('#result_abo').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_abo').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_abo

// notif comm
	$(document).ready(function() {
    $('#notifcomm').change(function(){
    	var notifcomm = $('#notifcomm').val();
        $.ajax({
                type: 'POST',
                url: '/instatux/settings-notif_comm',
                data: {'notifcomm' : notifcomm},
    success: function(data){
    
     $('#result_comm').fadeIn().html('<span class="glyphicon glyphicon-ok"></span>&nbsp;');
				setTimeout(function() {
					$('#result_comm').fadeOut("slow");
				}, 2000 );
    },
    error: function(data)
    {
        alert('fail');
    }
                
         });
    });
});
// fin notif_comm
