<?php
include 'conn.php';

$output= array();
$sql = "SELECT *, tblplayerload.Id as Ids FROM `tblplayerload` JOIN tblloader ON tblplayerload.Loadfromloader = tblloader.Id JOIN tblplayer ON tblplayerload.Loadtoplayer = tblplayer.Id  ";


$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
   
	0 => 'tblplayer.User_Id', 'tblplayer.Name',
	1 => 'tblplayerload.Dateofload',
	2 => 'tblplayerload.Amoutofload',
	3 => 'tblloader.Firstname','tblloader.Lastname',

 
);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE tblplayer.User_Id like ? OR tblplayer.Name like ?";
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
    $sql .= " ORDER BY Ids desc";
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
    $sub_array[] = '<small class="badge badge-danger"><i class="far fa-award"></i>'.$row['Firstname'].''.$row['Lastname'].'</small> ';
	$sub_array[] = '<small class="badge badge-info"><i class="far fa-award"></i>'.$row['User_Id'].'</small> ';
	$sub_array[] = $row['Dateofload'];
	$sub_array[] = $row['Amoutofload'];
    $data[] = $sub_array;
}

$output = array(
    'draw'=> intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);

