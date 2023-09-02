<?php
	require_once 'core.php';

	if($_POST){

		$valid['success'] = array('success' => false, 'messages' => array());

		$appt_id = $_POST['appt_id'];
		$Doc_id = $_POST['docAssign'];
		$date = date("Y-m-d", strtotime($_POST['editDate']));
		$time = $_POST['editTime'];

		//current date to check appointment must next day or further day

		$currentDate = date("Y-m-d");

		if($date > $currentDate){

			$sql = "UPDATE appointment SET DocID = '$Doc_id', Date = '$date', Time = '$time' WHERE APPT_ID = {$appt_id}";
		
			if($query = $connect->query($sql)==TRUE){
				$valid['success'] = true;
				$valid['messages'] = "Successfully Update";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating info";
			}

		} else {

			$valid['success'] = false;
			$valid['messages'] = "Date less than Today";
		}

		

		$connect->close();

		echo json_encode($valid);
	}
?>