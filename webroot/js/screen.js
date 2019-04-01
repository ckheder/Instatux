$(document).ready(function(){
	
  	$(window).resize(function(){

     
      if($(this).width()>320 && $(this).width()<767) // mise en place de la colonne des suggestion au dessus des tweets
    {
          $('.col-md-4').insertBefore('.col-md-5');   
		}else{
    			$('.col-md-5').insertBefore('.col-md-4');  
    }
 
    }
    )
    

		
})

