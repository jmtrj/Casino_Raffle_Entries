<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['player']) || trim($_SESSION['player']) == ''){
		header('location: ../Index.php');
	}

	$sql = "SELECT * FROM  tblplayer WHERE Id = ?";
	$stmt = $conn->prepare($sql);

	// Bind the session variable to the statement
	$id = $_SESSION['player'];
	$stmt->bind_param("i", $id);

	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	












	
	
?>