<?php
require 'includes/conn.php';

$PlayerId = $_POST["PlayerId"];

$sql = "SELECT Numberofcoupon FROM tblplayer WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PlayerId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo $user['Numberofcoupon'];

$conn->close();
?>