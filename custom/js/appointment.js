var manageApptTable;
var apptPatientTable;
var patientID;

$(document).ready(function() {
	// top bar active
	$('#navPatient').addClass('active');
	$('#topNavAptmnt').addClass('active');
	$('#setAppt').addClass('active');
	$('#editDate').datepicker({dateFormat:'dd-mm-yy'});
	$('#addDate').datepicker({dateFormat:'dd-mm-yy'});
	$('#modifyDate').datepicker({dateFormat:'dd-mm-yy'});

	// manage appointment table
	manageApptTable = $("#manageApptTable").DataTable({
		ajax: 'php_action/fetchAppt.php',
		'order': []		
	});

	patientID = $('#patientID').val();

	apptPatientTable = $("#apptPatientTable").DataTable({
		ajax: {
			url : 'php_action/fetchPatientAppt.php',
			type: 'post',
			data: {patientID : patientID},
			dataType: 'json'
		},
		'order': []	
	});

	$('#addApptForm').unbind('submit').bind('submit',function(){

		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var treat = $('#treat').val();
		var addDate = $('#addDate').val();
		var addTime = $('#addTime').val();

		if(treat == "") {
			$("#treat").after('<p class="text-danger">Treatment is required </p>');
			$('#treat').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#treat").find('.text-danger').remove();
			// success out for form 
			$("#treat").closest('.form-group').addClass('has-success');	  	
		}

		if(addDate == "") {
			$("#addDate").after('<p class="text-danger">Date is required</p>');
			$('#addDate').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#addDate").find('.text-danger').remove();
			// success out for form 
			$("#addDate").closest('.form-group').addClass('has-success');	  	
		}

		if(addTime == "") {
			$("#addTime").after('<p class="text-danger">Time is required</p>');
			$('#addTime').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#addTime").find('.text-danger').remove();
			// success out for form 
			$("#addTime").closest('.form-group').addClass('has-success');	  	
		}

		if(treat && addDate && addTime){

			var form = $(this);

			$("#addApptBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response){

					$("#addApptBtn").button('reset');

					if(response.success == true)  {

						apptPatientTable.ajax.reload(null,false);

						// remove text-error 
						$(".text-danger").remove();
						// remove from-group error
						$(".form-group").removeClass('has-error').removeClass('has-success');

						// shows a successful message after operation
						$('.add-appointment-messages').html('<div class="alert alert-success">'+
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
						
						$('#addDate').after('<p class="text-danger">Date must next day</p>');
						$('#addDate').closest('.form-group').addClass('has-error');

						$('.add-appointment-messages').html('<div class="alert alert-warning">'+
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

function editAppts(Appt_ID = null) {
	if(Appt_ID) {
		// remove hidden appointment id text
		$('#appt_id').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-appt-result').addClass('div-hide');
		// modal footer
		$('.editApptFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/selectedAppointment.php',
			type: 'post',
			data: {Appt_ID : Appt_ID},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-appt-result').removeClass('div-hide');
				// modal footer
				$('.editApptFooter').removeClass('div-hide');

				// setting the doc assign 
				$('#docAssign').val(response.DocID);
				// setting the date and time
				$('#editDate').val(response.Date);
				$('#editTime').val(response.Time);
				// appointment id 
				$('.editApptFooter').after('<input type="hidden" name="appt_id" id="appt_id" value="'+response.APPT_ID+'" />');

				// update appointment form 
				$('#editApptForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var assignDoc = $('#docAssign').val();
					var date = $('#editDate').val();
					var time = $('#editTime').val();

					if(assignDoc == "") {
						$("#docAssign").after('<p class="text-danger">Please Assign Doctor</p>');
						$('#docAssign').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#docAssign").find('.text-danger').remove();
						// success out for form 
						$("#docAssign").closest('.form-group').addClass('has-success');	  	
					}

					if(date == "") {
						$("#editDate").after('<p class="text-danger">Date is required</p>');
						$('#editDate').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editDate").find('.text-danger').remove();
						// success out for form 
						$("#editDate").closest('.form-group').addClass('has-success');	  	
					}

					if(time == "") {
						$("#editTime").after('<p class="text-danger">Time is required</p>');
						$('#editTime').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editTime").find('.text-danger').remove();
						// success out for form 
						$("#editTime").closest('.form-group').addClass('has-success');	  	
					}

					if(assignDoc && date && time) {
						var form = $(this);

						// submit btn
						$('#editApptBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								// submit btn
								$('#editApptBtn').button('reset');
								// remove the error text
								$(".text-danger").remove();
								// remove the form error
								$('.form-group').removeClass('has-error').removeClass('has-success');

								if(response.success == true) {
									console.log(response);

									// reload the manage member table 
									manageApptTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  					$('.edit-appointment-messages').html('<div class="alert alert-success">'+
			            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          				'</div>');

			  	  					$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} else {

									$("#editDate").after('<p class="text-danger">Date must next day</p>');
									$('#editDate').closest('.form-group').addClass('has-error');
									// shows a warning message after operation
									$('.edit-appointment-messages').html('<div class="alert alert-warning">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
				          			'</div>');

									// remove the mesages
				          			$(".alert-warning").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}// /success
							}
						});	 // /ajax												
					} // /if

					return false;
				}); // /update appointment form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit appointment function

function removeAppts(Appt_ID = null) {
	if(Appt_ID) {
		$('#removeApptId').remove();
		$.ajax({
			url: 'php_action/selectedAppointment.php',
			type: 'post',
			data: {Appt_ID : Appt_ID},
			dataType: 'json',
			success:function(response) {
				$('.removeApptFooter').after('<input type="hidden" name="removeApptId" id="removeApptId" value="'+response.APPT_ID+'" /> ');

				// click on remove button to remove the appointment
				$("#removeApptBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeApptBtn").button('loading');

					$.ajax({
						url: 'php_action/removeAppt.php',
						type: 'post',
						data: {Appt_ID : Appt_ID},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeApptBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeAppt').modal('hide');

								// reload the brand table 
								manageApptTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          			'</div>');

			  	  				$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the appointment

				}); // /click on remove button to remove the appointment

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

// view info patient
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

//patient function or view patient
function apptPatient(apptID = null){

	if(apptID){

		$('#apptId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		$('.modify-appt-result').addClass('div-hide');
		$('.modApptFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/selectedApptPatient.php',
			type: 'post',
			data: {apptID : apptID},
			dataType: 'json',
			success:function(response){

				$('.modal-loading').addClass('div-hide');
				$('.modify-appt-result').removeClass('div-hide');
				$('.modApptFooter').removeClass('div-hide');

				$('#modifyTreat').val(response.Treatment_ID);
				$('#modifyDate').val(response.Date);
				$('#modifyTime').val(response.Time);

				$('.modApptFooter').after('<input type="hidden" name="apptId" id="apptId" value="'+response.APPT_ID+'"/>');

				//edit appointment patient
				$('#modifyApptForm').unbind('submit').bind('submit',function(){

					var modifyTreat = $('#modifyTreat').val();
					var modifyDate = $('#modifyDate').val();
					var modifyTime = $('#modifyTime').val();

					if(modifyTreat == "") {
						$("#modifyTreat").after('<p class="text-danger">Treatment is required </p>');
						$('#modifyTreat').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#modifyTreat").find('.text-danger').remove();
						// success out for form 
						$("#modifyTreat").closest('.form-group').addClass('has-success');	  	
					}

					if(modifyDate == "") {
						$("#modifyDate").after('<p class="text-danger">Date is required</p>');
						$('#modifyDate').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#modifyDate").find('.text-danger').remove();
						// success out for form 
						$("#modifyDate").closest('.form-group').addClass('has-success');	  	
					}

					if(modifyTime == "") {
						$("#modifyTime").after('<p class="text-danger">Time is required</p>');
						$('#modifyTime').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#modifyTime").find('.text-danger').remove();
						// success out for form 
						$("#modifyTime").closest('.form-group').addClass('has-success');	  	
					}

					if(modifyTreat && modifyDate && modifyTime){

						var form = $(this);

						$('#modApptBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response){

								// submit btn
								$('#modApptBtn').button('reset');
								// remove the error text
								$(".text-danger").remove();
								// remove the form error
								$('.form-group').removeClass('has-error').removeClass('has-success');

								if(response.success == true){

									console.log(response);

									apptPatientTable.ajax.reload(null,false);

									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');

									$('.mod-appointment-messages').html('<div class="alert alert-success">'+
			            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          				'</div>');

			  	  					$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									});

								} else {

									$("#modifyDate").after('<p class="text-danger">Date must next day</p>');
									$('#modifyDate').closest('.form-group').addClass('has-error');
									// shows a warning message after operation
									$('.mod-appointment-messages').html('<div class="alert alert-warning">'+
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

function delApptPatient(apptID = null){
	if(apptID) {
		$('#cancelApptId').remove();
		$.ajax({
			url: 'php_action/selectedApptPatient.php',
			type: 'post',
			data: {apptID : apptID},
			dataType: 'json',
			success:function(response) {
				$('.cancelApptFooter').after('<input type="hidden" name="cancelApptId" id="cancelApptId" value="'+response.APPT_ID+'" /> ');

				// click on remove button to remove the appointment
				$("#cancelApptBtn").unbind('click').bind('click', function() {
					// button loading
					$("#cancelApptBtn").button('loading');

					$.ajax({
						url: 'php_action/cancelApptPatient.php',
						type: 'post',
						data: {apptID : apptID},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#cancelApptBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#cancelAppt').modal('hide');

								// reload the brand table 
								apptPatientTable.ajax.reload(null, false);
								
								$('.Appointment-messages').html('<div class="alert alert-success">'+
			            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          			'</div>');

			  	  				$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the appointment

				}); // /click on remove button to remove the appointment

			} // /success
		}); // /ajax

		$('.cancelApptFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
}