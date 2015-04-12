
//Parallax
$(window).scroll(function() {

	$parallax = 0;
	$windowScroll = $(window).scrollTop();

	if ( $windowScroll <= 0 ) { $parallax = 0; }
	else { $parallax = $windowScroll/5; }

	$('header').css('background-position', '0 ' + $parallax + 'px');

})

//Drop-downs
$('.drop-down').click(function() { $('ul', $(this)).slideToggle('fast'); })
$('.drop-down li').click(function() {
	$(this).parent().prev().text($(this).text());

	//Auto-submit search with selected parameters
	if ( $('#search-occupation h5').text() != 'Occupation' && $('#search-cause h5').text() != 'Cause' && $('#search-location h5').text() != 'Location') {
		
		$occupation = $('#search-occupation h5').text();
		$cause =  $('#search-cause h5').text();
		$location =  $('#search-location h5').text();
		$('<form action="/search/" method="POST">' + 
    		'<input type="hidden" name="occupation" value="' + $occupation + '">' +'<input type="hidden" name="cause" value="' + $cause + '">' +'<input type="hidden" name="location" value="' + $location + '">' +
    		'</form>').submit();
	}
})