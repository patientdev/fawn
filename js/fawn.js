$(function() {
	//Drop-downs
	$('.drop-down').click(dropDownClick);
});

function dropDownClick() {
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
		$('body').removeClass('stop-scrolling');

		$(this).unbind('blur');
	});

	$('.drop-down li').unbind('click');
	$('.drop-down li').click(function() {
		text = $(this).text();
		ul = $(this).parent();
		section = $(this).parents('.drop-down').find('.drop-down-input:first').attr('placeholder')

		ul.prev().text(text);
		ul.slideDown('fast');

		input = ul.next();
		input.val(text);

		if ( $(this).hasClass('other') ) {
			other = '<input class="other" type="text" name="location[]" placeholder="Other ' + section + 's ...">';
			$(this).parents('.drop-down').replaceWith(other);
		}
	});
}