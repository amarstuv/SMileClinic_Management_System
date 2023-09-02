<?php 

require_once 'core.php';

if($_POST) {

	
	$valid['success'] = array('success' => false, 'messages' => array());

	$user_id = $_POST['user_id'];
	$number = $_POST['numEdit'];
	$name = $_POST['nameEdit'];
	$email = $_POST['emailEdit'];
	$address = $_POST['addressEdit'];

	if (isset($_SESSION['Role']) && $_SESSION['Role'] == 1) {
		$sql = "UPDATE clinic_assistant SET name = '$name', email = '$email', number = '$number' , address = '$address' WHERE User_Id = {$user_id}";
	} elseif (isset($_SESSION['Role']) && $_SESSION['Role'] == 2) {
		$sql = "UPDATE doctor SET name = '$name', email = '$email', number = '$number' , address = '$address' WHERE User_Id = {$user_id}";
	} elseif (isset($_SESSION['Role']) && $_SESSION['Role'] == 3) {
		$sql = "UPDATE patient SET name = '$name', email = '$email', number = '$number' , address = '$address' WHERE User_Id = {$user_id}";
	}
	

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating info";
	}

	$connect->close();

	echo json_encode($valid);

}



?>