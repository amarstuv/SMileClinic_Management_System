<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	if ($_POST) {
		
		$treatName = $_POST['treatName'];
		$price = $_POST['price'];

		$sql = "INSERT INTO treatment (Treat_Name, price) VALUES ('$treatName', '$price')";

		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Add Treatment";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while Adding";
		}

		$connect->close();

		echo json_encode($valid);
	}
?>