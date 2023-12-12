<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IMS Forgot password - Inventory Management System</title>
  <?php require_once 'navbar.php'; ?>
</head>
<body id="loginBody">
  <div class="container">
    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="loginBody" style="margin-top: -40px;">
      <form action="includes/processes.php" method="POST" class="p-3">
        <div class="loginInputsContainer">
          <label for="email">Email</label>
          <input type="email" placeholder="email@gmail.com" name="email" id="email" onkeydown="validation()" onkeyup="validation()">
          <!-- FOR INVALID EMAIL -->
          <div class="input-group">
            <small id="text" style="font-style: italic;"></small>
          </div>
          <p><a href="login.php" style="color: #f685a2;">Login</a></p>
        </div>
        <div class="loginButtonContainer">
          <button type="submit" class="btn" name="search" id="submit_button">Search</button>
        </div>
        
      </form>
    </div>
  </div>

  <?php require_once 'footer.php'; ?>
</body>
</html>
