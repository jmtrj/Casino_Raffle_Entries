<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$email = $_POST['Email'];
		$password = $_POST['Password'];

		$sql = "SELECT * FROM tblloader WHERE Email = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the Email';
		}
		else{
			$row = $result->fetch_assoc();
			if ($row['Status'] =='ACTIVE') {
				if(password_verify($password, $row['Password'])){
				$_SESSION['loader'] = $row['Id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
			
			}else{
				$_SESSION['error'] = 'Your account is not active please contact admin';

			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input loaders credentials first';
	}
	header('location: index.php');
?>
