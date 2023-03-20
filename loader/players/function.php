<?php
session_start();
include 'conn.php';

if (isset($_POST['addcoupon'])) {

  $Balance = $_POST['Balance'];
  $Playername = $_POST['Playername'];
  $Loadbyadmin = $_POST['Loadbyadmin'];
  $Loadamount = $_POST['Loadamount'];

  $sql = "SELECT * FROM `tblplayer` WHERE tblplayer.Id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $Playername);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();
  $Numberofcoupon = $row['Numberofcoupon'];

  if ($Balance < $Loadamount) {
    $_SESSION['status'] = "Not enough balance";
    $_SESSION['status_code'] = "error";
    header('Location: ../player.php');
  } else {
    $sql = "SELECT * FROM `tblloader` WHERE tblloader.Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Loadbyadmin);
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = $res->fetch_assoc();
    $Updatebalance = $rows['Balance'] - $Loadamount;

    if ($row['Numberofcoupon'] == '0') {
      $query = mysqli_prepare($conn, "INSERT INTO `tblplayerload` (`Id`, `Loadtoplayer`, `Loadfromloader`, `Dateofload`, `Amoutofload`) VALUES (NULL, ?, ?, now(), ?)");
      $query->bind_param("sss", $Playername, $Loadbyadmin, $Loadamount);
      $query->execute();

      $query = mysqli_prepare($conn, "UPDATE tblloader SET Balance = ? WHERE tblloader.Id=?");
      $query->bind_param("ss", $Updatebalance, $Loadbyadmin);
      $query->execute();

      $query = mysqli_prepare($conn, "UPDATE tblplayer SET Numberofcoupon = ? WHERE tblplayer.Id=?");
      $query->bind_param("ss", $Loadamount, $Playername);
      $query->execute();

      $_SESSION['status'] = "Successfully added!";
      $_SESSION['status_code'] = "success";
      header('Location: ../player.php');
    } else {
      $Total = $Numberofcoupon + $Loadamount;

      $query = mysqli_prepare($conn, "UPDATE tblloader SET Balance = ? WHERE tblloader.Id=?");
      $query->bind_param("ss", $Updatebalance, $Loadbyadmin);
      $query->execute();

      $query = mysqli_prepare($conn, "INSERT INTO `tblplayerload` (`Id`, `Loadtoplayer`, `Loadfromloader`, `Dateofload`, `Amoutofload`) VALUES (NULL, ?, ?, now(), ?)");
      $query->bind_param("sss", $Playername, $Loadbyadmin, $Loadamount);
      $query->execute();

      $query = mysqli_prepare($conn, "UPDATE tblplayer SET Numberofcoupon = ? WHERE tblplayer.Id=?");
      $query->bind_param("ss", $Total, $Playername);
      $query->execute();

      $_SESSION['status'] = "Successfully added!";
      $_SESSION['status_code'] = "success";
      header('Location: ../player.php');
    }
  }
}
?>
