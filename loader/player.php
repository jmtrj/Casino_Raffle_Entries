<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
  <!-- Main Sidebar Container -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Player List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php include '../validation.php'; ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        

            <div class="card">
      
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>User_Id</th>
                    <th>Loginname</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Number of Coupon</th>
                    <th>Hub</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                
                </table>
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
    <!-- /.content -->
  </div>

  <script>

 $(document).ready(function() {
      $('#example').DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'players/data.php',
          'type': 'post',
           'data': {
          'Hub': '<?php echo $user['Hub'];?>'},
        },
        
      
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [7]
          },

        ]
      });
    });


$(function(){

$(document).on('click','.add', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#add').modal('show');
    getRow(id);
  });


$(document).on('click','.view', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#view').modal('show');
    getRow(id);
  });

});


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'players/row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
     $('#Id').val(response.Id);
  
    }
  });
}






</script>


 <?php include 'players/modal/modal.php'; ?>

 <?php include 'includes/script.php'; ?>