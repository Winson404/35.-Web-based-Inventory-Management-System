<title>IMS | Client profile</title>
<?php include 'navbar.php'; ?>

  <div class="container p-5">
    <div class="row d-flex justify-content-center" style="margin-top: 20px;">
      <div class="col-lg-7 col-md-7 col-sm-12 col-12 bg-light">
          <div class="loginInputsContainer text-center">
            <h4><b>ACCOUNT SECURITY</b></h4>
            <hr>
          </div>
          <div class="container p-3">
            <h5>To change your password, an confirmation will be sent to your email. <br> To continue, click
            <a href="../includes/processes.php?Id=<?php echo $row['Id']; ?>">here...</a></h5>
          </div>
      </div>
    </div>
  </div>

<?php require_once 'footer.php'; ?>