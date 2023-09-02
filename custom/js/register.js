$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavRegister").addClass('active');

	// Edit profile assistant clinic
	$("#registerForm").unbind('submit').bind('submit', function() {

		//$(".text-danger").remove();

		var Name = $("#name").val();
		var Ic_No = $("#ic_No").val();
		var gender = $("#gender").val();
		var role = $("#role").val();
		var password = $("#password").val();
		var cPassword = $("#cpassword").val();

		if(Name == "" || Ic_No == "" || gender == "" || role == "" || password == "" || cPassword == "") {

			if (role == ""){
				$("#role").after('<p class="text-danger">Position is required</p>');
				$("#role").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#role").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

			if (Name == ""){
				$("#name").after('<p class="text-danger">Name field is required</p>');
				$("#name").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#name").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

			if (Ic_No == ""){
				$("#ic_No").after('<p class="text-danger">Identity No. is required</p>');
				$("#ic_No").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#ic_No").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

			if (gender == ""){
				$("#gender").after('<p class="text-danger">Gender is required</p>');
				$("#gender").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#gender").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

			if (password == ""){
				$("#password").after('<p class="text-danger">Password is required</p>');
				$("#password").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#password").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

			if (cPassword == ""){
				$("#cpassword").after('<p class="text-danger">Confirm Password is required</p>');
				$("#cpassword").closest('.col-sm-4').addClass('has-error');
			}else{
				$("#cpassword").closest('.col-sm-4').removeClass('has-error');
				$(".text-danger").remove();
			}

		} else {

			var form = $(this);
			$("#registerBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					$("#registerBtn").button('reset');
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".col-sm-4").removeClass('has-error').removeClass('has-success');
					

					if(response.success == true)  {	

						$("#registerForm")[0].reset();																				
						// shows a successful message after operation
						$('.registerMessages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

						// remove the mesages
	          			$(".alert-success").delay(500).show(10, function(){
							$(this).delay(3000).hide(10, function(){
								$(this).remove();
							});
						}); // /.alert	          					
						
					} else {
						// shows a successful message after operation
						$('.registerMessages').html('<div class="alert alert-warning">'+
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
}); // /document