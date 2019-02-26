$(document).ready(function(){
	
  	$(window).resize(function(){

     
      if($(this).width()>320 && $(this).width()<767)
    {
          $('.col-md-3').insertBefore('.col-md-5');   
		}else{
    			$('.col-md-5').insertBefore('.col-md-3');  
    }
    })
    

		
})