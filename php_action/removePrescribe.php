<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	$prescribe_id = $_POST['prescribeID'];

	$sql = "DELETE FROM prescribe WHERE PrescribeID = {$prescribe_id}";

	if ($connect->query($sql)==TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Remove Prescribe";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Prescribe Cannot Remove";
	}

	$connect->close();

	echo json_encode($valid);
?>