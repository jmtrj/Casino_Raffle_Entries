
<?php
//Include database connection configuration file
include 'includes/conn.php';
//Retrieve the selected year and month from the query string parameters


if(isset($_GET['year']) && isset($_GET['month'])  && isset($_GET['Hub']) ){
 $Hub = $_GET['Hub'];
  $year = $_GET['year'];
  $month_name = $_GET['month'];
  $month = date('m', strtotime($month_name));

 

} else {
 $Hub = $_GET['Hub'];
  $year = date('Y');
  $month_name = date('F');
  $month = date('m');

}

     //Modify the SQL query to select data for the selected year and month
    $stmt = $conn->prepare("SELECT Prize, COUNT(*) as NumWinners FROM tblwinner  JOIN tblplayer  ON tblwinner.PlayerId = tblplayer.Id  WHERE YEAR(Dateofspin) = ? and MONTH(Dateofspin) = ? and Hub = ? GROUP BY Prize");
    $stmt->bind_param('sss', $year, $month, $Hub);
    $stmt->execute();
    $result = $stmt->get_result();

    //Create an empty array to store the chart data
    $data = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => 'Number of Winners',
                'data' => array(),
                'backgroundColor' => array(),
                'borderColor' => array(),
                'borderWidth' => 1
            )
        )
    );

    //Iterate through the query results and add the data to the chart data array
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($data['labels'], $row['Prize']);
            array_push($data['datasets'][0]['data'], $row['NumWinners']);
            //Generate a random color for each bar in the chart
            $bgColor = 'rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',0.2)';
            array_push($data['datasets'][0]['backgroundColor'], $bgColor);
            array_push($data['datasets'][0]['borderColor'], str_replace('0.2', '1', $bgColor));
        }
    }

    //Close the database connection
    $conn->close();

    //Return the chart data in JSON format
    header('Content-Type: application/json');
    echo json_encode($data);


?>
