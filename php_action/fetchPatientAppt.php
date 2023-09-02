<?php
	require_once 'core.php';

	$id_patient = $_POST['patientID'];
	//echo $id_patient;
					//	0 		1 		2 		3 		4 			5
	$sql = "SELECT A.APPT_ID, A.Date, A.Time, D.name, P.name, T.Treat_Name
			FROM appointment A
			LEFT JOIN doctor D ON D.Doc_ID = A.DocID
			JOIN patient P ON P.patient_ID = A.Patient_ID
			JOIN treatment T ON T.Treatment_ID = A.Treatment_ID
			WHERE A.Patient_ID = {$id_patient}";

	$result = $connect->query($sql);

	$output = array('data' => array());

	if($result->num_rows > 0){

		$docAssign = "";
		$no = 1;

		while($row = $result->fetch_array()){

			$apptID = $row[0];
			$date = date("d-m-Y", strtotime($row[1]));
	 		$time = date("h:i a", strtotime($row[2]));

			if($row[3] != null){
				$docAssign = "Dr. ".$row[3];
			} else {
				$docAssign = "<label class='label label-warning'>Doctor not assign yet</label>";
			}

			$button = '<!-- Single button -->
					<div class="btn-group" role="group">
					  	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelAppt" onclick="delApptPatient('.$apptID.')"><i class="glyphicon glyphicon-trash"></i></button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editApptPatient" onclick="apptPatient('.$apptID.')"><i class="glyphicon glyphicon-edit"></i></button>
					</div>';
			$output['data'][] = array(
				$no,
				$row[5],
				$docAssign,
				$date,
				$time,
				$button
			);

			$no++;
		}
	}

	$connect->close();
	echo json_encode($output);

?>