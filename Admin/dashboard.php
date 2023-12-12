<title>IMS | Dashboard</title>
<?php include 'navbar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row d-flex justify-content-start">

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  $schedule = '';
                  if($assigned_branch == 0) {
                    $schedule = mysqli_query($conn, "SELECT sched_Id FROM schedule JOIN clients ON schedule.client_Id=clients.Id WHERE schedule.selectedDate >= CURDATE() ");
                  } else {
                    $schedule = mysqli_query($conn, "SELECT sched_Id FROM schedule JOIN clients ON schedule.client_Id=clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch ");
                  }
                  
                  $row_schedule = mysqli_num_rows($schedule);
                ?>
                <h3><?php echo $row_schedule; ?></h3>

                <p>Schedules</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <a href="schedule.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  $prod = '';
                  if($assigned_branch == 0) {
                    $prod = mysqli_query($conn, "SELECT p_Id FROM product WHERE is_archived=0");
                  } else {
                    $prod = mysqli_query($conn, "SELECT p_Id FROM product WHERE is_archived=0 AND branch=$assigned_branch");
                  }            
                  $row_prod = mysqli_num_rows($prod);
                ?>
                <h3><?php echo $row_prod; ?></h3>

                <p>Products</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  $cate = mysqli_query($conn, "SELECT cat_Id FROM category");                 
                  $row_cate = mysqli_num_rows($cate);
                ?>
                <h3><?php echo $row_cate; ?></h3>

                <p>Category</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder"></i>
              </div>
              <a href="category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                  $users = '';
                  if($assigned_branch == 0) {
                    $users = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type != 'User'");
                  } else {
                    $users = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type != 'User' AND assigned_branch=$assigned_branch");
                  }
                  $row_users = mysqli_num_rows($users);
                ?>
                <h3><?php echo $row_users; ?></h3>

                <p>Administrators</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
              <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  $supplier = '';
                  if($assigned_branch == 0) {
                    $supplier = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type='User'");
                  } else {
                    $supplier = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type='User' AND assigned_branch=$assigned_branch");
                  }
                  $row_users = mysqli_num_rows($supplier);
                ?>
                <h3><?php echo $row_users; ?></h3>

                <p>Registered Suppliers</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck"></i>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  $clients = '';
                  if($assigned_branch == 0) {
                    $clients = mysqli_query($conn, "SELECT Id FROM clients WHERE is_verified=1");
                  } else {
                    $clients = mysqli_query($conn, "SELECT Id FROM clients WHERE is_verified=1 AND client_branch=$assigned_branch");
                  }
                  $row_clients = mysqli_num_rows($clients);
                ?>
                <h3><?php echo $row_clients; ?></h3>

                <p>Registered clients</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="client.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  $mechanic = '';
                  if($assigned_branch == 0) {
                    $mechanic = mysqli_query($conn, "SELECT Id FROM mechanic");
                  } else {
                    $mechanic = mysqli_query($conn, "SELECT Id FROM mechanic WHERE mechanic_branch=$assigned_branch");
                  }
                  
                  $row_mechanic = mysqli_num_rows($mechanic);
                ?>
                <h3><?php echo $row_mechanic; ?></h3>

                <p>Registered mechanics</p>
              </div>
              <div class="icon">
                <i class="fas fa-tools"></i>
              </div>
              <a href="mechanic.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include '../includes/footer.php'; ?>
