<?php

session_start();
include 'conn.php';




if (isset($_POST['addcoupon'])) {

  $Loadername = $_POST['Loadername'];
  $Loadbyadmin = $_POST['Loadbyadmin'];
  $Loadamount = $_POST['Loadamount'];
  
  
  $sql = "SELECT * FROM `tblload` WHERE tblload.Loadtoloader='$Loadername'  ORDER BY Id desc ";
  $res = mysqli_query($conn, $sql);
  $row = $res->fetch_assoc();

  $Balance = $row['Balance'];

  if ($row['Balance'] == '') {
    

  $query = mysqli_query($conn, "INSERT INTO `tblload` (`Id`, `Loadtoloader`, `Loadfromadmin`, `Dateofload`, `Amountofload`, `Balance`) VALUES (NULL, $Loadername, $Loadbyadmin, now(), $Loadamount, $Loadamount)");

  $_SESSION['status']="Sucessfully Added!";
  $_SESSION['status_code']="success";
   header('Location: ../admintransac.php');




  }else {


$Total = $Balance + $Loadamount;

  $query = mysqli_query($conn, "INSERT INTO `tblload` (`Id`, `Loadtoloader`, `Loadfromadmin`, `Dateofload`, `Amountofload`, `Balance`) VALUES (NULL, '$Loadername', '$Loadbyadmin', now(), '$Loadamount', '$Total')");

  $_SESSION['status']="Sucessfully Added!";
  $_SESSION['status_code']="success";
  header('Location: ../admintransac.php');



  }








  
}




  ?>