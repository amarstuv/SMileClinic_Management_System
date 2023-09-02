<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	$appt_id = $_POST['apptID'];

	$sql = "DELETE FROM appointment WHERE APPT_ID = {$appt_id}";

	if ($connect->query($sql)==TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Appointment has been cancelled";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while cancelling appointment";
	}

	$connect->close();

	echo json_encode($valid);
?>