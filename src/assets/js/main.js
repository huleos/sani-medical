$(function() {
	  ///////////
	 // Modal //
	///////////

	// Open
	$('[modal-open]').on('click', function(e)  {
		var targeted_modal_class = $(this).attr('modal-open');
		$('[modal="' + targeted_modal_class + '"]').fadeIn(350);
		e.preventDefault();
	});

	// Close
	$('[modal-close]').on('click', function(e)  {
		var targeted_modal_class = $(this).attr('modal-close');
		$('[modal="' + targeted_modal_class + '"]').fadeOut(350);
		e.preventDefault();
	});

	// $('[modal]').click(function() {
	// 	var targeted_modal_class = $(this).attr('modal');
	// 	$('[modal="' + targeted_modal_class + '"]').fadeOut(350);
	// });
	$('form').validate();

});