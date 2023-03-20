<?php

session_start();
include 'conn.php';

if (isset($_POST['Approved'])) {

  date_default_timezone_set('Asia/Manila');

  $Id = $_POST['Id'];
  $ApprovedBy = $_POST['ApprovedBy'];
  $sql = "SELECT * FROM `tblwinner` WHERE tblwinner.Id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $Id);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();
  $Approvedate = "Approved:" . date("Y-m-d h:i:sa");
  $Remarksdate =  $row['Remarksdate'].'>'.$Approvedate;
  $photo = $_FILES['file']['name'];
  $filename = $photo; 

  $query = mysqli_query($conn, "UPDATE tblwinner SET Status = 'Approved', Remarksdate = ?, Approvedby = ?, Proof = ? WHERE tblwinner.Id = ?");
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssi", $Remarksdate, $ApprovedBy, $filename, $Id);
  $stmt->execute();

  move_uploaded_file($_FILES['file']['tmp_name'], '../image/'.$photo);
  $_SESSION['status'] = "Successfully Approved!";
  $_SESSION['status_code'] = "success";
  header('Location: ../approval.php');
}

?>