<title>IMS Registration - Inventory Management System</title>
<?php require_once 'navbar.php'; ?>
<style>
  div.form-group span {
    color: white;
  }
  div a.h5 {
    color:#f685a2;
  }
</style>
<body id="loginBody">
  <div class="container">
    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -120px;">
      <div class="col-lg-7 col-md-7 col-sm-12 col-12">
        <?php 
          if(isset($_GET['client_Id'])) {
            $hashed_Id = $_GET['client_Id'];
            $query = "SELECT Id FROM clients WHERE SHA1(Id) = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $hashed_Id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $original_client_Id);
            mysqli_stmt_fetch($stmt);

        ?>
        <form action="includes/processes.php" method="POST" style="border:2px solid #fff;border-radius: 8px;">
          <div class="loginInputsContainer text-light text-center">
            <h4><b>EMAIL VERIFICATION</b></h4>
            <p class="text-sm">6-Digit Code has been sent to your email </p>
          </div>
          <div class="row p-3">
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-block m-auto">
                <div class="form-group">
                  <input type="hidden" class="form-control" name="Id" value="<?= $original_client_Id ?>" required>
                  <input type="text" class="form-control"  placeholder="Enter 6 Digit code" name="code" required>
                </div>
            </div>
           
            <div class="col-12 text-light">
              <p class="text-center">Already have an account? <a href="login.php" style="color: #f685a2;">Click here!</a></p>
           
              <button type="submit" class="btn d-block m-auto" name="verify_account" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>
        </form>
        <?php } else { ?>
          <div class="loginInputsContainer text-light text-center">
            <h4><b>404 PAGE NOT FOUND</b></h4>
            <h4 class="text-sm">Back to <a href="login.php"style="color: #f685a2;">login</a></h4>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

<?php require_once 'footer.php'; ?>
