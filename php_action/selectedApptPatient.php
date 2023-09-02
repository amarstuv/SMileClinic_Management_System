<?php 
	require_once 'core.php';

	$appt_id = $_POST['apptID'];

	$sql = "SELECT APPT_ID, Date, Time, Treatment_ID FROM appointment WHERE APPT_ID = {$appt_id}";

	$result = $connect->query($sql);

	if($result->num_rows > 0) { 
	 	$row = $result->fetch_array();
	} // if num_rows 

	$connect->close();
	echo json_encode($row);
?>