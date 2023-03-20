<?php
session_start();
include 'includes/conn.php';

date_default_timezone_set('Asia/Manila');

if(isset($_POST["Employeeadd"])){


           $Firstname = $_POST['Firstname'];
           $Lastname = $_POST['Lastname'];
           $Status = $_POST['Status'];
           $Type = $_POST['Type'];

			$sql = "INSERT INTO `employeelist` (`Id`, `Firstname`, `Lastname`, `Status`, `Type`) VALUES (NULL, '$Firstname', '$Lastname', '$Status', '$Type')";
				 $result = mysqli_query( $conn, $sql );

	         $_SESSION['success'] = 'successfully added';
			header('location: Employeelist.php');

		 
	}	


if(isset($_POST["employeedit"])){


		   $id = $_POST['Id'];
    	   $Firstname = $_POST['Firstname'];
           $Lastname = $_POST['Lastname'];
           $Status = $_POST['Status'];
           $Type = $_POST['Type'];
		
		$sql = "UPDATE employeelist SET Firstname = '$Firstname', Lastname = '$Lastname', Status= '$Status', Type = '$Type' WHERE Id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Updated successfully';
			header('location: Employeelist.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
			header('location: Employeelist.php');
		}


	}
	


if(isset($_POST["Attendanceadd"])){

$Id = $_POST['Id'];
$Timein = $_POST['Timein'];
$Timeout = $_POST['Timeout'];

$Date = $_POST['Date'];


$query=mysqli_query($conn, "SELECT * FROM `dtr` JOIN employeelist ON dtr.EmployeId = employeelist.Id  where  dtr.EmployeId='$Id' and Date = '$Date' ") or die(mysqli_error()); 
$row=mysqli_fetch_array($query);


if ($row['Timein'] == '' && $row['Timeout'] == '') {

            $sql = "INSERT INTO `dtr` (`Id`, `Timein`, `Timeout`, `EmployeId`, `Date`) VALUES (NULL, '$Timein', '$Timeout', '$Id', '$Date')";
            $result = mysqli_query( $conn, $sql );

            $_SESSION['success'] = 'Added successfully';
            header('location: Attendance.php');
  
}else
{
       		$_SESSION['error'] = 'Already Have Timein or Timeout';
            header('location: Attendance.php');

}




}








if(isset($_POST["Attendanceedit"])){


		 $Id = $_POST['Id'];
    	 $Timein = $_POST['Timein'];
         $Timeout = $_POST['Timeout'];
         $Date= $_POST['Date'];
         $Type = $_POST['Type'];


		
		$sql = "UPDATE dtr SET `Timein` = '$Timein', `Timeout` = '$Timeout', `Date`= '$Date' WHERE Id = '$Id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Updated successfully';
			header('location: Attendance.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
			header('location: Attendance.php');
		}


	}
	

 //close of connection
			mysqli_close($conn); 





?>		 