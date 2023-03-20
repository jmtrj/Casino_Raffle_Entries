<?php
include 'conn.php';



    
$Hub = $_POST['Hub'];   


$output= array();
$sql = "SELECT *, tblwinner.Id as Ids, tblwinner.Status as Stat  FROM `tblwinner` JOIN tblplayer  ON tblwinner.PlayerId = tblplayer.Id  JOIN tblloader ON  tblloader.Id = tblwinner.Approvedby  where tblwinner.Status= 'Approved'  and tblplayer.hub ='$Hub'  ";

$totalQuery = mysqli_query($conn,$sql);
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
    8 => 'Hub',
 
);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " and (User_Id like ? OR Loginname like ?)";
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
   $status = ($row['Stat'] == 'Approved' ? 
  '<small class="badge badge-success"><i class="far fa-award"></i>Approved</small>' 
  : 
  ''
  );


 $Proof = ($row['Proof'] == '' ? 
  '<small class="badge badge-success"><i class="far fa-award"></i>Empty</small>' 
  : 
  '<a href="image/'.$row['Proof'].'"  download="'.$row['Proof'].'"  " > <i class="fa fa-download"></i>Download </a>'
  );

	$sub_array[] = '<small class="badge badge-warning"><i class="far fa-award"></i>'.$row['User_Id'].'</small> ';  
	$sub_array[] = '<small class="badge badge-warning"><i class="far fa-award"></i>'.$row['Loginname'].'</small> ';
	$sub_array[] = $row['Prize'];
	$sub_array[] = $row['Remarksdate'];
	$sub_array[] = $row['Stat'];
	$sub_array[] = '<small class="badge badge-danger"><i class="far fa-award"></i>'.$row['Firstname'].''.$row['Lastname'].'</small> ';                              
	$sub_array[] = $Proof;
	$sub_array[] = $row['Voucher'];

    $sub_array[] = $row['Hub'];
	$sub_array[] = $status;
    $data[] = $sub_array;
}

$output = array(
    'draw'=> intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);

