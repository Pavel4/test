jQuery(document).ready(function($){

	$('.head-nav .menu').slicknav({label: '' , prependTo: '.head-top .container'});
	$('.head-nav ul li').hover(function(){
		$('.sub-menu:first',this).stop(true,true).slideDown('fast');
	},
	function(){
		$('.sub-menu:first',this).stop(true,true).slideUp('fast');
	});

	function head_margin() {
		//$('.head-logo').css('margin-top',$('.head-top').outerHeight());
	}

	$(window).bind('scroll', function () {
			
		    if ($(window).scrollTop() > 0) {
		        $('.head-top').css('position','fixed');
		    } else  {
		        $('.head-top').css('position','relative');
		    }
		});

	function window_size() {
		var win = $(window).width();

		return win;
	}

	//head_margin();

	$('.home_slider').imagesLoaded( function() {

		var win = window_size();
		var w = win;
		
		if (win<=960 && win > 767) {
			w = win / 2;
		}
		else if (win<=767) {
			w = win;
		}
		else if (win>767) {
			w = win / 4;
		}

	  $('.home_slider').flexslider({
	    animation: "slide",
	    animationLoop: true, 
	    itemWidth: w,
	    maxItems: 4,
	    minItems: 1,
	    controlNav: false,
	    move: 1,
	    after: function(){
	    	if (win == 768) {
	    		$('.home_slider').height(300);
	    	};
	    	var slider1 = $('.home_slider').data('flexslider');
			slider1.resize();
	    }
	  });
	});


	

	$(window).resize(function(){
		//head_margin();
		window_size();
	});

})