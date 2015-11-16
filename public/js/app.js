$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 70
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar',
    offset: 75
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});


var cbpAnimatedHeader = (function() {

	var docElem = document.documentElement,
		header = $('.navbar-default'),
		didScroll = false,
		changeHeaderOn = 100;

	function init() {
		window.addEventListener('scroll', function( event ) {
			if(!didScroll) {
				didScroll = true;
				setTimeout( scrollPage, 150 );
			}
		}, false);
	}

	function scrollPage() {
		var sy = scrollY();
		if (sy >= changeHeaderOn) {
			header.addClass('navbar-shrink');

			setTimeout(function() {
				header.addClass('navbar-shrink-scroll');
			},300)
		}
		else {
			header.removeClass('navbar-shrink');
			header.removeClass('navbar-shrink-scroll');
			setTimeout(function() { // redundancy check
				header.removeClass('navbar-shrink-scroll');
			},300)
		}
		didScroll = false;
	}

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	init();

})();