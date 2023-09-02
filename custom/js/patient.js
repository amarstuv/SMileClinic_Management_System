var patientApptTable;

$(document).ready(function() {
	$('#navPatientAppt').addClass('active');

	var docID = $('#docID').val();

	//$('#patientApptTable').after("<label class='label label-info'>"+docID+"</label>");

	patientApptTable = $("#patientApptTable").DataTable({
		ajax: {
			url: 'php_action/docPatient.php',
			type: 'post',
			data: {docID : docID},
			dataType: 'json'
		},
		'order':[]
	});

	$('#prescribeForm').unbind('submit').bind('submit',function(){

		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var medname = $('#medicineName').val();
		var quantity = $('#quantity').val();
		var dose = $('#dose').val();

		if(medname == "") {
			$("#medicineName").after('<p class="text-danger">Medicine is required </p>');
			$('#medicineName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#medicineName").find('.text-danger').remove();
			// success out for form 
			$("#medicineName").closest('.form-group').addClass('has-success');	  	
		}

		if(quantity == "") {
			$("#quantity").after('<p class="text-danger">Quantity is required</p>');
			$('#quantity').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#quantity").find('.text-danger').remove();
			// success out for form 
			$("#quantity").closest('.form-group').addClass('has-success');	  	
		}

		if(dose == "") {
			$("#dose").after('<p class="text-danger">Dose is required</p>');
			$('#dose').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#dose").find('.text-danger').remove();
			// success out for form 
			$("#dose").closest('.form-group').addClass('has-success');	  	
		}

		if(medname && quantity && dose){

			var form = $(this);

			$("#addPrescribeBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response){

					$("#addPrescribeBtn").button('reset');

					if(response.success == true)  {

						patientApptTable.ajax.reload(null,false);

						// remove text-error 
						$(".text-danger").remove();
						// remove from-group error
						$(".form-group").removeClass('has-error').removeClass('has-success');

						// shows a successful message after operation
						$('.prescribe-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          	'</div>');

			          	$('#prescribeForm')[0].reset();

						// remove the mesages
          				$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          					
					} else {
						
						$('.prescribe-messages').html('<div class="alert alert-warning">'+
	            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            		'<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          			'</div>');

						// remove the mesages
	          			$(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	
					}
				}
			});
		}
		return false;
	});
});

function infoPatient(patientID = null){
	//document.getElementById('genPatient').value='1';
	if(patientID){
		$.ajax({
			url: 'php_action/viewPatient.php',
			type: 'post',
			data: {patientID : patientID},
			dataType: 'json',
			success:function(response){

				$("#namePatient").val(response.name);
				$("#icPatient").val(response.IC_no);
				$("#emailPatient").val(response.email);
				$("#genPatient").val(response.gender);
				$("#adrsPatient").val(response.address);
				$("#noPatient").val(response.number);
			}
		});

	} else {
		alert('error!! Refresh the page again');
	}
}

function addPrescribe(Appt_Id = null){
	if(Appt_Id){
			
		$('#appt_id').remove();
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#prescribeForm')[0].reset();

		$('.addPrescribeFooter').after('<input type="hidden" name="appt_id" id="appt_id" value="'+Appt_Id+'" />');
	} else {
		alert('error!! Refresh the page again');
	}
}

function editPrescribe(prescribeID = null){

	if(prescribeID){

		$('#prescribeid').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.prescribe-result').addClass('div-hide');
		// modal footer
		$('.modPrescribeFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/selectedPrescribe.php',
			type: 'post',
			data: {prescribeID : prescribeID},
			dataType: 'json',
			success:function(response){

			// modal loading
			$('.modal-loading').addClass('div-hide');
			// modal result
			$('.prescribe-result').removeClass('div-hide');
			// modal footer
			$('.modPrescribeFooter').removeClass('div-hide');

			$('#modMdicineName').val(response.medicine_ID);
			$('#modQuantity').val(response.quantity);
			$('#modDose').val(response.Dose);
			$('#modDesc').val(response.description);

			$('.modPrescribeFooter').after('<input type="hidden" name="prescribeid" id="prescribeid" value="'+prescribeID+'" />');

			$('#editPrescribeForm').unbind('submit').bind('submit',function(){

				$(".text-danger").remove();
				$('.form-group').removeClass('has-error').removeClass('has-success');

				var Emedname = $('#modMdicineName').val();
				var Equantity = $('#modQuantity').val();
				var Edose = $('#modDose').val();

				if(Emedname == "") {
					$("#modMdicineName").after('<p class="text-danger">Medicine is required </p>');
					$('#modMdicineName').closest('.form-group').addClass('has-error');
				} else {
					// remov error text field
					$("#modMdicineName").find('.text-danger').remove();
					// success out for form 
					$("#modMdicineName").closest('.form-group').addClass('has-success');	  	
				}

				if(Equantity == "") {
					$("#modQuantity").after('<p class="text-danger">Quantity is required</p>');
					$('#modQuantity').closest('.form-group').addClass('has-error');
				} else {
					// remove error text field
					$("#modQuantity").find('.text-danger').remove();
					// success out for form 
					$("#modQuantity").closest('.form-group').addClass('has-success');	  	
				}

				if(Edose == "") {
					$("#modDose").after('<p class="text-danger">Dose is required</p>');
					$('#modDose').closest('.form-group').addClass('has-error');
				} else {
					// remove error text field
					$("#modDose").find('.text-danger').remove();
					// success out for form 
					$("#modDose").closest('.form-group').addClass('has-success');	  	
				}

				if(Emedname && Equantity && Edose){

					var form = $(this);

					$("#modPrescribeBtn").button('loading');

					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),
						dataType: 'json',
						success:function(response){

							$("#modPrescribeBtn").button('reset');

							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true)  {

								console.log(response);
								patientApptTable.ajax.reload(null,false);

								// remove text-error 
								$(".text-danger").remove();
								// remove from-group error
								$(".form-group").removeClass('has-error').removeClass('has-success');

								// shows a successful message after operation
								$('.modPrescribe-message').html('<div class="alert alert-success">'+
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
								
								$('.modPrescribe-message').html('<div class="alert alert-warning">'+
			            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            		'<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
			          			'</div>');

								// remove the mesages
			          			$(".alert-warning").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert	
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