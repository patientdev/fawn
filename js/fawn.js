//Drop-downs
$('.drop-down').click(function() { 
	var topOfDiv = $('h5', $(this)).offset().top;
	var bottomOfVisibleWindow = $(window).height();

	$('ul', $(this)).css('max-height', bottomOfVisibleWindow - topOfDiv - 100).slideToggle('fast'); 
})

$('.drop-down li').click(function() {
	$(this).parent().prev().text($(this).text());
});