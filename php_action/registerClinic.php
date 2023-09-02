<?php
	session_start();
	require_once 'db_connect.php';

	$valid['success'] = array('success' => false, 'messages' => array());
	
	$name = $_SESSION['register']['name'];
	$ic = $_SESSION['register']['ic_No'];
	$email = $_SESSION['register']['email'];
	$gender = $_SESSION['register']['gender'];
	$no_phone = $_SESSION['register']['noPhone'];
	$role = $_SESSION['register']['role'];
	$addrss = $_SESSION['register']['address'];

	$user_id = $_GET['User_ID'];

	if ($role == 1) {
		// insert clinic assistant data
		$sql = "INSERT INTO clinic_assistant (name,IC_no,gender,number,address,email,User_Id) VALUES ('$name','$ic','$gender','$no_phone','$addrss','$email','$user_id')";
	}elseif ($role == 2) {
		// insert doctor data
		$sql = "INSERT INTO doctor (name,IC_no,gender,number,address,email,User_Id) VALUES ('$name','$ic','$gender','$no_phone','$addrss','$email','$user_id')";
	}elseif ($role == 3) {
		// insert patient data
		$sql = "INSERT INTO patient (name,IC_no,gender,number,address,email,User_Id) VALUES ('$name','$ic','$gender','$no_phone','$addrss','$email','$user_id')";
	}
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Register";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while Register info";
	}

	$connect->close();

	echo json_encode($valid);
?>