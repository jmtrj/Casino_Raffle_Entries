<?php

include 'conn.php';
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "SELECT * FROM `tblwinner` where tblwinner.Id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $query = $stmt->get_result();
  $row = $query->fetch_assoc();
  echo json_encode($row);
}
?>
