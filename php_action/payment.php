<?php 
	require_once 'core.php';

	$bill_id = $_POST['bill_id'];
	$paid = $_POST['paid'];
	$typePay = $_POST['typePay'];
	$date = date("Y-m-d");

	$sql = "INSERT INTO payment (bill_ID, paid, Type, Date) VALUES ('$bill_id','$paid','$typePay','$date')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Payment";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while payment process";
	}

	$connect->close();

	echo json_encode($valid);

	//echo $date;

?>