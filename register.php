<?php require_once 'includes/header.php'; ?>
<?php require_once 'php_action/db_connect.php' ?>


<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Register</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"> <strong><i class="fa fa-plus-square"></i> Registration</strong></div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<form action="php_action/registerUser.php" method="post" class="form-horizontal" id="registerForm" autocomplete="off">
					<fieldset>
						<legend>Details</legend>

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
					  		<label for="noPhone" class="col-sm-2 control-label">No Phone</label>
						    <div class="col-sm-4">
						      <input type="number" class="form-control" id="noPhone" name="noPhone" placeholder="No. Phone"/>
						  	</div>
						  	<label for="role" class="col-sm-2 control-label">Position</label>
						  	<div class="col-sm-4">
						      <select class="form-control" id="role" name="role">
						      	<option value="">-- Select --</option>
						      	<option value="1">Clinic Assistant</option>
						      	<option value="2">Doctor</option>
						      </select>
						    </div>
					  	</div>
					  	<div class="form-group">
					  		<label for="address" class="col-sm-2 control-label">Address</label>
					  		<div class="col-sm-4">
					  			<textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
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
					  	</div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      <button type="submit" class="btn btn-primary" data-loading-text="Loading..." id="registerBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Register </button>
					    </div>
					  </div>
					</fieldset>
				</form>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->

<script src="custom/js/register.js"></script>
<?php require_once 'includes/footer.php'; ?>