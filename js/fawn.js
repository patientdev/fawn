//Drop-downs
$('.drop-down').click(function() { 
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

	$('body').addClass('stop-scrolling');

	$(this).focus();

	$('.drop-down').blur(function() {
		$('ul', $(this)).slideUp('fast');
		$(this).unbind('blur');
		$('body').removeClass('stop-scrolling');
	});
})

$('.drop-down li').click(function() {
	$(this).parent().prev().text($(this).text());
	$(this).parent().slideDown('fast');

	if ( $(this).hasClass('other') ) {
		$(this).parents('.drop-down').next('input.other').css('display', 'inline');
	}
});