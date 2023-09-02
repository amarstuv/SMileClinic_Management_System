<?php
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	$Appt_ID = $_POST['Appt_ID'];

	$sql = "DELETE FROM appointment WHERE APPT_ID = {$Appt_ID}";

	if ($connect->query($sql)==TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Remove Apppointment";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Appointment Cannot Remove";
	}

	$connect->close();

	echo json_encode($valid);

?>