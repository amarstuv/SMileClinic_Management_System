<?php require_once 'includes/header.php'?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Prescribe</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"><strong><i class="fa fa-medkit"></i> Prescribe Patient</div></strong>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				<div class="remove-messages"></div>			
				<table class="table table-striped" id="managePreTable">
					<thead>
						<tr>
							<th>No</th>							
							<th>Patient Name</th>
							<th>Medicine</th>
							<th>Quantity</th>
							<th>Dose</th>
							<th>Payment Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!--details prescribe-->
<div class="modal fade bd-example-modal-lg" id="details" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-medkit"></i> Prescribe Patient</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="namePatient" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<p id="namePatient"></p>
						</div>
						<label for="treatName" class="col-sm-2 control-label">Treatment</label>
						<div class="col-sm-4">
							<p id="treatName"></p>
						</div>
					</div>
					<div class="form-group">
						<label for="medicineName" class="col-sm-2 control-label"> Medicine</label>
						<div class="col-sm-4">
							<p id="medName"></p>
						</div>
						<label for="quantity" class="col-sm-2 control-label">Quantity</label>
						<div class="col-sm-4">
							<p id="quantity"></p>
						</div>
					</div>
					<div class="form-group">
						<label for="dose" class="col-sm-2 control-label">Dose</label>
						<div class="col-sm-4">
							<p id="dose"></p>
						</div>
						<label for="desc" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-4">
							<p id="desc"></p>
						</div>
					</div>
				</div>	
			</div><!--/modal body-->
			<div class="modal-footer">
				 <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			</div><!--/modal footer-->
		</div><!--/modal content-->
	</div><!--/modal dialog-->	
</div><!--/modal fade-->
<!-- /details prescribe-->

<!--pay bill-->
<div class="modal fade" id="addPay" tabindex="1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" action="php_action/payment.php" id="paymentForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-paypal"></i> Payment</h4>
				</div>
				<div class="modal-body">
					<div class="payment-messages"></div>
					<div class="pay-result">
						<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
							<span class="sr-only">Loading...</span>
						</div>
						
						<div class="form-group">
							<label for="amount" class="col-sm-2 control-label"> Amount</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="amount" id="amount" placeholder="RM 00.00" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="paid" class="col-sm-2 control-label"> Paid</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="paid" id="paid" placeholder="RM 00.00" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="type" class="col-sm-2 control-label"> Type</label>
							<div class="col-sm-10">
								<select class="form-control" name="typePay" id="typePay">
									<option value="">Payment Type</option>
									<option value="1">Cash</option>
									<option value="2">Online</option>
									<option value="3">Card</option>
								</select>
							</div>
						</div>
					</div>
				</div><!--/modal body-->
				<div class="modal-footer payFooter">
					 <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnClose"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
					 <button type="submit" class="btn btn-success" id="payBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Pay</button>
				</div><!--/modal footer-->
			</form><!--/form payment-->
		</div><!--/modal content-->
	</div><!--/modal dialog-->	
</div><!--/modal fade-->
<!--/pay bill-->

<!--remove prescribe-->
<div class="modal fade" tabindex="-1" role="dialog" id="removePre">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Prescribe</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removePreFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removePreBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/remove prescribe-->

<script src="custom/js/prescribe.js"></script>
<?php require_once 'includes/footer.php'?>