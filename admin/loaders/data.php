<?php
include 'conn.php';

$output = array();
$sql = "SELECT * FROM `tblloader` ";

$totalQuery = mysqli_query($conn, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'Firstname',
    1 => 'Lastname',
    2 => 'Email',
    3 => 'Status',
    4 => 'Created_On',
    5 => 'Balance',
    6 => 'Hub',
);

$bindParams = array();

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE Firstname like ? OR Lastname like ?";
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
    $sub_array[] = $row['Firstname'];
    $sub_array[] = $row['Lastname'];
    $sub_array[] = $row['Email'];
    $sub_array[] = $row['Status'];
    $sub_array[] = $row['Created_On'];
    $sub_array[] = $row['Balance'];
    $sub_array[] = $row['Hub'];
    $sub_array[] = '<a href="javascript:void();"  data-id="'.$row['Id'].'"   class="btn btn-info btn-sm edit" > <i class="fa fa-edit"></i>  Edit</a> <a href="javascript:void();"  data-id="'.$row['Id'].'"   class="btn btn-warning btn-sm reset" > <i class="fa fa-edit"></i>  Reset Password</a>  <a href="javascript:void();"  data-id="'.$row['Id'].'"   class="btn btn-success btn-sm coupon" > <i class="fa fa-plus"></i>  Add Coupon</a>   ';
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