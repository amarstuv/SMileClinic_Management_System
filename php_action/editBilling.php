<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	$prescribeID = $_GET['PrescribeID'];
	$editAmount = $_SESSION['editAmount'];

	$sql = "UPDATE bill SET Amount = '$editAmount' WHERE prescribe_ID = {$prescribeID}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Updated Prescribe Patient";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while Prescribe ". $connect->error;
	}

	$connect->close();

	//echo $valid;

	echo json_encode($valid);

?>