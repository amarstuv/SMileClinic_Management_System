<?php 
	require_once 'core.php';

	$sql = "CALL fetchAllTreatment()";

	$result = $connect->query($sql);
	$output = array('data' => array());

	if($result->num_rows > 0) {

		$no = 1;

		while($row = $result->fetch_array()){

			$expDate = date("d-m-Y", strtotime($row[2]));
			$treatmentID = $row[0];

			$button = '<!-- Single button -->
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTreatment" onclick="editTreatment('.$treatmentID.')"><i class="glyphicon glyphicon-edit"></i></button>
					</div>';

			$output['data'][] = array(
				$no,
				$row[1],
				$row[2],
				$button
			);

			$no++;
		}
	}

	$connect->close();
	echo json_encode($output);
?>