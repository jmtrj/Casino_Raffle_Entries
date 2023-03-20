
<?php
require 'includes/conn.php';


$query = "SELECT Prize, Percentage FROM tblroullete WHERE Status = ?";
$stmt = mysqli_prepare($conn, $query);
$status = "ACTIVE";
mysqli_stmt_bind_param($stmt, "s", $status);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $items[$row['Prize']] = $row['Percentage'];
}

echo json_encode($items);
?> 