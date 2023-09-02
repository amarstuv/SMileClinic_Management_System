<?php require_once 'includes/header.php';?>
<?php
	$userID = $_SESSION['userId'];

	$sql = "SELECT * FROM doctor WHERE User_Id = {$userID}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	$medicineSql = "SELECT * FROM medicine";
	$medicineQuery = $connect->query($medicineSql);

	$medModSql = $medicineSql;
	$medUpdate = $connect->query($medModSql);

	$docID = $result['Doc_ID'];
?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Patient</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"> <strong><i class="fa fa-user-md"></i> Manage Patient</strong></div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>	

				<input type="hidden" name="docID" id="docID" value="<?php echo $docID?>">

				<table class="table table-striped" id="patientApptTable">
					 <thead>
						<tr>
							<th>No</th>							
							<th>Patient Name</th>
							<th>Treatment</th>
							<th>Prescribe</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade bd-example-modal-lg" id="infoPatient" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="infoForm" action="#" method="POST" autocomplete="off">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-user"></i> Info Patient</h4>
	      	</div>
	      	<div class="modal-body">
			      <div class="form-group">
					    <label for="name" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="namePatient" name="name" placeholder="Name" disabled readonly/>
					    </div>
					    <label for="ic_No" class="col-sm-2 control-label">Identity Card No.</label>
					    <div class="col-sm-4">
					      <input type="number" class="form-control" id="icPatient" name="ic_No" placeholder="Identity No." disabled readonly/>
					    </div>
						</div>
						<div class="form-group">
						  <label for="email" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="emailPatient" name="email" placeholder="Email" disabled readonly/>
					    </div>
						  <label for="gender" class="col-sm-2 control-label">Gender</label>
					    <div class="col-sm-4">
					      <select class="form-control" id="genPatient" name="gender" disabled readonly>
					      	<option value="">-- Select --</option>
					      	<option value="1">Male</option>
					      	<option value="0">Female</option>
					      </select>
					    </div>
					  </div>
				  	<div class="form-group">
				  		<label for="address" class="col-sm-2 control-label">Address</label>
				  		<div class="col-sm-4">
				  			<textarea class="form-control" id="adrsPatient" name="address" placeholder="Address" disabled readonly></textarea>
				  		</div>
				  		<label for="noPhone" class="col-sm-2 control-label">No Phone</label>
						<div class="col-sm-4">
						 	<input type="number" class="form-control" id="noPatient" name="noPhone" placeholder="No. Phone" disabled readonly/>
						</div>
				  	</div>        	        
		  	
	      	</div> <!-- /modal-body -->
			  	<div class="modal-footer">
			  		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  		</div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /view info patient -->

<!--add prescribe-->
<div class="modal fade" id="addPrescribe" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="prescribeForm" action="php_action/addPrescribe.php" autocomplete="off" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title"><i class="fa fa-user-md"></i> Prescribe</h4>
				</div>
				<div class="modal-body">
					<div class="prescribe-messages"></div>
					<div class="form-group">
						<label for="medicineName" class="col-sm-3 control-label"> Medicine </label>
						<div class="col-sm-8">
							<select class="form-control" id="medicineName" name="medicineName">
								<option value="">Medicine</option>
								<?php while($row = $medicineQuery->fetch_array()){?>
									<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="quantity" class="col-sm-3 control-label"> Quantity</label>
						<div class="col-sm-8">
							<input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="dose" class="col-sm-3 control-label"> Dose</label>
						<div class="col-sm-8">
							<input type="number" name="dose" id="dose" class="form-control" placeholder="Dose" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="desc" class="col-sm-3 control-label"> Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" id="desc" name="desc" placeholder="Additional"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer addPrescribeFooter">
					<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        		<button type="submit" class="btn btn-success" id="addPrescribeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--/add prescribe-->
<!-- edit Prescribe-->
<div class="modal fade" id="modPrescribe" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="editPrescribeForm" action="php_action/editPrescribe.php" autocomplete="off" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title"><i class="fa fa-user-md"></i> Prescribe</h4>
				</div>
				<div class="modal-body">

					<div class="modPrescribe-message"></div>

					<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>
					<div class="prescribe-result">
						<div class="form-group">
							<label for="medicineName" class="col-sm-3 control-label"> Medicine </label>
							<div class="col-sm-8">
								<select class="form-control" id="modMdicineName" name="modMed">
									<option value="">Medicine</option>
									<?php while($rows = $medUpdate->fetch_array()){?>
										<option value="<?php echo $rows[0]?>"><?php echo $rows[1]?></option>
									<?php } $connect->close()?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="quantity" class="col-sm-3 control-label"> Quantity</label>
							<div class="col-sm-8">
								<input type="number" name="modQuantity" id="modQuantity" class="form-control" placeholder="Quantity" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="dose" class="col-sm-3 control-label"> Dose</label>
							<div class="col-sm-8">
								<input type="number" name="modDose" id="modDose" class="form-control" placeholder="Dose" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="desc" class="col-sm-3 control-label"> Description</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="modDesc" name="modDesc" placeholder="Additional"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer modPrescribeFooter">
					<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        		<button type="submit" class="btn btn-success" id="modPrescribeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--/edit Prescribe-->
<script src="custom/js/patient.js"></script>
<?php require_once 'includes/footer.php';?>