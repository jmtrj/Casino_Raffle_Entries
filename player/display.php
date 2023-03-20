<?php
require 'includes/conn.php';

$items = array();
$query = "SELECT Prize FROM tblroullete WHERE Status = ?";
$status = 'ACTIVE';

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $status);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row['Prize'];
}

echo json_encode($items);




?>