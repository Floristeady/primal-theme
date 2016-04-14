jQuery(function ($) {
	
	/************************* 
	Variables (tamaños editables)
	**************************/
	
	var browserwidth;
	var largewidth = 1024; // resolución mínima desktop
	var mediumwidth = 767; // resolución mmedia
	var smallwidth = 641; // resolución chica
	
	/************************* 
	Ejecución
	**************************/
	
	// Obtiene anchura del browser 	
	function getbrowserwidth(){
		browserwidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0;
		//console.log(browserwidth);
		return browserwidth;
	}
	
	function onLoadAndResize(){  
	
	}


	/************************* 
	Ejecución
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
