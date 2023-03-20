<?php
include 'conn.php';
if(isset($_POST['id'])){
  $id = $_POST['id'];
  $stmt = mysqli_prepare($conn, "SELECT * FROM tblroullete WHERE tblroullete.Id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);

  mysqli_stmt_close($stmt);
}
?>
