<?php

session_start();
include 'conn.php';

if (isset($_POST['addclaim'])) {
  date_default_timezone_set('Asia/Manila');

  $letterss = '';
  $numberss = '';
  foreach (range('A', 'Z') as $char) {
    $letterss .= $char;
  }
  for($i = 0; $i < 10; $i++){
    $numberss .= $i;
  }

  $string = substr(str_shuffle($letterss), 0, 3).substr(str_shuffle($numberss), 0, 9);

  $WinnerId = $_POST['WinnerId'];
  $Remarksdate = "Claim:" . date("Y-m-d h:i:sa");

  $stmt = $conn->prepare("UPDATE `tblwinner` SET `Status`=?, `Remarksdate`=?, `Voucher`=? WHERE `tblwinner`.`Id` = ?");
  $status = 'Waiting for approval';
  $stmt->bind_param("sssi", $status, $Remarksdate, $string, $WinnerId);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION['status']="Sucessfully claim, Wait for approval";
    $_SESSION['status_code']="success";
    header('Location: ../claimprize.php');
  } else {
    $_SESSION['status']="Failed to claim prize";
    $_SESSION['status_code']="error";
    header('Location: ../claimprize.php');
  }

  $stmt->close();
}

?>
