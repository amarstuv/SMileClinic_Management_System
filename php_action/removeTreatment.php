<?php 
 	require_once 'core.php';

 	$valid['success'] = array('success' => false, 'messages' => array());

 	if($_POST){

 		$treat_id = $_POST['treat_id'];

 		$sql = "DELETE FROM treatment WHERE Treatment_ID = {$treat_id}";


		if ($connect->query($sql)==TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Remove Treatment";
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Treatment Cannot Remove";
		}

		$connect->close();

		echo json_encode($valid);
 	}
 	
?>