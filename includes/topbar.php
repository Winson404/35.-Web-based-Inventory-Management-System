<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IMS</title>
  <!---FAVICON ICON FOR WEBSITE--->
  <link rel="shortcut icon" type="image/png" href="../images/ims-logo.png">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <script src="../plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="css/tempudsdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="css/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="css/jqvmap/jqvmap.min.css"> -->
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="css/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="css/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="css/summernote/summernote-bs4.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .modal-content{
      -webkit-box-shadow: 0 5px 15px rgba(0,0,0,0);
      -moz-box-shadow: 0 5px 15px rgba(0,0,0,0);
      -o-box-shadow: 0 5px 15px rgba(0,0,0,0);
      box-shadow: 0 5px 15px rgba(0,0,0,0);
    }
    .nav-link {
      padding-top: 5px;
      padding-bottom: 5px;
    }

    .nav-treeview > .nav-item > .nav-link {
      padding-left: 20px;
    }

    .nav-treeview > .nav-item > .nav-link p {
      margin-bottom: 0;
    }
    .form-control:not([type="email"]):not([type="password"]) {
      text-transform: capitalize;
    }
  </style>
</head>
<!-- LIGHT MODE -->
<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<!-- DARK MODE -->
<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">  -->
<body class="hold-transition sidebar-mini  layout-fixed layout-navbar-fixed"> 
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../images/ims-logo.png" alt="BMSLogo" height="105" width="105">
  </div>  -->

  <!-- Navbar -->
  <!-- LIGHT MODE -->
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
      <?php if($row['user_type'] !== 'Admin'): ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="contact-us.php" class="nav-link">Contact</a>
      </li>
    <?php endif; ?>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- <li class="mt-1">
        <a class="mt-3">Today is <?php //echo date("l"); ?> | <?php// echo date("F d, Y"); ?></a>
      </li> -->
       <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa-solid fa-user"></i><?php //echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?><i class="fa-solid fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="profile.php" class="dropdown-item">
            <div class="media">
              <img src="../images-users/<?php //echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50">
              <div class="media-body">
                  <h3 class="dropdown-item-title"><?php //echo ' '.$row['firstname'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></h3>
                  <p class="text-sm text-muted"><?php //echo $row['user_type']; ?></p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
            <a type="button" href="profile.php" class="dropdown-item">&nbsp;<i class="fa-solid fa-gear"></i>&nbsp;&nbsp; Profile settings</a>
          <div class="dropdown-divider"></div>
           <a href="#" class="d-flex justify-content-start dropdown-item dropdown-footer" onclick="logout()">&nbsp;<i class="fa-solid fa-power-off"></i>&nbsp;&nbsp; Logout</a>
        </div>
      </li> -->

      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Messages Dropdown Menu -->
      <?php 
        $all_prod = '';
        if($assigned_branch == 0) {
          $all_prod = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <=15 LIMIT 5");
        } else {
          $all_prod = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <=15 AND product.branch=$assigned_branch LIMIT 5");
        }
        
        $count_all = mysqli_num_rows($all_prod);
      ?>
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php if($count_all > 0) { echo $count_all; } else { echo 0; } ?></span>
        </a>
        <?php 
          if($count_all > 0) {
        ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <?php while($row_all_prod = mysqli_fetch_array($all_prod)) { ?>
            <div class="media">
              <img src="../images-product/<?php echo $row_all_prod['prod_image']; ?>" alt="User Avatar" class="img-circle mr-2" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; height: 45px; width: 45px; border-radius: 50%;">
              <div class="media-body mb-2">
                <h3 class="dropdown-item-title"><?= $row_all_prod['prod_name'] ?></h3>
                <p class="text-sm">Stock: <?= $row_all_prod['prod_stock'] ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= $row_all_prod['date_added'] ?></p>
              </div>
            </div>
            <?php } ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="product_low_stock.php" class="dropdown-item dropdown-footer">See All Critical Products</a>
        </div>
        <?php } else { ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">No Products in Critical Level</a>
        </div>
        <?php } ?>
      </li>

      <!-- Notifications Dropdown Menu -->
     
      


       <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <!-- <img src="../images-users/<?php echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50"> -->
          <img src="../images-users/<?php echo $row['image']; ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="../images-users/<?php echo $row['image']; ?>" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?>
              <small><?php echo $row['user_type']; ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-12 text-center">
                <small>Member since <?php echo date("F d, Y", strtotime($row['date_registered'])); ?></small>
              </div>
              <!-- <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div> -->
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <a href="#" class="btn btn-default btn-flat float-right" onclick="logout()">Sign out</a>
          </li>
        </ul>
      </li>

      <!-- FULL SCREEN -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- END FULL SCREEN -->
      
    </ul>
  </nav>
  <!-- /.navbar -->



  <script>

  function logout() {
    swal({
      title: 'Are you sure you want to logout?',
      text: "You won't be able to revert this!",
      icon: "warning",
      buttons: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Make an AJAX request to the PHP file
        $.ajax({
          url: '../Includes/ajax_autoLogout.php',
          type: 'POST',
          data: { 
            id: '<?php echo $id; ?>', 
            login_time: '<?php echo $login_time; ?>',
          },
          success: function(response) {
            // Handle the response if needed
            // swal("Logged out successfully!", {
            //   icon: "success",
            // }).then(() => {
              // Redirect to another page
              window.location = "../logout.php";
            // });
          },
          error: function(xhr, status, error) {
            // Handle the error if needed
            swal("Error occurred while logging out!", {
              icon: "error",
            });
          }
        });
      } else {
        // Handle the cancellation if needed
        swal("Logout canceled.", {
          icon: "info",
        });
      }
    });
  }

</script>

<script src="../sweetalert2.min.js"></script>
<?php include '../sweetalert_messages.php'; ?>