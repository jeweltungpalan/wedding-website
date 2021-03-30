$(document).ready(function(){
	//Reset styles for animation	
	$('.scroll-animation').css({"opacity":0,"position":"relative"});
	$('.scroll-animation.ascend').css('top','-60px');

	//Scroll Listener
	var timeout = null;
	var nav_trigger_position=$('header').offset().top;

	$(window).scroll(function () {
	    if (!timeout) {
	        timeout = setTimeout(function () {
	            clearTimeout(timeout);
	            timeout = null;
	            animateOnScroll();
	        }, 250);
	    }
	});
	
	//Scroll To Position
	$('a[href*="#"]:not([href="#nav"])').not('.nav-close').click(function() {
    	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      		var target = $(this.hash);
      		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      		if (target.length) {      			
      			if($('header').hasClass('fixed')){
      				var destinationPosition = target.offset().top - $('header').height();
      			}
      			else{
      				var destinationPosition = target.offset().top - 105;
      			}			
						        
		        $('html,body').animate({
		          scrollTop: destinationPosition
		        }, 1000);
		        
		        
		        return false;
      		}
    	}
  	});

  	//Mobile Nav
  	if(location.hash == '#nav'){
  		$('.nav-open').css('opacity',0);
  	}
  	$('.nav-open').click(function(e){
  		$(this).css('opacity',0);
  		$('nav.close').show();
  		$('header').css('background','#FFFFFF');
  	});
  	$('.nav-close').click(function(e){
  		$('.nav-open').css('opacity',1);
  		$('nav.hide').hide();
  		$('header').css('background','rgba(255,255,255,0.9');
  	});

  	//Show/Hide certain elements
    $('.button-toggle').click(function(e){
        $('.button-toggle').not(this).removeClass('current');
        $(this).addClass('current');
        var classToShow = $(this).data('filter-value');

        $('.toggle-visibility.invisible' + classToShow).css({"opacity":1,"position":"static"}).fadeIn("slow");
        $('.toggle-visibility.hidden' + classToShow).fadeIn("slow");
        $('.toggle-visibility').not(classToShow).fadeOut("slow");
    });

    //Form submit validation
	$('.form-submit').click(function(event) {
		console.log('test');
		event.preventDefault();
		var parentForm = $(this).closest('form');
	
		$('.notification').remove();
	
		var validata;
		var proceed = true;
		
		
		//if form validates successfully, submit data
		$(parentForm).find('.field').each(function() {
			var field = this;
			
			validata = fieldValidate(field, proceed);
			
			if(!validata){
				proceed = false;
			}
		});

		//check option questions
        $(parentForm).find('.option-parent').each(function() {
            var optionQuestion = this;
            
            validata = optionValidate(optionQuestion, proceed);
            
            if(!validata){
                proceed = false;
            }
        }); 
		
		if(validata == true){
			parentForm.submit();
		}
		else{
			if($('.notification').length < 1){
				$(parentForm).before('<p class = "notification error">Please correct the errors highlighted below</p>');
			}
		}		
	});
    
    //Reset previously set border colors and hide all message on .keyup()
   	$('form .field').keyup(function() { 
		$(this).siblings('.feedback').hide();
		$(this).removeClass('invalid');		
				
		$('.notification').remove();
    });

    $('form select').change(function() { 
		$(this).siblings('.feedback').hide();
		$(this).removeClass('invalid');		
				
		$('.notification').remove();
    });		

   	//Popup action
   	$('.popup-close').click(function(e){
   		$('.overlay').fadeOut();
   		$('.popup-wrapper').fadeOut();
   	});

   	//View on map
   	$('.link-map a').click(function(){
   		var lat=$(this).attr('data-lat');
   		var lon=$(this).attr('data-lon');
   		var map=$('.map iframe').attr('src').replace(/&z=.*/,'&z=20');
   		var destinationPosition=$('.map').offset().top - $('header').height();

        $('.toggle-visibility.map').css({"opacity":1,"position":"static"}).fadeIn("slow");
        $('.toggle-visibility.tiles').fadeOut("slow");
        $('.map iframe').attr('src', map + '&ll=' + lat + ',' + lon);
        $('.button-toggle[data-filter-value=".map"]').addClass('current');
        $('.button-toggle[data-filter-value=".tiles"]').removeClass('current');

        $('html,body').animate({
          scrollTop: destinationPosition
        }, 1000);
   	});

   	//Send STD
   	$('#sendstd').click(function(e){
   		if($('.householdtosend:checked').length == 0){
   			alert('Please check at least one household!');
   		}
   		else{
   			$('.householdtosend:checked').each(function(){
	   			var id=$(this).val();

	   			$.post(
	   				'functions/email_std.php', 
	   				{id:id},
	   				function(response){
	   					if(response=='error'){
	   						alert('Electronic save-the-date has been sent to the household already!');
	   					}
	   					else{
	   						alert('Electronic save-the-date has been sent successfully!');
	   					}
	   				}
	   			);
	   		});
   		}   		
   	});

  	function animateOnScroll(){
		var window_height=$(window).height();
		var bottom_of_window=$(window).scrollTop() + window_height;

		if($(window).scrollTop() > nav_trigger_position && $(window).scrollTop() <= $('.footer-cta').offset().top){
	        $('header').fadeIn(200).addClass('fixed');
	    }
	    else{
	    	$('header').removeClass('fixed');
	    }

	    $('.scroll-animation').each(function(i){
	    	if(window.outerHeight <= $(this).outerHeight){
	    		var middle_of_object=$(this).offset().top + $(this).outerHeight() * 0.75;
	    	}
	    	else{
	    		var middle_of_object=$(this).offset().top + $(this).outerHeight() * 0.2;
	    	}
	        
	        if(bottom_of_window > middle_of_object){
	        	if($(this).hasClass('ascend')){
	        		$(this).stop().animate({opacity:1, top:0},'slow');
	           	}
	        }
	    });
	}

	/**
	* Validates all fields
	* @param {Object} field
	* @param {bool} proceed, flag variable
	* @return {bool} proceed, false if there's an invalid input
	*/
	function fieldValidate(field, proceed){
		var value = $(field).val();
		value = $.trim(value);
		var feedback;
					
		// check if required fields are filled out
		if(value == ''){
			if ($(field).hasClass('req')){			
				$(field).addClass('invalid');
				proceed = false;
			}
		}
		// check if a valid value
		else{
			if($(field).hasClass('email')) {
				if(!validateEmail(value)){
					$(field).addClass('invalid');
					proceed = false;
					$(field).siblings('.feedback').show();
					$(field).siblings('.feedback').text('Please enter a valid email address');
				}
			}

			if($(field).hasClass('numeric')) {
				var min = $(field).attr('min');

				if(value < min){
					$(field).addClass('invalid');
					proceed = false;
					$(field).siblings('.feedback').show();
					$(field).siblings('.feedback').text('Please enter a valid number.');
				}
			}
		}	
		
		return proceed;
	}

	/**
	* Check if valid email
	* @param {Object} field
	*/
	function validateEmail(field){
	    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	    if (filter.test(field)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}

	// checks if a least one of the radio buttons is selected
	function optionValidate(optionQuestion, proceed){
	    if($(optionQuestion).find('.option:checked').length == 0){
	        proceed = false;    
	        $(optionQuestion).find('.feedback').show();
	        $(optionQuestion).find('.feedback').text('Please pick an option below.');
	    }
	    
	    return proceed;
	}
});