<?php
include 'conn.php';

$Id = $_POST['Id'];	
$output = array();
$sql = "SELECT *, tblplayerload.Id as Ids FROM `tblplayerload` JOIN tblloader ON tblplayerload.Loadfromloader = tblloader.Id JOIN tblplayer ON tblplayerload.Loadtoplayer = tblplayer.Id  where tblplayerload.Loadfromloader= '$Id' ";

$totalQuery = mysqli_query($conn, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
   	0 => 'tblplayer.User_Id', 'tblplayer.Name',
	1 => 'tblplayerload.Dateofload',
	2 => 'tblplayerload.Amoutofload',


);

$bindParams = array();

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " and (tblplayer.User_Id like ? OR tblplayer.Name like ?)";
    $search_value = '%'.$search_value.'%';
    $bindParams[] = &$search_value;
    $bindParams[] = &$search_value;
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
} else {
    $sql .= " ORDER BY Ids desc";
}

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ?, ?";
    $bindParams[] = &$start;
    $bindParams[] = &$length;
}

$stmt = $conn->prepare($sql);

if (!empty($bindParams)) {
    $bindParams = array_merge(array(str_repeat('s', count($bindParams))), $bindParams);
    call_user_func_array(array($stmt, 'bind_param'), $bindParams);
}

$stmt->execute();
$query = $stmt->get_result();

$count_rows = mysqli_num_rows($query);
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['User_Id'];
	$sub_array[] = $row['Dateofload'];
	$sub_array[] = $row['Amoutofload'];
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);
?>