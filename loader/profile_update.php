<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if (isset($_POST['save'])) {

    $curr_password = $_POST['curr_password'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];

    $sql = "SELECT * FROM tblloader WHERE Email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $Email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($res) > 1) {
        $_SESSION['status'] = "Email Already Exist!";
        $_SESSION['status_code'] = "error";
    } else {
        if (password_verify($curr_password, $user['Password'])) {
            if ($Password == $user['Password']) {
                $Password = $user['Password'];
            } else {
                $Password = password_hash($Password, PASSWORD_DEFAULT);
            }

            $sql = "UPDATE tblloader SET Firstname=?, Lastname=?, Email=?, Password=? WHERE Id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssi', $Firstname, $Lastname, $Email, $Password,  $user['Id']);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = "Updated successfully";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['error'] = mysqli_error($conn);
            }
        } else {
            $_SESSION['status'] = "Incorrect password";
            $_SESSION['status_code'] = "error";
        }
    }
} else {
    $_SESSION['status'] = "Fill up required details first";
    $_SESSION['status_code'] = "error";
}


	header('location:'.$return);
?>