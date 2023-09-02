<?php 
	require_once 'core.php';

	$docID = $_POST['docID'];

	$sql = "SELECT P.name, T.Treat_Name, R.PrescribeID, A.Patient_ID, A.APPT_ID
			FROM appointment A
			JOIN patient P ON P.patient_ID = A.Patient_ID
			JOIN treatment T ON T.Treatment_ID = A.Treatment_ID
			LEFT JOIN prescribe R ON R.Appt_ID = A.APPT_ID
			WHERE A.DocID = {$docID}";

	$result = $connect->query($sql);
	$output = array('data' => array());

	if($result->num_rows > 0){

		$statusPrescribe = "";
		$no = 1;
		

		while($row = $result->fetch_array()){

			$appt_id = $row[4];
			$prescribeid = $row[2];
			$patient_Id = $row[3];
			if($row[2] != null){

				$statusPrescribe = "<label class='label label-info'>checked</label>";
				$button = '<!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							  	<li><a type="button" data-toggle="modal" data-target="#infoPatient" onclick="infoPatient('.$patient_Id.')"> <i class="glyphicon glyphicon-info-sign"></i> Contact</a></li>  
							    <li><a type="button" data-toggle="modal" data-target="#modPrescribe" onclick="editPrescribe('.$prescribeid.')"><i class="fa fa-medkit"></i> Edit Prescribe</a></li>     
							  </ul>
							</div>';
			} else {

				$statusPrescribe = "<label class='label label-warning'>Please review patient</label>";
				$button = '<!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							  	<li><a type="button" data-toggle="modal" data-target="#infoPatient" onclick="infoPatient('.$patient_Id.')"><i class="glyphicon glyphicon-info-sign"></i> Contact</a></li>  
							    <li><a type="button" data-toggle="modal" data-target="#addPrescribe" onclick="addPrescribe('.$appt_id.')"><i class="fa fa-medkit"></i> Prescribe</a></li>    
							  </ul>
							</div>';
			}

			$output['data'][] = array(
				$no,
				$row[0],
				$row[1],
				$statusPrescribe,
				$button
			);

			$no++;
		}
	}

	$connect->close();
	echo json_encode($output);
?>