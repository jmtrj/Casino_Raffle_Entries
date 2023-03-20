<?php
include 'conn.php';


$Hub = $_POST['Hub'];   


$output= array();
$sql = "SELECT * FROM `tblplayer` WHERE Hub ='$Hub' ";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'User_Id',
	1 => 'Loginname',
	2 => 'Name',
	3 => 'Contactnumber',
	4 => 'Status',
	5 => 'Created_On',
	6 => 'Numberofcoupon',
    7 => 'Hub',
 
);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " and (User_Id like ? OR Name like ?)";
    $search_value = "%{$search_value}%";
}

if(isset($_POST['order']))
{
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
    $sql .= " ORDER BY Id desc";
}

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

$query = mysqli_prepare($conn, $sql);
if (isset($search_value)) {
    mysqli_stmt_bind_param($query, "ss", $search_value, $search_value);
}
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

$count_rows = mysqli_num_rows($result);
$data = array();
while($row = mysqli_fetch_assoc($result))
{
    $sub_array = array();
    $sub_array[] = $row['User_Id'];
	$sub_array[] = $row['Loginname'];
	$sub_array[] = $row['Name'];
	$sub_array[] = $row['Contactnumber'];
	$sub_array[] = $row['Status'];
	$sub_array[] = $row['Created_On'];
	$sub_array[] = $row['Numberofcoupon'];
    $sub_array[] = $row['Hub'];



	$sub_array[] = '<a href="javascript:void();"  data-id="'.$row['Id'].'"   class="btn btn-success btn-sm add" > <i class="fa fa-plus"></i> Add coupon</a>';
    $data[] = $sub_array;
}

$output = array(
    'draw'=> intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);

