<?php
    include '../config.php';

    if(isset($_SESSION['admin_Id']) && isset($_SESSION['login_time'])) {

      $id = $_SESSION['admin_Id'];
      $users = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
      $row = mysqli_fetch_array($users);
      
      $login_time = $_SESSION['login_time'];
      $logout_time = date('Y-m-d h:i A');

      // RECORD TIME LOGGED IN TO BE USED IN AUTO LOGOUT - CODE CAN BE FOUND ON ../INCLUDES/FOOTER.PHP
      $_SESSION['last_active'] = time();

    include '../includes/topbar.php';
?>



  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../images/ims-logo.png" alt="IMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-bold" style="color: #f685a1;">IMS</span>
      <br>
      <span class="text-sm ml-5 font-weight-light mt-2">&nbsp;&nbsp;Sample Address</span>
    </a>



    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-4 pb-2 pt-3 mb-3 d-flex">
        <div class="image">
          <?php //if($row['image'] == ""): ?>
          <img src="../dist/img/avatar.png" alt="User Avatar" class="img-size-50 img-circle">
          <?php //else: ?>
          <img src="../images-users/<?php //echo $row['image']; ?>" alt="User Image" style="height: 34px; width: 34px; border-radius: 50%;">
          <?php //endif; ?>
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php //echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></a>
        </div>
      </div> -->
      

      <!-- SidebarSearch Form -->
      <!--   <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >DASHBOARD</li>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard </p>
            </a>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >SYSTEM USERS</li>
          <li class="nav-item">
            <a href="#" class="nav-link 
              <?php 
              echo (
                basename($_SERVER['PHP_SELF']) == 'admin.php' || 
                basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'admin_view.php' || 
                basename($_SERVER['PHP_SELF']) == 'users.php' || 
                basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'users_view.php' ||
                basename($_SERVER['PHP_SELF']) == 'users_print.php' ||
                basename($_SERVER['PHP_SELF']) == 'client.php' || 
                basename($_SERVER['PHP_SELF']) == 'client_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'client_view.php' ||
                basename($_SERVER['PHP_SELF']) == 'client_print.php'      
                ) ? 'active' : ''; 
              ?>
            "><i class="fa-solid fa-users-gear"></i><p>&nbsp;&nbsp;System Users<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview" 
              <?php 
              echo (
                basename($_SERVER['PHP_SELF']) == 'admin.php' || 
                basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'admin_view.php' || 
                basename($_SERVER['PHP_SELF']) == 'users.php' || 
                basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'users_view.php' ||
                basename($_SERVER['PHP_SELF']) == 'users_print.php' ||
                basename($_SERVER['PHP_SELF']) == 'client.php' || 
                basename($_SERVER['PHP_SELF']) == 'client_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'client_view.php' ||
                basename($_SERVER['PHP_SELF']) == 'client_print.php'              
                ) ? 'style="display: block;"' : ''; 
              ?>
            > 
              <!-- <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >ADMINISTRATORS</li> -->
              <li class="nav-item">
                <a href="admin.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php' || basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'admin_view.php') ? 'active' : ''; ?>">
                  <i class="fas fa-user-shield"></i>
                  <p>&nbsp;Admin records</p>
                </a>
              </li>

              <!-- <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >SUPPLIERS</li> -->
              <li class="nav-item">
                <a href="users.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'users.php' || basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'users_view.php' || basename($_SERVER['PHP_SELF']) == 'users_print.php') ? 'active' : ''; ?>">
                  <i class="fas fa-truck"></i>
                  <p>&nbsp;Supplier records</p>
                </a>
              </li>

              <!-- <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >CLIENT</li> -->
              <li class="nav-item">
                <a href="client.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'client.php' || basename($_SERVER['PHP_SELF']) == 'client_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'client_view.php' || basename($_SERVER['PHP_SELF']) == 'client_print.php') ? 'active' : ''; ?>">
                  <i class="fas fa-users"></i>
                  <p>&nbsp;&nbsp;Client records</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >MECHANIC</li>
          <li class="nav-item">
            <a href="mechanic.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'mechanic.php' || basename($_SERVER['PHP_SELF']) == 'mechanic_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'mechanic_view.php') ? 'active' : ''; ?>">
              <i class="fas fa-tools"></i>
              <p>&nbsp;&nbsp;Mechanic records</p>
            </a>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >CATEGORY</li>
          <li class="nav-item">
              <a href="category.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'category.php') ? 'active' : ''; ?>">
                  <i class="fas fa-folder"></i>
                  <p>&nbsp;&nbsp;Category records</p>
              </a>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >PRODUCT</li>
          <li class="nav-item">
            <a href="#" class="nav-link 
              <?php 
              echo (
                basename($_SERVER['PHP_SELF']) == 'product.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_view.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_print.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_archived.php' ||
                basename($_SERVER['PHP_SELF']) == 'product_archived_print.php'
                ) ? 'active' : ''; 
              ?>
            "><i class="fas fa-shopping-cart"></i><p>&nbsp;&nbsp;Manage products<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview" 
              <?php 
              echo (
                basename($_SERVER['PHP_SELF']) == 'product.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_mgmt.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_view.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_print.php' || 
                basename($_SERVER['PHP_SELF']) == 'product_archived.php' ||
                basename($_SERVER['PHP_SELF']) == 'product_archived_print.php'
                ) ? 'style="display: block;"' : ''; 
              ?>
            > 
              <li class="nav-item">
                  <a href="product.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'product.php' || basename($_SERVER['PHP_SELF']) == 'product_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'product_view.php' || basename($_SERVER['PHP_SELF']) == 'product_print.php') ? 'active' : ''; ?>">
                      <i class="fas fa-shopping-cart"></i>
                      <p>&nbsp;&nbsp;Product records</p>
                  </a>
              </li>

              <!-- <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >SUPPLIERS</li> -->
              <li class="nav-item">
                <a href="product_archived.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'product_archived.php' || basename($_SERVER['PHP_SELF']) == 'product_archived_print.php') ? 'active' : ''; ?>">
                  <i class="fas fa-shopping-cart"></i>
                  <p>&nbsp;Archived products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >SCHEDULES</li>
          <li class="nav-item">
              <a href="schedule.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'schedule.php' || basename($_SERVER['PHP_SELF']) == 'schedule_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'schedule_view.php' || basename($_SERVER['PHP_SELF']) == 'schedule_print.php') ? 'active' : ''; ?>">
                  <i class="fa-solid fa-calendar-days"></i>
                  <p>&nbsp;&nbsp;Schedule records</p>
              </a>
          </li>

          <li class="nav-header text-secondary" style="margin-bottom: -10px; margin-top: -5px;" >LOG HISTORY</li>
          <li class="nav-item">
            <a href="log_history.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'log_history.php') ? 'active' : ''; ?>">
              <i class="fas fa-list-alt"></i>
              <p>&nbsp;Log records</p>
            </a>
          </li>

          

        </ul>
      </nav>


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




  

<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
     } else {
     header('Location: ../login.php');
    }
?>
