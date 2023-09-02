<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	$prescribeID = $_GET['PrescribeID'];
	$amount = $_SESSION['amount'];

	$sql = "INSERT INTO bill (prescribe_ID, Amount) VALUES ('$prescribeID','$amount')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Prescribe Patient";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while Prescribe";
	}

	$connect->close();

	//echo $valid;

	echo json_encode($valid);

?>