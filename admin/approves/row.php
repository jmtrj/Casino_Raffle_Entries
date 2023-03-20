<?php 

include 'conn.php';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM `tblwinner` where tblwinner.Id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
	}
?>