<?php
include 'conn.php';

$Id = $_POST["Id"];
$output = array();
$sql = "SELECT * FROM `tblwinner`  where PlayerId='$Id' ";

$totalQuery = mysqli_query($conn, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
   	0 => 'Prize',
	1 => 'Status',
	2 => 'Proof',
	3 => 'Remarksdate',
	4 => 'Voucher',

);

$bindParams = array();

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " and (Prize like ? OR Voucher like ?)";
    $search_value = '%'.$search_value.'%';
    $bindParams[] = &$search_value;
    $bindParams[] = &$search_value;
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
} else {
    $sql .= " ORDER BY Id desc";
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
  	$status =
   ($row['Prize'] == 'Bokya' )  ? 
  '<small class="badge badge-warning"><i class="far fa-award"></i>Bokya</small>' 


  : ($row['Status'] == 'Pending' ? 
  '
  <a href="javascript:void();"  data-id="'.$row['Id'].'"   class="btn btn-success btn-sm claim" > 
  <i class="fa fa-award"></i> Claim</a>' 

  : '<small class="badge badge-warning"><i class="far fa-award"></i>Claimed</small>'

);




 $Proof = ($row['Proof'] == '' ? 
  '<small class="badge badge-danger"><i class="far fa-award"></i>Empty</small>' 
  : 
  '<a href="../loader/image/'.$row['Proof'].'"  download="'.$row['Proof'].'"  " > <i class="fa fa-download"></i>Download </a>'
  );

	$sub_array[] = $row['Prize'];
	$sub_array[] = '<small class="badge badge-secondary"><i class="far fa-award"></i>'.$row['Status'].'</small>';
	$sub_array[] = $row['Remarksdate'];
	$sub_array[] = $Proof;
	$sub_array[] = $row['Voucher'];
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