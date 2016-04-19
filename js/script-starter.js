jQuery(function ($) {
	
	/************************* 
	Variables (tamaños editables)
	**************************/
	
	var browserwidth;
	var largewidth = 1024; // resolución mínima desktop
	var mediumwidth = 767; // resolución mmedia
	var smallwidth = 641; // resolución chica
	
	var mywindow = $(window);
	var htmlbody = $('html,body');
	
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
		getbrowserwidth();
		homeGallery();
		
		if(browserwidth <= mediumwidth ) {
	       menuMobile();
	    }
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

	//scrollto section
	function menuHome() { 
		
		//si es el home		
		var links = $('.menu-main > .menu > li > a, .menu-header a');
	    var target = $(links).attr("href");
				
		// go to scroll section 
	    function goToByScroll(target) {
	        htmlbody.animate({
	         scrollTop: $(target).offset().top+5
	         }, 1500, 'easeInOutQuint');
	         
	        if(browserwidth <= mediumwidth) {
	        	$('#inner-wrap').removeClass('active');
				$('#mobile-access').removeClass('active');
				$('body').removeClass('open-drawer');
				//console.log(target);
		    } 
	    }
	
		// link animation to section
	    links.click(function (e) {
	        e.preventDefault();
	        target = $(this).attr('href');
	        goToByScroll(target);
	    });
  			  
	}
	
	function menuPages() {
		
		//Menu pages 
		var _href = $('.menu-main > .menu > li > a, .menu-header a');
		var page = $("html, body");
		
		$(_href).each(function() {
		   _href = $(this).attr("href"); 
		   $(this).attr("href",'/'+ _href);  
		   
		   if(browserwidth <= mediumwidth) {
	        	$('#inner-wrap').removeClass('active');
				$('#mobile-access').removeClass('active');
				$('body').removeClass('open-drawer');
		    }
		});
		
	    var jump=function(e) {
	       if (e){
	           e.preventDefault();
	           var target = $(this).attr("href");
	       } else {
	           var target = location.hash;
	       }
	       
	       page.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function(){
		       page.stop();
		    });
		    
		    page.animate({ 
			    scrollTop: $(target).offset().top }, 1000, function(){
				    location.hash = target;
					page.off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove");
			});
	
	    }
	
	    page.hide();
	    
        $('a[href^=#]').bind("click", jump);

        if (location.hash){
            setTimeout(function(){
                $('html, body').scrollTop(0).show()
                jump()
            }, 0);
        }else{
          page.show()
        }

	}
	
	function menuMobile(){

    	$(document).off('click', '#button-mobile').on('click', '#button-mobile',function(e) {
	        allowSubmit = true;
           $('#mobile-access').addClass('active');
           $('#inner-wrap').addClass('active');
           $('body').addClass('open-drawer');
          
           addEventListener('touchmove', function(e) { 
            if (allowSubmit) {
              //e.preventDefault(); 
           }
	        }, true);
	    }); 
      
	    $('#nav-close-btn, .drawer-close').bind('click focus', function(e){ 
	        allowSubmit = false;
	        $('#inner-wrap').removeClass('active');
	        $('#mobile-access').removeClass('active');
	        $('body').removeClass('open-drawer');
	        e.preventDefault();
	    }); 
	  
	}

	/************************* 
	Ejecución
	**************************/

	$(window).load(function() {
	   onLoadAndResize();
	   
	   if ($('body').hasClass('home')) {	
			menuHome();
		} else {
			menuPages();
		}
		
	});

	$(window).resize(function(){
		onLoadAndResize();
	});
	
	// si tiene foundation
	//$(document).foundation({});

});
