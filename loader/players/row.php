<?php

include 'conn.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$sql = "SELECT * FROM `tblplayer` WHERE tblplayer.Id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	echo json_encode($row);
}
?>
