<?php
session_start();
include 'conn.php';

if (isset($_POST['add'])) {

  $Description = $_POST['Description'];
  $Status = $_POST['Status'];
  
  $stmt = $conn->prepare("INSERT INTO `tblhub` (`Id`, `Description`, `Status`) VALUES (NULL, ?, ?)");
  $stmt->bind_param('ss', $Description, $Status);

  if ($stmt->execute()) {
    $_SESSION['status'] = "Successfully Added!";
    $_SESSION['status_code'] = "success";
    header('Location: ../hub.php');
  } else {
    $_SESSION['status'] = $conn->error;
    $_SESSION['status_code'] = "error";
    header('Location: ../hub.php');
  }

  $stmt->close();
  $conn->close();

}

if (isset($_POST['edit'])) {
  $Id = $_POST['Id'];
  $Description = $_POST['Description'];
  $Status = $_POST['Status'];

  $stmt = $conn->prepare("UPDATE tblhub SET Description = ?, Status = ? WHERE tblhub.Id = ?");
  $stmt->bind_param('ssi', $Description, $Status, $Id);

  if ($stmt->execute()) {
    $_SESSION['status'] = "Successfully Updated!";
    $_SESSION['status_code'] = "success";
    header('Location: ../hub.php');
  } else {
    $_SESSION['status'] = $conn->error;
    $_SESSION['status_code'] = "error";
    header('Location: ../hub.php');
  }

  $stmt->close();
  $conn->close();

}

?>
