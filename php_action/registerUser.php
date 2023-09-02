<?php
	session_start();
	require_once 'db_connect.php';

	if ($_POST) {

		$valid['success'] = array('success' => false, 'messages' => array());

		$_SESSION['register'] = $_POST;

		/*$name = $_POST['name'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$no_phone = $_POST['noPhone'];
		$addrss = $_POST['address'];*/
		$ic = $_POST['ic_No'];
		$role = $_POST['role'];
		$password = md5($_POST['password']);
		$cpassword = md5($_POST['cpassword']);


		if ($password == $cpassword) {

			$sql = "INSERT INTO user (No_ID,pswd,Role) VALUES ('$ic','$password','$role');";
			$sql .= "SELECT * FROM user WHERE No_ID = {$ic}";

			if ($connect->multi_query($sql)) {

				do {
					if ($result = $connect->store_result()){

				        while ($row = $result->fetch_assoc()){
							
							$user_id = $row['User_ID'];
							//echo "User ID is ".$user_id;
				   
				         }
				      $result->free();
				    }
				} while ($connect->next_result());

				//redirect to insert data
				header('location: registerClinic.php?User_ID='. $user_id);
				
			}else{
				$valid['messages'] = "Identity No. already Registered";//.$connect->error;
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "password does not match with confirm password";
		}
		
		$connect->close();
		echo json_encode($valid);
	}
?>