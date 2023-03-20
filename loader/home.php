<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">

         <div class="row">
         

           <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  <?php
                      $Hub = $user['Hub'];
                      $status = "ACTIVE";
                      $sql = "SELECT * FROM `tblplayer`  WHERE Status=? and Hub =?";
                      $stmt = $conn->prepare($sql);
                      $stmt->bind_param("ss", $status, $Hub);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      echo "<h3>".$result->num_rows."</h3>";
                  ?>
                <p>TOTAL PLAYERs</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="player" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

           <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                      $status = "Approved";
                      $sql = "SELECT * FROM `tblwinner` JOIN tblplayer  ON tblwinner.PlayerId = tblplayer.Id WHERE tblwinner.Status=? and tblplayer.hub =?";
                      $stmt = $conn->prepare($sql);
                      $stmt->bind_param("ss", $status, $Hub);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      echo "<h3>".$result->num_rows."</h3>";
                  ?>
                 <p>Total Approved</p> 
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="approval" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

           <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
               <?php
                  $status1 = "Pending";
                  $status2 = "Waiting for approval";
                  $sql = "SELECT * FROM `tblwinner` JOIN tblplayer  ON tblwinner.PlayerId = tblplayer.Id WHERE (tblwinner.Status=? OR tblwinner.Status=?  and tblplayer.hub =?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("sss", $status1, $status2, $Hub);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  echo "<h3>".$result->num_rows."</h3>";
                ?>
                <p> Total Pending Prize/ For Approvals</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="claimed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Winner list monthly report</h1>
              </div>
                  <div class="card-body">
                    <div class="row" >


                    <div class="col-4" >      
                      <select class="form-control" id="select_year">
                      <option hidden>Year</option>
                      <?php
                      for($i=2023; $i<=2065; $i++){
                        $selected = ($i==$year)?'selected':'';
                        echo "
                        <option value='".$i."' ".$selected.">".$i."</option>
                        ";
                      }
                      ?>
                    </select>
                  </div>
                    <div class="col-4" >
                            <select class="form-control" id="select_month">
                      <option hidden>Month</option>
                      <?php
                      for($i=1; $i<=12; $i++){
                        $month = date('F', mktime(0, 0, 0, $i, 1));
                        $selected = ($month==$month_name)?'selected':'';
                        echo "
                        <option value='".$month."' ".$selected.">".$month."</option>
                        ";
                      }
                      ?>
                    </select>
                  </div>
                   
                   
                </div>
                 <div class="col-sm-12 col-12">
                   <canvas id="myChart">
                </canvas>
                
                 </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
   
  </div>
<script type="text/javascript">
//Define a function to retrieve the default data and create the chart
function getDefaultData() {
  //Create an AJAX request to retrieve the data from the server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);

          //Create the chart using Chart.js
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true
                          }
                      }]
                  }
              }
          });
      }
  };
  
  //Retrieve the default year and month from PHP
  var Hub = '<?php echo $user['Hub']; ?>';
  

  //Make the AJAX request with the default year and month
  xhttp.open("GET", "chart_data.php?Hub=" + Hub, true);
  xhttp.send();
}

//Call the getDefaultData function to display the default chart on page load
getDefaultData();

//Define a function to retrieve the data for the specified year and month and create the chart
function getChartData(year, month) {
  //Create an AJAX request to retrieve the data from the server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
 
          //Create the chart using Chart.js
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                  scales: {
                      yAxes: [{
                          ticks:{
                              beginAtZero: true
                          }
                      }]
                  }
              }
          });
      }
  };

   var Hub = '<?php echo $user['Hub']; ?>';
  xhttp.open("GET", "chart_data.php?year=" + year + "&month=" + month+ "&Hub=" + Hub, true);
  xhttp.send();
}

//Add an event listener to the year filter dropdown to retrieve the selected year and month
document.getElementById('select_year').addEventListener('change', function() {
  var selectedYear = this.value;
  var selectedMonth = document.getElementById('select_month').value;
  getChartData(selectedYear, selectedMonth);
});

//Add an event listener to the month filter dropdown to retrieve the selected year and month
document.getElementById('select_month').addEventListener('change', function() {
  var selectedMonth = this.value;
  var selectedYear = document.getElementById('select_year').value;
  getChartData(selectedYear, selectedMonth);
});

</script>
 <?php include 'includes/script.php'; ?>