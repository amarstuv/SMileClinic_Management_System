$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavProfile").addClass('active');

	// Edit profile assistant clinic
	$("#profileForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		var NameEdit = $("#nameEdit").val();

		if(NameEdit == "") {
			$("#nameEdit").after('<p class="text-danger">Name field is required</p>');
			$("#nameEdit").closest('.col-sm-4').addClass('has-error');
		} else {

			$(".text-danger").remove();
			$('.form-group').removeClass('has-error');

			$("#changeProfileBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					$("#changeProfileBtn").button('reset');
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".form-group").removeClass('has-error').removeClass('has-success');

					if(response.success == true)  {																					
						// shows a successful message after operation
						$('.changeUsenrameMessages').html('<div class="alert alert-success">'+
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
						// shows a successful message after operation
						$('.changeUsenrameMessages').html('<div class="alert alert-warning">'+
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
				} // /success 
			}); // /ajax
		}
			
		return false;
	});

	$("#changePasswordForm").unbind('submit').bind('submit', function() {

		var form = $(this);

		//$(".text-danger").remove();

		var currentPassword = $("#password").val();
		var newPassword = $("#npassword").val();
		var conformPassword = $("#cpassword").val();

		if(currentPassword == "" || newPassword == "" || conformPassword == "") {
			if(currentPassword == "") {
				$("#password").after('<p class="text-danger">Current Password field is required</p>');
				$("#password").closest('.col-sm-10').addClass('has-error');

			} else {
				$("#password").closest('.col-sm-10').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(newPassword == "") {
				$("#npassword").after('<p class="text-danger">New Password field is required</p>');
				$("#npassword").closest('.col-sm-10').addClass('has-error');
			} else {
				$("#npassword").closest('.col-sm-10').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(conformPassword == "") {
				$("#cpassword").after('<p class="text-danger">Confirm Password field is required</p>');
				$("#cpassword").closest('.col-sm-10').addClass('has-error');
			} else {
				$("#cpassword").closest('.col-sm-10').removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {


			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					//after submit the form will clear
					document.getElementById('password').value='';
					document.getElementById('npassword').value='';
					document.getElementById('cpassword').value='';

					console.log(response);
					if(response.success == true) {
						$('.changePasswordMessages').html('<div class="alert alert-success">'+
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

						$('.changePasswordMessages').html('<div class="alert alert-warning">'+
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
				} // /success function
			}); // /ajax function

		} // /else


		return false;
	});
}); // /document