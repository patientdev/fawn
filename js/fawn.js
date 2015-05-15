$(function() {
	//Drop-downs
	$('.drop-down').click(dropDownClick);

	if ( $('#menu').css('display') === "block" ) {
		$('#menu button').click(function() {
			$('#menu-options').toggle();
		});
	}
});

function dropDownClick() {
	var topOfDiv = $(this).offset().top;
	var bottomOfVisibleWindow = $(window).height();
	var distanceFromBottom = bottomOfVisibleWindow - topOfDiv;
	var topScroll = parseInt($(window).scrollTop());
	var cutoff; var leeway;

	if ( $('#actions a').css('display') == 'none') { cutoff = 300; leeway = 50; }
	else { cutoff = 400; leeway = 100; }
	if ( distanceFromBottom < cutoff ) {
		$('ul', $(this)).css({
			'bottom': 0,
			'max-height': (topOfDiv - leeway) + 'px'
		}).slideToggle('fast'); 
	}
	else { $('ul', $(this)).css('max-height', (bottomOfVisibleWindow + topScroll) - topOfDiv - leeway).slideToggle('fast'); }

	$('body').addClass('stop-scrolling');

	$(this).focus();

	$('.drop-down').blur(function() {
		$('ul', $(this)).slideUp('fast');
		$('body').removeClass('stop-scrolling');

		$(this).unbind('blur');
	});

	$('.drop-down li').unbind('click');
	$('.drop-down li').click(function() {
		
		text = $(this).text();
		ul = $(this).parent();
		ul.prev().text(text);

		if ( $('#search-occupation').length > 0 ) {
			//Auto-submit search with selected parameters
			if ( $('#search-occupation h5').text() != 'Occupation' && $('#search-cause h5').text() != 'Cause' && $('#search-location h5').text() != 'Location' ) {

				occupation = $('#search-occupation h5').text();
				cause =  $('#search-cause h5').text();
				locale =  $('#search-location h5').text();
				$('<form action="/search/" method="POST">' + 
		    		'<input type="hidden" name="occupation" value="' + occupation + '">' +'<input type="hidden" name="cause" value="' + cause + '">' +'<input type="hidden" name="location" value="' + locale + '">' +
		    		'</form>').submit();
			}
		} else if ( $('#profile-occupation').length > 0 ) {
			section = $(this).parents('.drop-down').find('.drop-down-input:first').attr('placeholder')

			ul.slideDown('fast');

			input = ul.next();
			input.val(text);

			if ( $(this).hasClass('other') ) {
				other = '<input class="other" type="text" name="location[]" placeholder="Other ' + section + 's ...">';
				$(this).parents('.drop-down').replaceWith(other);
			}
		}

	});
}