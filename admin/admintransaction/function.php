<?php

session_start();
include 'conn.php';

if (isset($_POST['addcoupon'])) {

  $Loadername = $_POST['Loadername'];
  $Loadbyadmin = $_POST['Loadbyadmin'];
  $Loadamount = $_POST['Loadamount'];

  // Use prepared statement to avoid SQL injection
  $sql = "SELECT * FROM `tblloader` WHERE tblloader.Id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'i', $Loadername);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = $res->fetch_assoc();

  $Balance = $row['Balance'];

  if ($row['Balance'] == '') {
    

  // Use prepared statement to avoid SQL injection
  $stmt = mysqli_prepare($conn, "INSERT INTO `tblload` (`Id`, `Loadtoloader`, `Loadfromadmin`, `Dateofload`, `Amountofload`) VALUES (NULL, ?, ?, now(), ?)");
  mysqli_stmt_bind_param($stmt, 'iii', $Loadername, $Loadbyadmin, $Loadamount);
  mysqli_stmt_execute($stmt);

  // Use prepared statement to avoid SQL injection
  $stmt = mysqli_prepare($conn, "UPDATE tblloader SET Balance = ? WHERE tblloader.Id=?");
  mysqli_stmt_bind_param($stmt, 'ii', $Loadamount, $Loadername);
  mysqli_stmt_execute($stmt);

  $_SESSION['status']="Sucessfully Added!";
  $_SESSION['status_code']="success";
  header('Location: ../admintransac.php');

  } else {

  $Total = $Balance + $Loadamount;

  // Use prepared statement to avoid SQL injection
  $stmt = mysqli_prepare($conn, "INSERT INTO `tblload` (`Id`, `Loadtoloader`, `Loadfromadmin`, `Dateofload`, `Amountofload`) VALUES (NULL, ?, ?, now(), ?)");
  mysqli_stmt_bind_param($stmt, 'iii', $Loadername, $Loadbyadmin, $Loadamount);
  mysqli_stmt_execute($stmt);

  // Use prepared statement to avoid SQL injection
  $stmt = mysqli_prepare($conn, "UPDATE tblloader SET Balance = ? WHERE tblloader.Id=?");
  mysqli_stmt_bind_param($stmt, 'ii', $Total, $Loadername);
  mysqli_stmt_execute($stmt);

  $_SESSION['status']="Sucessfully Added!";
  $_SESSION['status_code']="success";
  header('Location: ../admintransac.php');
  }
}

?>