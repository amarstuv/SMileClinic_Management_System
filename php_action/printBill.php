<?php

	require_once 'core.php';

	$payID = $_POST['payID'];

	$sql = "SELECT R.paid, R.Type, R.Date, B.Amount, Q.quantity, M.Name, P.name
			FROM payment R 
			JOIN bill B ON B.Bill_ID = R.bill_ID
			JOIN prescribe Q ON Q.PrescribeID = B.prescribe_ID
			JOIN medicine M ON M.medicine_ID = Q.med_ID
			JOIN appointment A ON a.APPT_ID = Q.Appt_ID
			JOIN patient P ON P.patient_ID = A.Patient_ID
			WHERE R.pay_ID = {$payID}";

	$result = $connect->query($sql);
	$row = $result->fetch_array();

	if($row[1] == 1){
		$type = "Cash";
	} elseif ($row[1] == 2){
		$type = "Online";
	} else {
		$type = "Card";
	}

	$paid = $row[0];
	$date = date("d-m-Y", strtotime($row[2]));
	$amount = $row[3];
	$quantity = $row[4];
	$medName = $row[5];
	$Name = $row[6];


	$resit = '
	<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<center><h2>Smile Clinic Management System</h2></center>
<br>
<br>
<h3>Receipt</h3>
	<table>
	 <tr> 
	 	<td> Name</td>
	    <td>'.$Name.'</td>
	    <td> Date </td>
	    <td>'.$date.'</td>
	 </tr>
	 <tr>
	  <td> Amount</td>
	    <td> RM '.$amount.'</td>
	    <td>Paid </td>
	    <td>RM '.$paid.'</td>
	 </tr>
	 <tr>
	  <td> Type Payment</td>
	    <td>'.$type.'</td>
	    <td> Medicine </td>
	    <td>'.$medName.'</td>
	 </tr>
	</table>
	<center><h2> Thank You For Use Our Service </h2></center>';

	$connect->close();

	echo $resit;

?>