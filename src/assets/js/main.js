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
	$('[modal-close], .modal').on('click', function(e)  {
		var targeted_modal_class = $(this).attr('modal-close');
		$('[modal="' + targeted_modal_class + '"]').fadeOut(350);
		e.preventDefault();
	});

	$('.modal').click(function() {
		$(this).fadeOut(350);
	});

	// Form Validation
	$('form').validate();

});