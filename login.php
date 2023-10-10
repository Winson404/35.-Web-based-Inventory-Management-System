<title>IMS Login - Inventory Management System</title>
<?php require_once 'navbar.php'; ?>
<body id="loginBody">
  <div class="container">
    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="loginBody">
      <form action="includes/processes.php" method="POST">
        <div class="loginInputsContainer">
          <label for="">Email</label>
          <input type="email" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" >
          <!-- FOR INVALID EMAIL -->
                  <div class="input-group mt-1 mb-3">
                    <small id="text" style="font-style: italic;"></small>
                  </div>
        </div>
        <div class="loginInputsContainer">
          <label for="">Password</label>
          <input placeholder="Password" name="password" type="password" id="password"/>
        </div>
        <div class="icheck-primary text-light">
                  <input type="checkbox" id="remember" id="remember" onclick="myFunction()">
                  <label for="remember">
                    Show password
                  </label>
                </div>
        <div class="loginButtonContainer">
          <button type="submit" class="btn" name="login" id="submit_button">Login</button>
        </div>
      </form>
    </div>
  </div>

<?php require_once 'footer.php'; ?>
