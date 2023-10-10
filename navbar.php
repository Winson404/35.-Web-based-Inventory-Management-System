<?php 
    require_once 'config.php';
    if(isset($_SESSION['admin_Id'])) {
      header('Location: Admin/dashboard.php');
      exit();
    } elseif(isset($_SESSION['user_Id'])) {
      header('Location: User/profile.php');
      exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Management System</title>
  <!---FAVICON ICON FOR WEBSITE--->
  <link rel="shortcut icon" type="image/png" href="images/ims-logo.png">
  <link rel="stylesheet" type="text/css" href="dist/css/login.css">
  <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Font Awesome -->
  <!-- <script src="plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

 <!--  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> -->
</head>
