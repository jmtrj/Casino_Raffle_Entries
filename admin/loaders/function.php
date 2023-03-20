<?php

session_start();
include 'conn.php';



if (isset($_POST['add'])) {

  $Firstname = $_POST['Firstname'];
  $Lastname = $_POST['Lastname'];
  $Email = $_POST['Email'];
  $Status = $_POST['Status'];
  $Hub = $_POST['Hub'];

    // Create temporary password
  $string = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3).substr(str_shuffle('0123456789'), 0, 9);
  $Password = md5($string);

  // Send email with temporary password
  $to = $Email;
  $from = 'Lexusgaming@gmail.com';
  $fromName = 'LEXUS GAMING';
  $subject = 'DTR ACCOUNT';
  $htmlContent = '<br>
              <p style="font-size: 14px; color: #ffffff;  line-height: 150%;">
              <span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;">Email: '.$Email.'</span></p>
              <p style="font-size: 14px; color: #ffffff; line-height: 150%;">
              <span style="font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;">Temporary-Password: '.$string.'</span></p>';
  $headers = "From: $fromName < $from >\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  mail($to, $subject, $htmlContent, $headers);
     

  // Check if email already exists in the database
  $sql = "SELECT * FROM tblloader WHERE Email=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $Email);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($res) > 0){
      $_SESSION['status']="Email Already Exist!";
      $_SESSION['status_code']="error";
      header('Location: ../loader.php');
  }else{
    // Insert new user into the database
    $sql = "INSERT INTO `tblloader` (`Id`, `Firstname`, `Lastname`, `Email`, `Password`, `Status`, `Created_On`, `Balance`, `Hub`) VALUES (NULL, ?, ?, ?, ?, ?, now(), '', ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $Firstname, $Lastname, $Email, $Password, $Status, $Hub);
      mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $_SESSION['status']="Successfully Added!";
  $_SESSION['status_code']="success";
  header('Location: ../loader.php');

}
}











if (isset($_POST['edit'])) {

  $Id = $_POST['Id'];
  $Firstname = $_POST['Firstname'];
  $Lastname = $_POST['Lastname'];
  $Email = $_POST['Email'];
  $Status = $_POST['Status'];
  $Hub = $_POST['Hub'];

  // Check if email already exists in the database
  $sql = "SELECT * FROM tblloader WHERE Email=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $Email);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($res) > 1){
      $_SESSION['status']="Email Already Exist!";
      $_SESSION['status_code']="error";
      header('Location: ../loader.php');
  } else {
    // Update user in the database
    $sql = "UPDATE tblloader SET Firstname=?, Lastname=?, Email=?, Status=?, Hub=? WHERE tblloader.Id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $Firstname, $Lastname, $Email, $Status,  $Hub, $Id);
    if(mysqli_stmt_execute($stmt)){
      $_SESSION['status']="Successfully Updated!";
      $_SESSION['status_code']="success";
      header('Location: ../loader.php');
    } else {
      $_SESSION['status']=mysqli_stmt_error($stmt);
      $_SESSION['status_code']="error";
      header('Location: ../loader.php');
    }
    mysqli_stmt_close($stmt);
  }
}



if (isset($_POST['reset'])) {
  $Id = $_POST['Id'];
  $string = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3).substr(str_shuffle('0123456789'), 0, 9);
  $Password = md5($string);
  
  $stmt = $conn->prepare("UPDATE tblloader SET Password = ? WHERE tblloader.Id = ?");
  $stmt->bind_param("si", $Password, $Id);
  
  if ($stmt->execute()) {
    $_SESSION['status']="Sucessfully Send!";
    $_SESSION['status_code']="success";
    header('Location: ../loader.php');
  } else {
    $_SESSION['status']=$conn->error;
    $_SESSION['status_code']="error";
    header('Location: ../loader.php');
  }
  
  $stmt->close();
}




if (isset($_POST['addcoupon'])) {

  $Loadername = $_POST['Loadername'];
  $Loadbyadmin = $_POST['Loadbyadmin'];
  $Loadamount = $_POST['Loadamount'];

  $sql = "SELECT Balance FROM tblloader WHERE Id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $Loadername);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();

  $Balance = $row['Balance'];

  if ($Balance == '0') {

    $sql = "INSERT INTO tblload (Loadtoloader, Loadfromadmin, Dateofload, Amountofload) VALUES (?, ?, now(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $Loadername, $Loadbyadmin, $Loadamount);
    $stmt->execute();

    $sql = "UPDATE tblloader SET Balance = ? WHERE Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Loadamount, $Loadername);
    $stmt->execute();

    $_SESSION['status']="Successfully Added!";
    $_SESSION['status_code']="success";
    header('Location: ../loader.php');

  } else {

    $Total = $Balance + $Loadamount;

    $sql = "INSERT INTO tblload (Loadtoloader, Loadfromadmin, Dateofload, Amountofload) VALUES (?, ?, now(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $Loadername, $Loadbyadmin, $Loadamount);
    $stmt->execute();

    $sql = "UPDATE tblloader SET Balance = ? WHERE Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Total, $Loadername);
    $stmt->execute();

    $_SESSION['status']="Successfully Added!";
    $_SESSION['status_code']="success";
    header('Location: ../loader.php');

  }
  
}



  ?>