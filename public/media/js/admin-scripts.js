jQuery(document).ready(function($){

	$(document).on('change','.changelimit',function(e){
		$(this).parents('form').submit();
	});

	$(document).on('click','.popdelete',function(e){
		e.preventDefault();
		var __url = $(this).attr('href');
		var token = $(this).data('token');
		var question = $(this).data('question');
		console.log(__url);
		var newForm = jQuery('<form>', {
		    'action': __url,
		    'target': '_top',
		    'method': 'post'
		}).append( $('<input>', {
			'name'	: '_token',
			'value'	: token,
			'type'	:'hidden'
		}) );


		swal({
		  title: "Are you sure?",
		  text: question,
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		},
		function(){
			$('body').append(newForm);
			newForm.submit();
		});

	});

});