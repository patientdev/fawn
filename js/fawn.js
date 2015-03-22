$(window).scroll(function() {

	$windowScroll = $(window).scrollTop();

	if ($windowScroll <= 0) {
		$('header').css('background-position', '0 0');
	}

	else {
		parallax = $windowScroll/5;

		$('header').css('background-position', '0 ' + parallax + 'px');
	}
})