<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = ?";
	$stmt = $conn->prepare($sql);

	// Bind the session variable to the statement
	$id = $_SESSION['admin'];
	$stmt->bind_param("i", $id);

	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	
	
?>