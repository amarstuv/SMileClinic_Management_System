<?php require_once 'includes/header.php'; ?>

<?php 

if (isset($_SESSION['Role']) && $_SESSION['Role'] == 1){

	$user_id = $_SESSION['userId'];
	$sql = "SELECT * FROM clinic_assistant WHERE User_Id = {$user_id}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	$connect->close();

	$test = $result['gender'];
	if($test == 1){
		$gender = "Male";
	}elseif($test == 0) {
		$gender = "Female";
	}else{
		$gender = "Select";
	}

}elseif (isset($_SESSION['Role']) && $_SESSION['Role'] == 2) {

	$user_id = $_SESSION['userId'];
	$sql = "SELECT * FROM doctor WHERE User_Id = {$user_id}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	$connect->close();

	$test = $result['gender'];
	if($test == 1){
		$gender = "Male";
	}elseif($test == 0) {
		$gender = "Female";
	}else{
		$gender = "Select";
		}

}else {

	$user_id = $_SESSION['userId'];
	$sql = "SELECT * FROM patient WHERE User_Id = {$user_id}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	$connect->close();

	$test = $result['gender'];
	if($test == 1){
		$gender = "Male";
	}elseif($test == 0) {
		$gender = "Female";
	}else{
		$gender = "Select";
	}
}

?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Profile</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"><strong><i class="glyphicon glyphicon-user"></i> My Profile</strong></div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<form action="php_action/profileEdit.php" method="post" class="form-horizontal" id="profileForm">
					<fieldset>
						<legend>Edit Profile</legend>

						<div class="changeUsenrameMessages"></div>			

						<div class="form-group">
						    <label for="nameEdit" class="col-sm-2 control-label">Name</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="nameEdit" name="nameEdit" placeholder="Name" value="<?php echo $result['name']; ?>"/>
						    </div>
						    <label for="icEdit" class="col-sm-2 control-label">Identity Card No.</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="icEdit" name="icEdit" disabled="true" value="<?php echo $result['IC_no']; ?>"/>
						    </div>
						</div>
						<div class="form-group">
						    <label for="emailEdit" class="col-sm-2 control-label">Email</label>
						    <div class="col-sm-4">
						      <input type="email" class="form-control" id="emailEdit" name="emailEdit" placeholder="Email" value="<?php echo $result['email']; ?>"/>
						    </div>
						    <label for="gendEdit" class="col-sm-2 control-label">Gender</label>
						    <div class="col-sm-4">
						    	<select class="form-control" id="genEdit" name="genEdit" disabled>
						    		<?php 
						    		if($result['gender']==1){
						    			echo "<option value='1'>Male</option>";
						    		} elseif ($result['gender']==0) {
						    			echo "<option value='0'>Female</option>";
						    		}

						    		?>	
							    </select>
						    </div>
					  	</div>
					  	<div class="form-group">

					  		<label for="numEdit" class="col-sm-2 control-label">No Phone</label>
						    <div class="col-sm-4">
						      <input type="number" class="form-control" id="numEdit" name="numEdit" placeholder="No. Phone" value="<?php echo $result['number']; ?>"/>
						  	</div>
					  		<label for="addressEdit" class="col-sm-2 control-label">Address</label>
					  		<div class="col-sm-4">
					  			<textarea class="form-control" id="addressEdit" name="addressEdit"><?php echo $result['address']; ?></textarea>
					  		</div>

					  	</div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['User_Id'] ?>" /> 
					      <button type="submit" class="btn btn-success" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					    </div>
					  </div>
					</fieldset>
				</form>

				<form action="php_action/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
					<fieldset>
						<legend>Change Password</legend>

						<div class="changePasswordMessages"></div>

						<div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Current Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="npassword" class="col-sm-2 control-label">New password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['User_Id'] ?>" /> 
					      <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					      
					    </div>
					  </div>
					</fieldset>
				</form>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->


<script src="custom/js/profile.js"></script>
<?php require_once 'includes/footer.php'; ?>