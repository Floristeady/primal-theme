jQuery(function ($) {
	
	/************************* 
	Variables (tama�os editables)
	**************************/
	
	var browserwidth;
	var largewidth = 1024; // resoluci�n m�nima desktop
	var mediumwidth = 767; // resoluci�n mmedia
	var smallwidth = 641; // resoluci�n chica
	
	/************************* 
	Ejecuci�n
	**************************/
	
	// Obtiene anchura del browser 	
	function getbrowserwidth(){
		browserwidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0;
		//console.log(browserwidth);
		return browserwidth;
	}
	
	function onLoadAndResize(){  
		getbrowserwidth();
		homeGallery();
	}
	
	function homeGallery() {  
		
		$('#home-gallery').flexslider({
		    animation: "fade",
		    animationLoop: true,
		    controlNav: false,
		    directionNav: true,
		    smoothHeight: true,
		    start: function(slider){
			     $('#home-gallery .inner').animate({
				   opacity: 1 
			    });
			    
			    if (!('.flexslider ul.slides li:only-child')){
				     $('#home-gallery .inner').delay(500).animate({
					   opacity: 1 
				    }, 400);
			    } else {
				      $('#home-gallery .inner').delay(700).animate({
					   opacity: 1 
				    }, 400);

			    }
		    }
		});
	}


	/************************* 
	Ejecuci�n
	**************************/

	$(window).load(function() {
	   onLoadAndResize();
	});

	$(window).resize(function(){
		onLoadAndResize();
	});
	
	// si tiene foundation
	//$(document).foundation({});

});
