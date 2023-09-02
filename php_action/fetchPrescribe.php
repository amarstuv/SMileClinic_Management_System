<?php 
	require_once 'core.php';

					// 0 			1 			2 		3 		4 			5 		
	/*$sql = "SELECT R.PrescribeID, R.quantity, R.Dose, M.Name, B.Bill_ID, P.name  
			FROM prescribe R
			JOIN appointment A ON A.APPT_ID = R.Appt_ID
			JOIN medicine M ON M.medicine_ID = R.med_ID
			JOIN bill B ON B.prescribe_ID = R.PrescribeID
			JOIN patient P ON P.patient_ID = A.Patient_ID";*/

	$sql = "CALL fetchAllPrescribe()";

	$result = $connect->query($sql);
	$output = array('data' => array());

	if($result->num_rows > 0){

		$no = 1;
		$status = "";

		while ($row = $result->fetch_array()) {

			$prescribeID = $row[0];
			$Bill_ID = $row[4];
			$prescribe = $row[0];
			$dose = $row[2]." Mg";

			$payID = $row[6];

			if ($payID != NULL) {
				$status = "<label class='label label-success'>Full Payment</label>";
			} else {
				$status = "<label class='label label-danger'>Overdue Payment</label>";
			}

			$button = '<!-- Single button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	<li><a type="button" data-toggle="modal" data-target="#details" onclick="details('.$prescribeID.')"> <i class="glyphicon glyphicon-info-sign"></i> Details</a></li>  
					    <li><a type="button" data-toggle="modal" data-target="#addPay" onclick="addPay('.$Bill_ID.')"> <i class="fa fa-paypal"></i> Payment</a></li>
					    <li><a type="button" data-toggle="modal" data-target="#removePre" onclick="removePre('.$prescribeID.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>    
					  </ul>
					</div>';


			$output['data'][] = array(
				$no,
				$row[5],
				$row[3],
				$row[1],
				$dose,
				$status,
				$button
			);
			$no++;
		}
	}

	$connect->close();
	echo json_encode($output);
?>