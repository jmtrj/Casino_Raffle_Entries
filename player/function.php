<?php
require 'includes/conn.php';

$winner = $_POST["winner"];
$PlayerId = $_POST["PlayerId"];

$sql = "SELECT * FROM tblplayer WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PlayerId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$Newcoupon = $user['Numberofcoupon'] - 1;

if ($winner == 'Bokya') {
    $sql = "INSERT INTO `tblwinner` (`Id`, `PlayerId`, `Prize`, `Status`, `Proof`, `Remarksdate`, `Approvedby`, `Voucher`, `Dateofspin`) VALUES (NULL, ?, ?, '', '', '', '', '', now())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $PlayerId, $winner);
    if ($stmt->execute()) {
        echo "Data inserted successfully";
        $queryt = "UPDATE `tblplayer` SET `Numberofcoupon`=? WHERE `tblplayer`.`Id` = ?";
        $stmt = $conn->prepare($queryt);
        $stmt->bind_param("ii", $Newcoupon, $PlayerId);
        $stmt->execute();
    } else {
        echo "Error inserting data: " . $conn->error;
    }
} else {
    $sql = "INSERT INTO `tblwinner` (`Id`, `PlayerId`, `Prize`, `Status`, `Proof`, `Remarksdate`, `Approvedby`, `Voucher` , `Dateofspin`) VALUES (NULL, ?, ?, 'Pending', '', '', '', '', now())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $PlayerId, $winner);
    if ($stmt->execute()) {
        echo "Data inserted successfully";
        $queryt = "UPDATE `tblplayer` SET `Numberofcoupon`=? WHERE `tblplayer`.`Id` = ?";
        $stmt = $conn->prepare($queryt);
        $stmt->bind_param("ii", $Newcoupon, $PlayerId);
        $stmt->execute();
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

$conn->close();
?>