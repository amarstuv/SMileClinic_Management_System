<?php 
	require_once 'core.php';

	if($_POST){

		$valid['success'] = array('success' => false, 'messages' => array());

		$medName = $_POST['modMed'];
		$prescribeid = $_POST['prescribeid'];
		$quantity = $_POST['modQuantity'];
		$dose = $_POST['modDose'];
		$desc = $_POST['modDesc'];

		$sql = "UPDATE prescribe SET med_ID = '$medName', quantity = '$quantity', Dose = '$dose', description = '$desc' WHERE 				PrescribeID = {$prescribeid};";

		$sql .= "SELECT Price medPrice FROM medicine WHERE medicine_ID = {$medName};";

		$sql .= "SELECT T.price treatPrice FROM prescribe P JOIN appointment A ON A.APPT_ID = P.Appt_ID
				JOIN treatment T ON T.Treatment_ID = A.Treatment_ID
				WHERE P.PrescribeID = {$prescribeid};";

		if($connect->multi_query($sql)){

			do {
				if ($result = $connect->store_result()){

			        while ($row = $result->fetch_assoc()){
						
						$priceMed = $row['medPrice'];
						$priceTreat = $row['treatPrice'];
						//echo "User ID is ".$user_id;
			        }
			      $result->free();
			    }
			} while ($connect->next_result());

			$_SESSION['editAmount'] = $priceMed + $priceTreat * $quantity;

			header('location: editBilling.php?PrescribeID='. $prescribeid);

			$valid['success'] = true;
			$valid['messages'] = "Update Prescribe Patient ";
		} else {

			$valid['success'] = false;
			$valid['messages'] = $connect->error;
		}

		/*if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Prescribe Patient";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while Prescribe";
		}*/

	}

	$connect->close();

	echo json_encode($valid);
?>