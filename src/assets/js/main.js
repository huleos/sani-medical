$(function() {
		///////////
	 // Modal //
	///////////

	// Open
	// $('[modal-open]').on('click', function(e)  {
	// 	var targeted_modal_class = $(this).attr('modal-open');
	// 	$('[modal="' + targeted_modal_class + '"]').fadeIn(350);
	// 	e.preventDefault();
	// });

	// Close
	// $('[modal-close], .modal').on('click', function(e)  {
	// 	var targeted_modal_class = $(this).attr('modal-close');
	// 	$('[modal="' + targeted_modal_class + '"]').fadeOut(350);
	// 	e.preventDefault();
	// });
	
	// Open
	$('[modal-open]').click(function()  {
		var targeted_modal_class = $(this).attr('modal-open');
		$('[modal="' + targeted_modal_class + '"]').fadeIn(350);
	});

	// Close
	$('[modal-close]').click(function()  {
		var targeted_modal_class = $(this).attr('modal-close');
		$('[modal="' + targeted_modal_class + '"]').fadeOut(350);
	});

	$('.modal, .modal-container').click(function() {
		$(this).fadeOut(350);
	});

	// Form Validation
	$('form').validate();

});