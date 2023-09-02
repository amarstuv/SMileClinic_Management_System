<?php 
	require_once 'core.php';

	$bill_id = $_POST['Bill_ID'];

	$sql = "SELECT B.Bill_ID, P.pay_ID, B.Amount, P.paid, P.Type, P.Date
			FROM bill B
			LEFT JOIN payment p ON P.bill_ID = B.Bill_ID 
			WHERE B.Bill_ID ={$bill_id}";

	$result = $connect->query($sql);

	if($result->num_rows > 0) { 
	 	$row = $result->fetch_array();
	} // if num_rows 

	$connect->close();
	echo json_encode($row);
?>