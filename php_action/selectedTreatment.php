<?php 
	require_once 'core.php';

	$treat_ID = $_POST['treat_ID'];

	$sql = "SELECT Treatment_ID, Treat_Name, price FROM treatment WHERE Treatment_ID = {$treat_ID}";

	$result = $connect->query($sql);

	if($result->num_rows > 0){
		$row = $result->fetch_array();
	}

	$connect->close();
	echo json_encode($row);
?>