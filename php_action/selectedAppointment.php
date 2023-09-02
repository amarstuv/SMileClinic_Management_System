<?php 	

require_once 'core.php';

$Appt_ID = $_POST['Appt_ID'];

$sql = "SELECT APPT_ID, Date, Time, DocID FROM appointment WHERE APPT_ID = {$Appt_ID}";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);
?>