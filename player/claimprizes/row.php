<?php 

include 'conn.php';

if(isset($_POST['id'])){

	$id = $_POST['id'];
	$sql = "SELECT * FROM `tblwinner` WHERE `tblwinner`.`Id` = ?";
	
	if($stmt = $conn->prepare($sql)) {
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			echo json_encode($row);
		} else {
			echo "No records found.";
		}
	} else {
		echo "Error: " . $conn->error;
	}
}

?>
