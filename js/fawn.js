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