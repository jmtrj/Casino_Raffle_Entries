<?php
session_start();
include 'includes/conn.php';

if(isset($_POST['login'])){
    $Loginname = $_POST['Loginname'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM tblplayer WHERE Loginname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Loginname);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows < 1){
        $_SESSION['error'] = 'Cannot find account with the Login Name';
    }
    else{
        $row = $result->fetch_assoc();
        if ($row['Status'] =='ACTIVE') {
            if(password_verify($password, $row['Password'])){
                $_SESSION['player'] = $row['Id'];
            }
            else{
                $_SESSION['error'] = 'Incorrect password';
            }
        }else{
            $_SESSION['error'] = 'Your account is not active please contact your agent';
        }
    }
}
else{
    $_SESSION['error'] = 'Input loaders credentials first';
}

$stmt->close();
$conn->close();

header('location: ../Index.php');

?>