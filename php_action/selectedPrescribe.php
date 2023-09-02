<?php
	require_once 'core.php';

	$prescribe_id = $_POST['prescribeID'];

	$sql = "SELECT R.PrescribeID, R.quantity, R.Dose, R.description, M.Name medName, P.name namePatient, T.Treat_Name treatName, 			M.medicine_ID
			FROM prescribe R
			JOIN appointment A ON A.APPT_ID = R.Appt_ID
			JOIN medicine M ON M.medicine_ID = R.med_ID
			JOIN patient P ON P.patient_ID = A.Patient_ID
            JOIN treatment T ON T.Treatment_ID = A.Treatment_ID WHERE PrescribeID = {$prescribe_id}";
            
    $result = $connect->query($sql);

    if($result->num_rows > 0){
    	$row = $result->fetch_array();
    }

	$connect->close();
	echo json_encode($row);
?>