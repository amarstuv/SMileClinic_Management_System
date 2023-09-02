<?php require_once 'includes/header.php';?>
<?php 
	$sql = "SELECT * FROM doctor";
	$result = $connect->query($sql);
?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Appointment</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"> <strong><i class="fa fa-calendar"></i> Manage Appointment</strong></div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>			
				
				<table class="table table-striped" id="manageApptTable">
					 <thead class="thead-dark">
						<tr>
							<th>No</th>							
							<th>Patient Name</th>
							<th>Date</th>
							<th>Time</th>
							<th>Treatment</th>
							<th>Doctor</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- edit appointment -->
<div class="modal fade" id="editAppt" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editApptForm" action="php_action/editAppointment.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Appointment</h4>
	      </div>
	      <div class="modal-body">

	      	<div class="edit-appointment-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-appt-result">
		      	<div class="form-group">
		        	<label for="docAssign" class="col-sm-3 control-label">Doctor : </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="docAssign" name="docAssign">
					      		<option value="">-- Select Doctor --</option>
					      	<?php while ($row = $result ->fetch_array()) {?>
					      		<option value="<?php echo $row[0]?>"><?php echo $row[1];?></option>
					      	<?php } $connect->close()?>  		
						    </select>
					    </div>
		        </div> <!-- /form-group-->	         	        
		        <div class="form-group">
		        	<label for="editDate" class="col-sm-3 control-label">Date : </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editDate" placeholder="Date" name="editDate" autocomplete="off">
					    </div>
		        </div>
		        <div class="form-group">
		        	<label for="editTime" class="col-sm-3 control-label">Time : </label>
					    <div class="col-sm-8">
					      <input type="time" class="form-control" id="editTime" placeholder="Date" name="editTime" autocomplete="off">
					    </div>
		        </div><!-- /form-group-->	
		      </div><!-- /edit appointment -->
	      </div> <!-- /modal-body -->
	      <div class="modal-footer editApptFooter">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-success" id="editApptBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div><!-- /modal-footer -->
     	</form><!-- /.form -->
    </div><!-- /modal-content -->
  </div><!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit appointment -->

<!-- remove appointment -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAppt">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Appointment</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeApptFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeApptBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove appointment -->

<!-- view info patient -->
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

<script src="custom/js/appointment.js"></script>

<?php require_once 'includes/footer.php'; ?>
