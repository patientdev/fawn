//Drop-downs
$('.drop-down').focus(function() { 
	var topOfDiv = $(this).offset().top;
	var bottomOfVisibleWindow = $(window).height();
	var distanceFromBottom = bottomOfVisibleWindow - topOfDiv;
	var topScroll = parseInt($(window).scrollTop());

	if ( distanceFromBottom < 400 ) {
		$('ul', $(this)).css({
			'bottom': 0,
			'max-height': (topOfDiv - 100) + 'px'
		}).slideToggle('fast'); 
	}
	else { $('ul', $(this)).css('max-height', (bottomOfVisibleWindow + topScroll) - topOfDiv - 100).slideToggle('fast'); }

	$('.drop-down').blur(function() {
		$('ul', $(this)).slideUp('fast');
		$(this).unbind('blur');
	});
})

$('.drop-down li').click(function() {
	$(this).parent().prev().text($(this).text());
	$(this).parent().slideToggle('fast');
});