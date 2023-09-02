<?php 
	require_once 'core.php';

	if($_POST){

		$valid['success'] = array('success' => false, 'messages' => array());

		$medName = $_POST['medicineName'];
		$appt_id = $_POST['appt_id'];
		$quantity = $_POST['quantity'];
		$dose = $_POST['dose'];
		$desc = $_POST['desc'];

		$sql = "INSERT INTO prescribe (Appt_ID, med_ID, quantity, Dose, description) VALUES
				('$appt_id','$medName', '$quantity', '$dose', '$desc');";

		$sql .= "SELECT Price medPrice FROM medicine WHERE medicine_ID = {$medName};";

		$sql .= "SELECT T.price treatPrice FROM appointment A JOIN treatment T ON T.Treatment_ID = A.Treatment_ID 
				WHERE A.APPT_ID = {$appt_id}";

		if($connect->multi_query($sql)){

			$prescribe_id = mysqli_insert_id($connect);

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


			$_SESSION['amount'] = $priceMed + $priceTreat * $quantity;

			header('location: addBilling.php?PrescribeID='. $prescribe_id);

			$valid['success'] = true;
			$valid['messages'] = "Successfully Prescribe Patient ";
		} else {

			$valid['success'] = false;
			$valid['messages'] = "Error while Prescribe ";//.$connect->error();
		}

	}

	$connect->close();

	echo json_encode($valid);
?>