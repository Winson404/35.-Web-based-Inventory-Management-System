<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IMS Login - Inventory Management System</title>
  <?php require_once 'navbar.php'; ?>
</head>
<body id="loginBody">
  <div class="container">
    <div class="loginHeader">
      <h1>RBF</h1>
      <p>Online Scheduling and Inventory Management System</p>
    </div>
    <div class="loginBody" style="margin-top: -40px;">
      <form action="includes/processes.php" method="POST">

          <div class="loginInputsContainer">
            <label for="email">Email</label>
            <input type="hidden" name="branch_type" value="client" required>
            <input type="email" placeholder="email@gmail.com" name="email" id="email" onkeydown="validation()" onkeyup="validation()" required>
            <!-- FOR INVALID EMAIL -->
            <div class="input-group mt-1 mb-3">
              <small id="text" style="font-style: italic;color: #f685a2;"></small>
            </div>
          </div>
          <div class="loginInputsContainer">
            <label for="password">Password</label>
            <input placeholder="Password" name="password" type="password" id="password" required>
          </div>
          <div class="d-flex justify-content-between text-light">
            <div class="icheck-primary text-light">
              <input type="checkbox" id="remember" onclick="myFunction()">
              <label for="remember">
                Show password
              </label>
            </div>
            <div class="icheck-primary text-light">
              <p class="float-right"><a href="forgot_password.php" style="color: #f685a2;">Forgot Password?</a></p>
            </div>
          </div>
          <p class="text-white">New to the site? <a href="register.php" style="color: #f685a2;">Register here!</a></p>
          <p class="text-white">Back to<a href="index.php" style="color: #f685a2;"> home</a></p>
          <div class="loginButtonContainer">
            <button type="submit" class="btn" name="login" id="submit_button">Login</button>
          </div>

      </form>
    </div>
  </div>

  <?php require_once 'footer.php'; ?>
</body>
</html>
