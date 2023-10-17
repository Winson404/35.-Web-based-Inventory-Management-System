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
  </style>
</head>
<body>
  <div class="header">
    <div class="homepageContainer">
      <a class="m-2" href="index.php">Home</a>
      <a class="m-2" href="schedule.php">Schedule</a>
      <a class="m-2" href="#">About Us</a>
      <a class="m-2" href="#">Contact Us</a>
      <a class="m-2" href="#">Profile</a>
      <a class="m-5" href="../logout.php">Logout</a>
    </div>
  </div>

<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
    } else {
     header('Location: ../login.php');
    }
?>
