<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include 'includes/menubar.php'; ?>
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
              <li class="breadcrumb-item active">Pending List</li>
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
                    <th>Player User_Id</th>
                    <th>Player Loginname</th>
                    <th>Prize</th>
                    <th>Remarks Date</th>
                    <th>Status</th>
                    <th>Voucher</th>
                    <th>Date of Spin</th>
                    <th>Hub</th>
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
          'url': 'pendings/data.php',
          'type': 'post',
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
    url: 'pendings/row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
     $('#Id').val(response.Id);
  
    }
  });
}






</script>


 <?php include 'pendings/modal/modal.php'; ?>

 <?php include 'includes/script.php'; ?>