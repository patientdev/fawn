
//Parallax
$(window).scroll(function() {

	$parallax = 0;
	$windowScroll = $(window).scrollTop();

	if ( $windowScroll <= 0 ) { $parallax = 0; }
	else { $parallax = $windowScroll/5; }

	$('header').css('background-position', '0 ' + $parallax + 'px');

})

//Drop-downs
$('.drop-down').hover(function() { $('ul', $(this)).slideToggle('fast'); })