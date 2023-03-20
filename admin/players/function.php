<?php

session_start();
include 'conn.php';


if (isset($_POST['add'])) {
  $User_Id = $_POST['User_Id'];
  $Loginname = $_POST['Loginname'];
  $Name = $_POST['Name'];
  $Contactnumber = $_POST['Contactnumber'];
  $Status = $_POST['Status'];
  $Hub = $_POST['Hub'];
  $password = md5(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . substr(str_shuffle('0123456789'), 0, 9));

  $sql = "SELECT * FROM tblplayer WHERE User_Id=? or Loginname=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ss', $User_Id, $Loginname);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($res) > 0){
      $_SESSION['status']="User_Id or Loginname Already Exist!";
      $_SESSION['status_code']="error";
      header('Location: ../player.php');
  }else{
    $sqlInsert = "INSERT INTO `tblplayer` (`Id`, `User_Id`, `Loginname`, `Name`, `Password`, `Contactnumber`, `Status`, `Created_On`, `Numberofcoupon`, `Validturnover`, `Hub`) VALUES (NULL, ?, ?, ?, ?, ?, ?, now(), '', '', ?)";
    $stmtInsert = mysqli_prepare($conn, $sqlInsert);
    mysqli_stmt_bind_param($stmtInsert, 'sssssss', $User_Id, $Loginname, $Name, $password, $Contactnumber, $Status, $Hub);
    $result = mysqli_stmt_execute($stmtInsert);

    if ($result) {
        $_SESSION['status']="Successfully Added!";
        $_SESSION['status_code']="success";
        header('Location: ../player.php');
    } else {
        $_SESSION['status']="Problem in Adding Data!";
        $_SESSION['status_code']="error";
        header('Location: ../player.php');
    }
  }
}


if (isset($_POST['edit'])) {

  $Id = $_POST['Id'];
  $User_Id = $_POST['User_Id'];
  $Loginname = $_POST['Loginname'];
  $Name = $_POST['Name'];
  $Contactnumber = $_POST['Contactnumber'];
  $Status = $_POST['Status'];
  $Hub = $_POST['Hub'];

  $sql = "SELECT * FROM tblplayer WHERE User_Id=? OR Loginname=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ss', $User_Id, $Loginname);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($res) > 1){
    $_SESSION['status']="User_Id Already Exist! or Loginname";
    $_SESSION['status_code']="error";
    header('Location: ../player.php');
  } else {
    $sql = "UPDATE tblplayer SET User_Id=?, Hub=?, Loginname=?, Name=?, Contactnumber=?, Status=? WHERE tblplayer.Id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $User_Id, $Hub, $Loginname, $Name, $Contactnumber, $Status, $Id);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      $_SESSION['status']="Sucessfully Update!";
      $_SESSION['status_code']="success";
      header('Location: ../player.php');
    } else {
      $_SESSION['status']=$conn->error;
      $_SESSION['status_code']="error";
      header('Location: ../player.php');
    }
  }
}



if (isset($_POST['upload'])) {
    $password = md5(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . substr(str_shuffle('0123456789'), 0, 9));
    $file = fopen($_FILES['file']['tmp_name'], 'r');
    if ($file) {
        while (($row = fgetcsv($file, 10000, ',')) !== false) {

          $sql = "SELECT * FROM tblplayer WHERE User_Id=? OR Loginname=?";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, 'ss', $row[0], $row[1]);
          mysqli_stmt_execute($stmt);
          $res = mysqli_stmt_get_result($stmt);
          if(mysqli_num_rows($res) > 0){
              $_SESSION['status']="User_Id or Loginname Already Exist!";
              $_SESSION['status_code']="error";
          }
         else {
            $sqlInsert = 'INSERT INTO tblplayer (User_Id, Loginname, Name, Password, Contactnumber, Status, Hub) VALUES (?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($conn, $sqlInsert);
            mysqli_stmt_bind_param($stmt, 'sssssss', $row[0], $row[1], $row[2], $password, $row[3], $row[4], $row[5]);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $_SESSION['status'] = 'Import Successfully';
                $_SESSION['status_code'] = 'success';
            } else {
                $_SESSION['status'] = 'Problem in Importing CSV Data';
                $_SESSION['status_code'] = 'error';
            }
        }
    }
        fclose($file);
    }
    header('Location: ../player.php');
}








if (isset($_POST['uploadvto'])) {
    $file = fopen($_FILES['file']['tmp_name'], 'r');
    if ($file) {
    while (($row = fgetcsv($file, 10000, ',')) !== false) {
    $User_Id = $row[0];
    $Vto = $row[1];
   

       $sql = "SELECT * FROM tblplayer WHERE User_Id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $User_Id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if ($res) {
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    if ($row['Validturnover'] == '0') {
                         $New = floor($Vto / 1000);
                         $Total = $row['Numberofcoupon'] + $New;
                        $sql = "UPDATE tblplayer SET Validturnover=?, Numberofcoupon=? WHERE User_Id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'iss', $Vto, $Total, $User_Id);
                        if (mysqli_stmt_execute($stmt)) {
                            $_SESSION['status'] = "Successfully updated VTO!";
                            $_SESSION['status_code'] = "success";
                        } else {
                            $_SESSION['status'] = mysqli_error($conn);
                            $_SESSION['status_code'] = "error";
                        }
                    } else {
                        $_SESSION['status'] = "Please reset VTO before upload.";
                        $_SESSION['status_code'] = "error";
                    }
                } else {
                    $_SESSION['status'] = "Cannot find User_Id!";
                    $_SESSION['status_code'] = "error";
                }
            }
        }
        fclose($file);
    }
    header('Location: ../player.php');



    }













if (isset($_POST['reset'])) {
    // Validate user input
        $stmt = $conn->prepare("UPDATE `tblplayer` SET `Validturnover`='0'");
        if ($stmt) {
            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['status'] = "Reset Successfully";
                $_SESSION['status_code'] = "success";
                header('Location: ../player.php');
            } else {
                $_SESSION['status'] = "An error occurred";
                $_SESSION['status_code'] = "error";
                header('Location: ../player.php');
            }
        } else {
            $_SESSION['status'] = "An error occurred";
            $_SESSION['status_code'] = "error";
            header('Location: ../player.php');
        }
    }


  ?>