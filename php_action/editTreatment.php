<?php 
	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	if($_POST){

		$editTreatName = $_POST['editTreatName'];
		$editPrice = $_POST['editPrice'];
		$treat_id = $_POST['treat_id'];

		$sql = "UPDATE treatment SET Treat_Name = '$editTreatName', price = '$editPrice' WHERE Treatment_ID = {$treat_id}";

		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update Treatment";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = /*$connect->error;8*/"Error while updating";
		}

		$connect->close();

		echo json_encode($valid);
	}

?>