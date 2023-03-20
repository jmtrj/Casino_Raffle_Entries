<?php
include 'conn.php';

$output = array();
$sql = "SELECT *, tblwinner.Id as Ids, tblwinner.Status as Stat  FROM `tblwinner` JOIN tblplayer  ON tblwinner.PlayerId = tblplayer.Id  JOIN tblloader ON  tblloader.Id = tblwinner.Approvedby  where tblwinner.Status= 'Approved' ";

$totalQuery = mysqli_query($conn, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
  	0 => 'User_Id',
	1 => 'Loginname',
	2 => 'Prize',
	3 => 'Remarksdate',
	4 => 'Stat',
	5 => 'tblloader.Firstname',  'tblloader.Lastname',
	6 => 'Proof',
	7 => 'Voucher',
    8 => 'Dateofspin',
    9 => 'Hub',
);

$bindParams = array();

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " and (tblplayer.User_Id like ? OR tblwinner.Voucher like ?)";
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

	$status = ($row['Stat'] == 'Approved' ? 
  '<small class="badge badge-success"><i class="far fa-award"></i>Approved</small>' 
  : 
  ''
  );


 $Proof = ($row['Proof'] == '' ? 
  '<small class="badge badge-success"><i class="far fa-award"></i>Empty</small>' 
  : 
  '<a href="../loader/image/'.$row['Proof'].'"  download="'.$row['Proof'].'"  " > <i class="fa fa-download"></i>Download </a>'
  );



	$sub_array[] = '<small class="badge badge-warning"><i class="far fa-award"></i>'.$row['User_Id'].'</small> ';  
	$sub_array[] = '<small class="badge badge-warning"><i class="far fa-award"></i>'.$row['Loginname'].'</small> ';
	$sub_array[] = $row['Prize'];
	$sub_array[] = $row['Remarksdate'];
	$sub_array[] = $row['Stat'];
	$sub_array[] = '<small class="badge badge-danger"><i class="far fa-award"></i>'.$row['Firstname'].''.$row['Lastname'].'</small> ';                              
	$sub_array[] = $Proof;
	$sub_array[] = $row['Voucher'];
    $sub_array[] = $row['Dateofspin'];
    $sub_array[] = $row['Hub'];


	$sub_array[] = $status;
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