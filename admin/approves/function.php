<?php


session_start();
include 'conn.php';

if (isset($_POST['Approved'])) {

  date_default_timezone_set('Asia/Manila');

  $Id = $_POST['Id'];
  $ApprovedBy = $_POST['ApprovedBy'];
  $sql = "SELECT * FROM `tblwinner` WHERE tblwinner.Id = '$Id'";
  $res = mysqli_query($conn, $sql);
  $row = $res->fetch_assoc();
  $Approvedate = "Approved:" . date("Y-m-d h:i:sa");
  $Remarksdate =  $row =''.$row['Remarksdate'].'>'.$Approvedate;
  $photo = $_FILES['file']['name'];
  $filename = $photo; 

  $query = mysqli_query($conn, "UPDATE tblwinner SET Status = 'Approved', Remarksdate = '$Remarksdate', Approvedby = '$ApprovedBy', Proof = '$filename'   WHERE tblwinner.Id='$Id'");

   move_uploaded_file($_FILES['file']['tmp_name'], '../image/'.$photo);
  $_SESSION['status']="Sucessfully Approved!";
  $_SESSION['status_code']="success";
  header('Location: ../approval.php');



}


  ?>