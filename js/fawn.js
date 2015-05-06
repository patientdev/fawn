//Drop-downs
$('.drop-down').focus(function() { 
	var topOfDiv = $(this).offset().top;
	var bottomOfVisibleWindow = $(window).height();
	var topScroll = $(window).scrollTop();

	$('ul', $(this)).css('max-height', (bottomOfVisibleWindow + topScroll) - topOfDiv - 100).slideToggle('fast'); 
})

$('.drop-down').blur(function() {
	$('ul', $(this)).slideToggle('fast');
});

$('.drop-down li').click(function() {
	$(this).parent().prev().text($(this).text());
});