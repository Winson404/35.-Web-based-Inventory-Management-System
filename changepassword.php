<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IMS Change Password - Inventory Management System</title>
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
          $type    = $_GET['type'];
      ?>
        <form action="includes/processes.php" method="POST">
          <div class="card-header text-center text-light p-0">
            <a href="#" class="h1"><b>Create new password</b></a>
          </div>
          <div class="card-body text-light p-0">
            <p class="login-box-msg">Please create new password.</p>

              <input type="hidden" class="form-control" name="user_Id" value="<?php echo $user_Id; ?>">
              <input type="hidden" class="form-control mb-3" name="type" value="<?php echo $type; ?>">
              <div class="row">
                
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="New password" name="password" id="password" minlength="8" style="text-transform: none;">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <p id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></p>
               <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirm new password" name="cpassword" id="cpassword" onkeyup="validate_password()" minlength="8" style="text-transform: none;">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 m-0">
                  <p id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></p>
                </div>
                <div class="icheck-primary m-0">
                  <input type="checkbox" id="remember" onclick="showPassword()">
                  <label for="remember">
                    Show password
                  </label>
                </div>
                <div class="col-lg-12 col-md-12 loginButtonContainer p-0 mt-3">
                  <button class="btn btn-block  float-right" type="submit" name="changepassword" id="submit_button">Change password</button>
                </div>
              </div>
              <p class="mt-3 mb-1">
                  <a href="login.php" style="color: #f685a2;">Login</a>
                </p>
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
<script>
  function showPassword() {
    var x = document.getElementById("password");
    var y = document.getElementById("cpassword");
    if (x.type === "password" || y.type === "password") {
      x.type = "text";
      y.type = "text";
    } else {
      x.type = "password";
      y.type = "password";
    }
 }
</script>