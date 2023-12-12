<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IMS Code verification - Inventory Management System</title>
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
          if(isset($_GET['user_Id']) && isset($_GET['email']) && isset($_GET['type'])) {

          $user_Id = $_GET['user_Id'];
          $email   = $_GET['email'];
          $type = $_GET['type'];

         
      ?>
        <form action="includes/processes.php" method="POST">
          <div class="card-header text-center text-light p-0">
            <a href="#" class="h1"><b>Enter security code</b></a>
          </div>
          <div class="card-body text-light p-0">
            <p class="login-box-msg">Please check your email for a message with your code. Your code is 6 numbers long.</p>
              <input type="hidden" class="form-control mb-3" name="type" value="<?php echo $type; ?>">
              <input type="hidden" class="form-control mb-3" value="<?php echo $user_Id; ?>" name="user_Id">
              <input type="hidden" class="form-control mb-3" value="<?php echo $email; ?>" name="email">
              <div class="row">
                
                <div class="input-group mb-3">   
                  <input type="number" class="form-control" placeholder="Enter verification code" name="code" minlength="6" maxlength="6" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                 <div class="col-md-12" style="margin-top: -18px;">
                  <div class="input-group">
                    <p>We sent your code to: <b><?php echo $email; ?></b></p>
                  </div>
                </div>
              
                <div class="col-md-12 loginButtonContainer" style="margin-top: 20px;">
                  <button type="submit" class="btn btn-sm btn-block" name="verify_code">Continue</button>
                  <a href="sendcode.php?user_Id=<?= $user_Id; ?>&&email=<?= $email ?>&&type=<?= $type ?>" class="mt-1" style="color: #f685a2;">Didn't get a code?</a>  
                </div>
                <p class="mt-3 mb-1">
                  <a href="login.php" style="color: #f685a2;">Login</a>
                </p>
              </div>
          </div>
        </form>
        <?php } else { ?>
        <div class="loginInputsContainer text-light">
            <h2 style="color: red; ">404 - Page Not Found</h2>
            <p>The page you are looking for might be unavailable or does not exist.</p>
            <p><a href="login.php" style="color: #f685a2;" >Back to Login</a></p>
        </div>
        <?php } ?>

    </div>
  </div>

  <?php require_once 'footer.php'; ?>
</body>
</html>
