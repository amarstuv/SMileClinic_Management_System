var treatmentTable;

$(document).ready(function(){

	$('#navTreatment').addClass('active');

	treatmentTable = $('#treatmentTable').DataTable({
		ajax: 'php_action/fetchTreatment.php',
		'order':[]
	});

	$('#addTreatForm').unbind('submit').bind('submit',function(){

		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var treatName = $('#treatName').val();
		var price = $('#price').val();

		if(treatName == "") {
			$("#treatName").after('<p class="text-danger">Treatment is required </p>');
			$('#treatName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#treatName").find('.text-danger').remove();
			// success out for form 
			$("#treatName").closest('.form-group').addClass('has-success');	  	
		}

		if(price == "") {
			$("#price").after('<p class="text-danger">Price is required</p>');
			$('#price').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#price").find('.text-danger').remove();
			// success out for form 
			$("#price").closest('.form-group').addClass('has-success');	  	
		}

		if(treatName && price){

			var form = $(this);

			$("#addTreatBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response){

					$("#addTreatBtn").button('reset');

					if(response.success == true){

						treatmentTable.ajax.reload(null,false);
						// remove text-error 
						$(".text-danger").remove();
						// remove from-group error
						$(".form-group").removeClass('has-error').removeClass('has-success');

						$('#addTreatForm')[0].reset();

						// shows a successful message after operation
						$('.add-treat-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          	'</div>');

						// remove the mesages
          				$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	
					} else {

						$('.add-treat-messages').html('<div class="alert alert-warning">'+
	            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            		'<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          			'</div>');

						// remove the mesages
	          			$(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					}
				}
			});
		}
		return false;
	});
});

function editTreatment(treat_ID = null){

	if(treat_ID){

		$('#treat_id').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-treat-result').addClass('div-hide');
		// modal footer
		$('.edit-treatFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/selectedTreatment.php',
			type: 'post',
			data: {treat_ID : treat_ID},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-treat-result').removeClass('div-hide');
				// modal footer
				$('.edit-treatFooter').removeClass('div-hide');

				$('#editTreatName').val(response.Treat_Name);
				$('#editPrice').val(response.price);

				$('.edit-treatFooter').after('<input type="hidden" name="treat_id" id="treat_id" value="'+response.Treatment_ID+'" />');

				$('#editTreatForm').unbind('submit').bind('submit', function(){

					var treatName = $('#editTreatName').val();
					var price = $('#editPrice').val();

					if(treatName == "") {
						$("#editTreatName").after('<p class="text-danger">Treatment is required </p>');
						$('#editTreatName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editTreatName").find('.text-danger').remove();
						// success out for form 
						$("#editTreatName").closest('.form-group').addClass('has-success');	  	
					}

					if(price == "") {
						$("#editPrice").after('<p class="text-danger">Price is required</p>');
						$('#editPrice').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editPrice").find('.text-danger').remove();
						// success out for form 
						$("#editPrice").closest('.form-group').addClass('has-success');	  	
					}

					if(treatName && price){

						var form = $(this);

						$("#editTreatBtn").button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response){

								$("#editTreatBtn").button('reset');

								if(response.success == true){

									treatmentTable.ajax.reload(null,false);
									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

									// shows a successful message after operation
									$('.edit-treat-messages').html('<div class="alert alert-success">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
						          	'</div>');

									// remove the mesages
			          				$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert	
								} else {

									$('.edit-treat-messages').html('<div class="alert alert-warning">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
				          			'</div>');

									// remove the mesages
				          			$(".alert-warning").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									});
								}
							}
						});
					}
					return false;
				});

			}
		});



	} else {
		alert('error!! Refresh the page again');
	}
}

function delTreat(treat_ID = null){

	if(treat_ID){

		$('#treat_id').remove();
		$.ajax({
			url: 'php_action/selectedTreatment.php',
			type: 'post',
			data: {treat_ID : treat_ID},
			dataType: 'json',
			success:function(response){
				$('.removeTreatFooter').after('<input type="hidden" name="treat_id" id="treat_id" value="'+response.Treatment_ID+'" />');
				$('#delTreatBtn').unbind('click').bind('click', function(){

				$('#delTreatBtn').button('loading');

				$.ajax({
					url: 'php_action/removeTreatment.php',
					type: 'post',
					data: {treat_ID : treat_ID},
					dataType: 'json',
					success:function(response){
						console.log(response);

						if(response.success == true){
							// hide the remove modal 
							$('#delTreat').modal('hide');

							// reload the brand table 
							treatmentTable.ajax.reload(null, false);
							
							$('.remove-messages').html('<div class="alert alert-success">'+
		            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          			'</div>');

		  	  				$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}
					}
				});
			});
			}
		});

	} else {
		alert('error!! Refresh the page again');
	}

}