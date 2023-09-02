<?php 
	require_once 'core.php';

	$id_patient = $_POST['patientID'];

	$sql = "SELECT * FROM patient WHERE patient_ID = {$id_patient}";
	$result = $connect->query($sql);

	if($result->num_rows > 0){
		$row = $result->fetch_array();
	}

	$connect->close();

	echo json_encode($row);

?>