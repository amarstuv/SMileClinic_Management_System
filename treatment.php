<?php require_once 'includes/header.php'?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Treatment</li>
		</ol>

		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="page-heading"> <strong><i class="fa fa-h-square"></i> Manage Treatment</strong></div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>	
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTreatment"> <i class="glyphicon glyphicon-plus-sign"></i> Add Treatment </button>
				</div>

				<table class="table table-striped" id="treatmentTable">
					 <thead>
						<tr>
							<th>No</th>							
							<th>Treatment Name</th>
							<th>Price (RM)</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!--add treatment-->
<div class="modal fade" id="addTreatment" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" action="php_action/addTreatment.php" method="post" id="addTreatForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title"><i class="glyphicon glyphicon-plus-sign"></i> Add Treatment</h4>
				</div>
				<div class="modal-body">

					<div class="add-treat-messages"></div>

					<div class="form-group">
				      	<label for="treat" class="col-sm-3 control-label">Treatment : </label>
						<div class="col-sm-8">
						   	<input type="text" class="form-control" name="treatName" id="treatName" placeholder="Treatment Name" autocomplete="off">
						</div>
					</div> <!-- /form-group-->
		        	<div class="form-group">
		        	<label for="price" class="col-sm-3 control-label">Price : </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="price" placeholder="RM 00:00" name="price" autocomplete="off">
					    </div>
		        	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        		<button type="submit" class="btn btn-success" id="addTreatBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add </button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- add treatment-->

<!--edit treatment-->
<div class="modal fade" id="editTreatment" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" action="php_action/editTreatment.php" method="post" id="editTreatForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Treatment</h4>
				</div>
				<div class="modal-body">

					<div class="edit-treat-messages"></div>

					<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

					<div class="edit-treat-result">
						<div class="form-group">
					      	<label for="treat" class="col-sm-3 control-label">Treatment : </label>
							<div class="col-sm-8">
							   	<input type="text" class="form-control" name="editTreatName" id="editTreatName" placeholder="Treatment Name" autocomplete="off">
							</div>
						</div> <!-- /form-group-->
			        	<div class="form-group">
			        	<label for="price" class="col-sm-3 control-label">Price : </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editPrice" placeholder="RM 00:00" name="editPrice" autocomplete="off">
						    </div>
			        	</div>
		        	</div>
				</div>
				<div class="modal-footer edit-treatFooter">
					<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        		<button type="submit" class="btn btn-success" id="editTreatBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add </button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--edit treatment-->

<!--remove treatment-->
<div class="modal fade" tabindex="-1" role="dialog" id="delTreat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Treatment</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Remove ?</p>
      </div>
      <div class="modal-footer removeTreatFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
        <button type="button" class="btn btn-success" id="delTreatBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--remove treatment-->
<script src="custom/js/treatment.js"></script>
<?php require_once 'includes/footer.php'?>
