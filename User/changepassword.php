<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Management System</title>
  <!---FAVICON ICON FOR WEBSITE--->
  <link rel="shortcut icon" type="image/png" href="../images/ims-logo.png">
  <link rel="stylesheet" type="text/css" href="../dist/css/login.css">
  <script src="../plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Font Awesome -->
  <!-- <script src="plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

 <!--  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> -->
  <style>
    .form-control:not([type="email"]):not([type="password"]) {
      text-transform: capitalize;
    }
    /* Style for the dropdown container */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Style for the dropdown toggle link */
    .profile-dropdown-toggle {
      cursor: pointer;
    }

    /* Style for the dropdown content (hidden by default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      left: 0; /* Ensure the dropdown is on the right */
      color: gray;
    }

    /* Style for the left-aligned links */
    .left-link {
      text-align: left; /* Left-align the text within the dropdown */
      display: block;
      padding: 12px 16px;
      text-decoration: none;
      color: gray;
    }

    /* Change color of dropdown links on hover */
    .left-link:hover {
      background-color: #ddd;
    }

    /* Show the dropdown content when hovering over the dropdown container */
    .dropdown:hover .dropdown-content {
      display: block;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="homepageContainer">
  <a class="m-2" href="index.php">Home</a>
  <a class="m-2" href="schedule.php">Schedule</a>
  <a class="m-2" href="#">About Us</a>
  <a class="m-2" href="#">Contact Us</a>
  <div class="dropdown">
    <a class="m-2 profile-dropdown-toggle" href="#">Profile</a>
    <div class="dropdown-content">
      <a href="profile.php" class="left-link text-dark">Account</a>
      <a href="requestChangePass.php" class="left-link text-dark">Change Password</a>
    </div>
  </div>
  <a class="m-5" href="../logout.php">Logout</a>
</div>
</div>


<!-- <title>IMS | Client profile</title>
<?php // include 'navbar.php'; ?> -->
<div class="container">
  <div class="row d-flex justify-content-center" style="margin-top: 20px;">
    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
      <?php
      if(isset($_GET['Id']) && isset($_GET['type'])) {
        $Id = $_GET['Id'];
        $type = $_GET['type'];
      ?>
      <form action="../includes/processes.php" method="POST" class="bg-light" style="border:2px solid #fff;border-radius: 8px;">
        <input type="hidden" class="form-control" name="Id" required value="<?php echo $Id; ?>">
        <div class="loginInputsContainer text-center">
          <h4><b>ACCOUNT SECURITY</b></h4>
          <p class="text-sm">Manage Password</p>
        </div>
        <div class="row p-3">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
              <span><b>Password</b></span>
              <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
              <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></span>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
              <span><b>Confirm password</b></span>
              <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_password()" required minlength="8">
              <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;"></small>
            </div>
          </div>
          
          <div class="col-12 text-light">
            <button type="submit" class="btn float-right" name="<?php if($type === 'Client') { echo 'update_client_password'; } else { echo 'update_mechanic_password'; } ?>" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Edit</button>
          </div>
        </div>
      </form>
      <?php } else { ?>
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="index.php">return to home page.</a>
          </p>
          <!--  <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form> -->
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>