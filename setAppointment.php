<?php require_once 'includes/header.php'?>
<?php 
	$userID = $_SESSION['userId'];

	$sql = "SELECT * FROM patient WHERE User_Id = {$userID}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	$patient_ID = $result['patient_ID'];

	$treatSql = "SELECT * FROM treatment";
	$treatQuery = $connect->query($treatSql);

	$editTreatSql = "SELECT * FROM treatment";
	$editTreatQuery = $connect->query($editTreatSql);
?>
	
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>		  
		  	<li class="active">Appointment</li>
		</ol>
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"><strong><i class="fa fa-calendar"></i> Appointment</strong></div>
			</div>
			<div class="panel-body">
				<div class="Appointment-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAppointment"> <i class="glyphicon glyphicon-plus-sign"></i> Set Appointment </button>
				</div>
				<input type="hidden" name="patientID" id="patientID" value="<?php echo $patient_ID?>">

				<table class="table table-striped" id="apptPatientTable">
					<thead>
						<tr>
							<th>No</th>							
							<th>Treatment</th>
							<th>Doctor</th>
							<th>Date</th>
							<th>Time</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>	
</div>

<!--add appointment patient-->
<div class="modal fade" id="addAppointment" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" action="php_action/addApptPatient.php" method="post" id="addApptForm">
    		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="glyphicon glyphicon-plus-sign"></i> Set Appointment</h4>
	      </div>
      	<div class="modal-body">
      		
      		<div class="add-appointment-messages"></div>

					<div class="add-appt-result">
						<div class="form-group">
				      <label for="treat" class="col-sm-3 control-label">Treatment : </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="treat" name="treat">
						      	<option value="">-- Treatment --</option>
						      	<?php while($row = $treatQuery->fetch_array()){?>
						      		<option value="<?php echo $row[0];?>"><?php echo $row[1];?> [RM <?php echo $row[2];?>]</option>
						      	<?php } ?>
									</select>
						    </div>
					  </div> <!-- /form-group-->	         	        
		        <div class="form-group">
		        	<label for="addDate" class="col-sm-3 control-label">Date : </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="addDate" placeholder="Date" name="addDate" autocomplete="off">
					    </div>
		        </div>
		        <div class="form-group">
		        	<label for="addTime" class="col-sm-3 control-label">Time : </label>
					    <div class="col-sm-8">
					      <input type="time" class="form-control" id="addTime" placeholder="Time" name="addTime" autocomplete="off">
					    </div>
		        </div><!-- /form-group-->
				        <input type="hidden" name="patientID" id="patientID" value="<?php echo $patient_ID?>">
					</div>
      	</div>
      	<div class="modal-footer addApptFooter">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-success" id="addApptBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Set </button>
      	</div><!-- /modal-footer -->
    	</form>	
    </div><!-- /modal-content -->
  </div><!-- /modal-dailog -->
</div>
<!---/add appointment patient-->

<!--edit appointment patient-->
<div class="modal fade" id="editApptPatient" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" action="php_action/editApptPatient.php" method="post" id="modifyApptForm">
    		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Appointment</h4>
	      </div>
      	<div class="modal-body">
      		<div class="mod-appointment-messages"></div>

      		<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>
					<div class="modify-appt-result">
						<div class="form-group">
				      <label for="modifyTreat" class="col-sm-3 control-label">Treatment : </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="modifyTreat" name="modifyTreat">
						      	<option value="">-- Treatment --</option>
						      	<?php while($rows = $editTreatQuery->fetch_array()){?>
						      		<option value="<?php echo $rows[0];?>"><?php echo $rows[1];?> [RM <?php echo $rows[2];?>]</option>
						      	<?php } $connect->close()?>
									</select>
						    </div>
					  </div> <!-- /form-group-->	         	        
		        <div class="form-group">
		        	<label for="modifyDate" class="col-sm-3 control-label">Date : </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="modifyDate" placeholder="Date" name="modifyDate" autocomplete="off">
					    </div>
		        </div>
		        <div class="form-group">
		        	<label for="modifyTime" class="col-sm-3 control-label">Time : </label>
					    <div class="col-sm-8">
					      <input type="time" class="form-control" id="modifyTime" placeholder="Time" name="modifyTime" autocomplete="off">
					    </div>
		        </div><!-- /form-group-->
					</div>
      	</div>
      	<div class="modal-footer modApptFooter">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-success" id="modApptBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
      	</div><!-- /modal-footer -->
    	</form>	
    </div><!-- /modal-content -->
  </div><!-- /modal-dailog -->
</div>
<!---/edit appointment patient-->

<!-- remove appointment -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelAppt">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Cancel Appointment</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to cancel ?</p>
      </div>
      <div class="modal-footer cancelApptFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
        <button type="button" class="btn btn-success" id="cancelApptBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove appointment -->
<script src="custom/js/appointment.js"></script>
<?php require_once 'includes/footer.php'?>