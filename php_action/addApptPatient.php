<?php 
	require_once 'core.php';

	$patient_id = $_POST['patientID'];
	$treat_id = $_POST['treat'];
	$date = date("Y-m-d", strtotime($_POST['addDate']));
	$time = $_POST['addTime'];

	$currentDate = date("Y-m-d");

	if($date > $currentDate){

		$sql = "INSERT INTO appointment (Treatment_ID, Patient_ID, Date, Time) VALUES ('$treat_id','$patient_id','$date','$time')";

		if($connect->query($sql) === TRUE){
			$valid['success'] = true;
			$valid['messages'] = "Successfully Set Appointment";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while adding Appointment";
		}

	} else {

		$valid['success'] = false;
		$valid['messages'] = "Date must next day or further";
	}

	
	$connect->close();

	echo json_encode($valid);
?>