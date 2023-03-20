<?php 

include 'conn.php';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$stmt = $conn->prepare("SELECT * FROM `tblhub` WHERE tblhub.Id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		echo json_encode($row);
	}
?>
