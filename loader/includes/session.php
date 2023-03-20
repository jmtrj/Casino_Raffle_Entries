<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['loader']) || trim($_SESSION['loader']) == ''){
		header('location: index.php');
	}

	

	$sql = "SELECT * FROM  tblloader WHERE Id = ?";
	$stmt = $conn->prepare($sql);

	// Bind the session variable to the statement
	$id = $_SESSION['loader'];
	$stmt->bind_param("i", $id);

	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	
	














	
	
?>