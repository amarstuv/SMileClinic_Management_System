var managePreTable;

$(document).ready(function() {
	// top bar active
	$('#navPatient').addClass('active');
	$('#topNavPrescribe').addClass('active');
	
	// manage appointment table
	managePreTable = $("#managePreTable").DataTable({
		'ajax': 'php_action/fetchPrescribe.php',
		'order': []		
	});
});

// view details prescribe patient
function details(prescribeID = null){

	if(prescribeID){
		$.ajax({

			url: 'php_action/selectedPrescribe.php',
			type: 'post',
			data: {prescribeID : prescribeID},
			dataType: 'json',
			success:function(response){

				$('#namePatient').html('<p class="form-control">'+response.namePatient+'</p>');
				$('#treatName').html('<p class="form-control">'+response.treatName+'</p>');
				$('#medName').html('<p class="form-control">'+response.medName+'</p>');
				$('#quantity').html('<p class="form-control">'+response.quantity+'</p>');
				$('#dose').html('<p class="form-control">'+response.Dose+' Mg</p>');
				$('#desc').html('<textarea readonly class="form-control">'+response.description+'</textarea>');
			}

		});
	} else {
		alert('error!! Refresh the page again');
	}
}

//view payment
function addPay(Bill_ID = null){

	if(Bill_ID){

		$('#bill_id').remove();
		$('#printPayBtn').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		$('.pay-result').addClass('div-hide');
		$('.payFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/selectedBill.php',
			type: 'post',
			data: {Bill_ID : Bill_ID},
			dataType: 'json',
			success:function(response){

				$('.modal-loading').addClass('div-hide');
				$('.pay-result').removeClass('div-hide');
				$('.payFooter').removeClass('div-hide');

				$('#amount').val(response.Amount);
				$('#paid').val(response.paid);
				$('#typePay').val(response.Type);
				$('.payFooter').after('<input type="hidden" name="bill_id" id="bill_id" value="'+response.Bill_ID+'" />');
				
				var payID = response.pay_ID;

				if (payID == null) {
					//if not pay yet btn print will disable
					document.getElementById('payBtn').disabled='';
					document.getElementById('typePay').disabled='';
					document.getElementById('paid').disabled='';
					document.getElementById('amount').disabled='';
				} else {

					//if already pay btn pay will disable
					$('#btnClose').after('<button type="button" id="printPayBtn" class="btn btn-info" onclick="print('+response.pay_ID+')"><i class="glyphicon glyphicon-print"></i> Print</button>');
					document.getElementById('payBtn').disabled='true';
					document.getElementById('typePay').disabled='true';
					document.getElementById('paid').disabled='true';
					document.getElementById('amount').disabled='true';
				}

				//add payment
				$('#paymentForm').unbind('submit').bind('submit', function(){

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');

					var paid = $('#paid').val();
					var typePay = $('#typePay').val();

					if(paid == "") {
						$("#paid").after('<p class="text-danger">Please Pay First</p>');
						$('#paid').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#paid").find('.text-danger').remove();
						// success out for form 
						$("#paid").closest('.form-group').addClass('has-success');	  	
					}

					if(typePay == "") {
						$("#typePay").after('<p class="text-danger">Payment Type is required</p>');
						$('#typePay').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#typePay").find('.text-danger').remove();
						// success out for form 
						$("#typePay").closest('.form-group').addClass('has-success');	  	
					}

					if(paid && typePay){

						var form = $(this);
						$('#payBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response){
								// submit btn
								$('#payBtn').button('reset');
								// remove the error text
								$(".text-danger").remove();
								// remove the form error
								$('.form-group').removeClass('has-error').removeClass('has-success');

								if(response.success == true) {
									console.log(response);

									// reload the manage member table 
									managePreTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  					$('.payment-messages').html('<div class="alert alert-success">'+
			            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          				'</div>');

			  	  					$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} else {
									// shows a warning message after operation
									$('.payment-messages').html('<div class="alert alert-warning">'+
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

					}// if
					return false;
				});//add payment
			}
		});

	} else {
		alert('error!! Refresh the page again');
	}
}

function removePre(prescribeID = null){

	if(prescribeID){

		$('#prescribeId').remove();
		$.ajax({

			url: 'php_action/selectedPrescribe.php',
			type: 'post',
			data: {prescribeID : prescribeID},
			dataType: 'json',
			success:function(response){
				$('.removePreFooter').after('<input type="hidden" name="prescribeId" id="prescribeId" value="'+response.PrescribeID+'" />');

				// click will remove prescribe
				$('#removePreBtn').unbind('click').bind('click', function(){
					$('#removePreBtn').button('loading');

					$.ajax({
						url: 'php_action/removePrescribe.php',
						type: 'post',
						data: {prescribeID : prescribeID},
						dataType: 'json',
						success:function(response){
							console.log(response);

							$("#removePreBtn").button('reset');

							if(response.success == true) {

								// hide the remove modal 
								$('#removePre').modal('hide');

								// reload the brand table 
								managePreTable.ajax.reload(null, false);
								
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
		$('.removePreFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
}

function print(payID = null){

	if(payID){
		$.ajax({
			url: 'php_action/printBill.php',
			type: 'post',
			data: {payID: payID},
			dataType: 'text',
			success:function(response){

				var mywindow = window.open('', 'Clinic Management System', 'height=400,width=600');
		        mywindow.document.write('<html><head><title>Receipt</title>');        
		        mywindow.document.write('</head><body>');
		        mywindow.document.write(response);
		        mywindow.document.write('</body></html>');

		        mywindow.document.close(); // necessary for IE >= 10
		        mywindow.focus(); // necessary for IE >= 10
		        mywindow.resizeTo(screen.width, screen.height);
				setTimeout(function() {
				    mywindow.print();
				    mywindow.close();
				}, 100);
			}
		});

	} else {
		alert('error!! Refresh the page again');
	}
}