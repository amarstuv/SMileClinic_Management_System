<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['Role'])) {
	header('location: dashboard.php');	
}

$errors = array();

if($_POST) {		

	$IDno = $_POST['IDno'];
	$password = $_POST['psswd'];

	if(empty($IDno) || empty($password)) {
		if($IDno == "") {
			$errors[] = "ID is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM user WHERE No_ID = '$IDno'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM user WHERE No_ID = '$IDno' AND pswd = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$role = $value['Role'];
				$userId = $value['User_ID'];

				// set session
				$_SESSION['Role'] = $role;
				$_SESSION['userId'] = $userId;

				header('location: dashboard.php');	
			} else{
				
				$errors[] = "Incorrect ID/password combination";
			} // /else
		} else {		
			$errors[] = "ID does not exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<title>Clinic Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">	

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign in</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">ID</label>
									<div class="col-sm-10">
									  <input type="number" class="form-control" id="IDno" name="IDno" placeholder="ID Number" autocomplete="on" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="psswd" name="psswd" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-success btn-block"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#registerUser"> Register Here</button>
								</div>
							</div>
						</div>
						
					</div>
					<!-- panel-body -->

				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->

	<div class="modal fade bd-example-modal-lg" id="registerUser" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	
	    	<form class="form-horizontal" id="registerForm" action="php_action/registerUser.php" method="POST" autocomplete="off">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title"><i class="fa fa-user"></i> Register Patient</h4>
		      	</div>
		      	<div class="modal-body">

		      	<div class="registerMessages"></div>
			        <div class="form-group">
					    <label for="name" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="name" name="name" placeholder="Name"/>
					    </div>
					    <label for="ic_No" class="col-sm-2 control-label">Identity Card No.</label>
					    <div class="col-sm-4">
					      <input type="number" class="form-control" id="ic_No" name="ic_No" placeholder="Identity No." />
					    </div>
					</div>
					<div class="form-group">
					    <label for="email" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-4">
					      <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
					    </div>
					    <label for="gender" class="col-sm-2 control-label">Gender</label>
					    <div class="col-sm-4">
					      <select class="form-control" id="gender" name="gender">
					      	<option value="">-- Select --</option>
					      	<option value="1">Male</option>
					      	<option value="0">Female</option>
					      </select>
					    </div>
				  	</div>
				  	<div class="form-group">
				  		<label for="address" class="col-sm-2 control-label">Address</label>
				  		<div class="col-sm-4">
				  			<textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
				  		</div>
				  		<label for="noPhone" class="col-sm-2 control-label">No Phone</label>
						    <div class="col-sm-4">
						      <input type="number" class="form-control" id="noPhone" name="noPhone" placeholder="No. Phone"/>
						</div>
				  	</div>
				  	<div class="form-group">
				  		<label for="password" class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-4">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
					    </div>
					    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-4">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
					    </div>
					    <input type="hidden" name="role" id="role" value="3">
				  	</div>         	        
			  	
		      	</div> <!-- /modal-body -->
			  	<div class="modal-footer">
			  		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  		<button type="submit" class="btn btn-primary" id="registerBtn" data-loading-text="Loading..." autocomplete="off">Register</button>
		  		</div>
		      <!-- /modal-footer -->
	     	</form>
		     <!-- /.form -->
	    </div>
	    <!-- /modal-content -->
	  </div>
	  <!-- /modal-dailog -->
	</div>
	<script src="custom/js/register.js"></script>
</body>
</html>







	