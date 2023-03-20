<?php
require 'includes/conn.php';

$stmt = $conn->prepare("SELECT Prize FROM `tblroullete`");
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
  array_push($items, $row['Prize']);
}

echo json_encode(array("items" => $items)); 
?>