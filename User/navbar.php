<?php
    include '../config.php';
    if(isset($_SESSION['Id'])) {
    $Id = $_SESSION['Id'];
    $client = mysqli_query($conn, "SELECT * FROM clients WHERE Id='$Id'");
    $row = mysqli_fetch_array($client);
?>

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

<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
    } else {
     header('Location: ../login.php');
    }
?>
