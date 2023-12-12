<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IMS Send Code - Inventory Management System</title>
  <?php require_once 'navbar.php'; ?>
</head>
<body id="loginBody">
  <div class="container">
    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="loginBody" style="margin-top: -80px;">
      
        <?php 
            if(isset($_GET['user_Id']) && isset($_GET['type'])) {
              $user_Id = $_GET['user_Id'];
              $type = $_GET['type'];
              $u_type = '';
              if($type == 'Client') {
                $u_type = mysqli_query($conn, "SELECT * FROM clients WHERE Id='$user_Id'");
              } elseif($type == 'Admin') { 
                $u_type = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
              } else {
                $u_type = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$user_Id'");
              }
              
              $row = mysqli_fetch_array($u_type);
        ?>
        <form action="includes/processes.php" method="POST">
          <div class="card-header text-center text-light p-0">
            <a href="#" class="h1"><b>Reset password</b></a>
          </div>
          <div class="card-body text-light p-0">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

              <input type="hidden" class="form-control mb-3" name="email" value="<?php echo $row['email']; ?>">
              <input type="hidden" class="form-control mb-3" name="type" value="<?php echo $type; ?>">
              <input type="hidden" class="form-control mb-3" name="user_Id" value="<?php echo $user_Id; ?>">

              <div class="row">
                <div class="col-md-12" style="margin-bottom: -20px;">
                  <h5 class="text-center"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></h5>
                  <p class="text-center p-0 mb-5">Full name</p>
                </div>
                
                <div class="col-md-12" style="margin-top: 0px;">
                  <div class="input-group">
                    <p>Send code via email?</p>
                  </div>
                </div>
                 <div class="col-md-12" style="margin-top: -18px;">
                  <div class="input-group">
                    <p><b><?php echo $row['email']; ?></b></p>
                  </div>
                </div>
              
                <div class="col-md-12 loginButtonContainer" style="margin-top: 20px;">
                  <button type="submit" class="btn btn-sm btn-block" name="sendcode">Continue</button>
                  <p class="mt-1"><a href="forgot_password.php" class="text-center" style="color: #f685a2;">Not you?</a></p>  
                </div>
              </div>
          </div>
        </form>
        <?php } else { ?>
        <div class="loginInputsContainer text-light">
            <h2 style="color: red; ">404 - Page Not Found</h2>
            <p>The page you are looking for might be unavailable or does not exist.</p>
            <p><a href="login.php" style="color: #f685a2;">Back to Login</a></p>
        </div>
        <?php } ?>

      
    </div>
  </div>

  <?php require_once 'footer.php'; ?>
</body>
</html>
