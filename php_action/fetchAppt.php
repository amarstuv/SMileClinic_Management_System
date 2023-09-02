<?php 	
	require_once 'core.php';

					//0 		1 			2 			3 		4  		5 		6
	/*$sql = "SELECT A.APPT_ID, A.Patient_ID, A.DocID, A.Date, A.Time, P.name, T.Treat_Name
			FROM appointment A 
			JOIN patient P ON P.patient_ID = A.Patient_ID
			JOIN treatment T ON T.Treatment_ID = A.Treatment_ID";*/
	$sql = "CALL fetchAllAppointment()";

	$result = mysqli_query($connect,$sql);

	 //echo "Error is ". $connect->error;

	$output = array('data' => array());

	if(mysqli_num_rows($result) > 0) {

	 // $row = $result->fetch_array();
	 $doctorAssign = "";
	 $no = 1; 

	while($row = mysqli_fetch_array($result)) {

	 	$date = date("d-m-Y", strtotime($row[3]));
	 	$time = date("h:i a", strtotime($row[4]));
	 	//echo $formatDate;

	 	$apptID = $row[0];
	 	$Doc_id = $row[2];
	 	$patient_Id = $row[1];

	 	if($row[2] != NULL) {
	 		$doctorAssign = "Dr. ". $row[7];
	 	} else {
	 		$doctorAssign = "<label class='label label-warning'>Please Assign Doctor</label>";
	 	}

	 	$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		  	<li><a type="button" data-toggle="modal" data-target="#infoPatient" onclick="infoPatient('.$patient_Id.')"> <i class="glyphicon glyphicon-info-sign"></i> Contact</a></li>  
		    <li><a type="button" data-toggle="modal" data-target="#editAppt" onclick="editAppts('.$apptID.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeAppt" onclick="removeAppts('.$apptID.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>    
		  </ul>
		</div>';

	 	$output['data'][] = array(
	 		$no, 		
	 		$row[5],
	 		$date,
	 		$time,
	 		$row[6],
	 		$doctorAssign,
	 		$button
	 	);
	 	$no++; 	
	 } // /while 

	} // if num_rows

	$connect->close();

	echo json_encode($output);

?>