<?php 

include 'conn.php';

if(isset($_POST['id'])){
  $id = $_POST['id'];

  // Prepare the SQL query with a placeholder
  $sql = "SELECT * FROM `tblloader` WHERE tblloader.Id = ?";
  $stmt = $conn->prepare($sql);

  // Bind the value of $id to the placeholder
  $stmt->bind_param("i", $id);

  // Execute the prepared statement
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Fetch the row as an associative array
  $row = $result->fetch_assoc();

  // Encode the row as JSON and output it
  echo json_encode($row);
}
?>