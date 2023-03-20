<?php

session_start();
include 'conn.php';



if (isset($_POST['add'])) {

  $Prizename = $_POST['Prizename'];
  $Percentage = $_POST['Percentage'];
  $Status = $_POST['Status'];
  
  $stmt = mysqli_prepare($conn, "INSERT INTO `tblroullete` (`Id`, `Prize`, `Percentage`, `Status`) VALUES (NULL, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, 'sss', $Prizename, $Percentage, $Status);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $_SESSION['status']="Successfully Added!";
  $_SESSION['status_code']="success";
  header('Location: ../machine.php');
}





if (isset($_POST['edit'])) {
  $Id = $_POST['Id'];
  $Prizename = $_POST['Prizename'];
  $Percentage = $_POST['Percentage'];
  $Status = $_POST['Status'];

  $stmt = mysqli_prepare($conn, "UPDATE tblroullete SET Prize = ?, Percentage = ?, Status = ? WHERE tblroullete.Id = ?");
  mysqli_stmt_bind_param($stmt, 'sssi', $Prizename, $Percentage, $Status, $Id);

  if(mysqli_stmt_execute($stmt)){
    $_SESSION['status']="Successfully Updated!";
    $_SESSION['status_code']="success";
    header('Location: ../machine.php');
  }else{
    $_SESSION['status']= mysqli_stmt_error($stmt);
    $_SESSION['status_code']="error";
    header('Location: ../machine.php');
  }

  mysqli_stmt_close($stmt);
}









  ?>