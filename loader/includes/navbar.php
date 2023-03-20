
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Home</a>
      </li>


    </ul>
      <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <label> BALANCE: <?php echo $user['Balance']; ?></label>
      </li>
    </ul>
  </nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      
      <img src="../image/Lexus.png" style="width:100%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
         
        </div>
        <div class="info">
           <a href="#" class="d-block"><label><?php echo $user['Firstname'].' '.$user['Lastname']; ?> ( <?php echo $user['Hub']; ?>)</label> </a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
      

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users  Manage
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="player.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Playerlist</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="transac" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaction History</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gamepad"></i>
              <p>
               Winner Manage
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Approval" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="claimed" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Claimed Prize</p>
                </a>
              </li>

              
            </ul>
          </li>




          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                ACCOUNT SETTINGS
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#profile" data-toggle="modal"  id="admin_profile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PROFILE SETTINGS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LOGOUT</p>
                </a>
              </li>
            
            </ul>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <?php include 'includes/profilemodal.php'; ?>