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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -120px;">
      <div class="col-lg-7 col-md-7 col-sm-12 col-12">
        <form action="includes/processes.php" method="POST" style="border:2px solid #fff;border-radius: 8px;">
          <div class="loginInputsContainer text-light text-center">
            <h4><b>REGISTRATION</b></h4>
            <p class="text-sm">Fill-in the required fields.</p>
          </div>
          <div class="row p-3">
            <div class="col-lg-12 mt-1 mb-2 ">
              <a class="h5" style="color:#f685a2;"><b>Basic information</b></a>
              <div class="dropdown-divider"></div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span><b>Branch</b></span>
                      <select name="client_branch" class="form-control" id="" required>
                        <option value="" selected disabled>Select branch</option>
                        <option value="1">M.H.del Pilar St, Calamba, Laguna</option>
                        <option value="2">Mabuhay City Road Cabuyao, Laguna</option>
                      </select>
                    </div>
                </div>
              </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                  <span><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                <span><b>Ext/Suffix</b></span>
                <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Complete address</b></span>
                  <br>
                  <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required></textarea>
                </div>
            </div>

            <div class="col-lg-12 mt-2 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5"><b>Vehicle info</b></a>
                <div class="dropdown-divider"></div>
            </div>

            <!-- Type of Vehicle Dropdown -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="vehicleType"><b>Type of Motorcycle</b></span>
                <select class="form-control" name="vehicleType" id="vehicleType" required>
                    <option value="" selected disabled>Select type</option>
                    <option value="Rusi">Rusi</option>
                    <option value="Yamaha">Yamaha</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Skygo">Skygo</option>
                    <option value="Kymco">Kymco</option>
                    <option value="Honda">Honda</option>
                    <option value="Kawasaki">Kawasaki</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <!-- Year Model Input -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="yearModel"><b>Year Model</b></span>
                <input type="number" class="form-control" name="yearModel" id="yearModel" required placeholder="2000">
            </div>


            <div class="col-lg-12 mt-2 mb-2 col-md-12 col-sm-12 col-12">
              <a class="h5"><b>Account password</b></a>
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Password</b></span>
                  <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
                  <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #f685a2;"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Confirm password</b></span>
                  <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_password()" required minlength="8">
                  <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;color: #f685a2;"></small>
                </div>
            </div>
           <!--  <div class="col-12">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <span class="text-white"><b>Enter verification code</b></span>

                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password" minlength="8" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-save"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
          </div> -->
           
            <div class="col-12 text-light">
              <p>Already have an account? <a href="login.php" style="color: #f685a2;">Click here!</a></p>
           
              <button type="submit" class="btn float-right" name="register_client" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>

    <div class="modal" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-static" role="document">
        <form action="includes/processes.php" method="POST" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title d-block m-auto" id="verificationModalLabel"><b>EMAIL VERIFICATION</b></h5>
            </div>
            <div class="modal-body">
              <p class="text-sm text-center">6-Digit Code has been sent to your email </p>
              <div class="form-group">
                <input type="hidden" class="form-control text-center" name="Id" value="<?= $original_client_Id ?>" required>
                <input type="number" class="form-control text-center"  placeholder="Enter 6 Digit code" name="code" required>
                <?php if (isset($_SESSION['error'])): ?>
                    <div id="error-message" class="text-danger text-center"><?= $_SESSION['error'] ?></div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('error-message').innerHTML = '';
                        }, 3000);
                    </script>
                <?php unset($_SESSION['error']); endif;?>
              </div>
              <p>Already have an account? <a href="login.php">Login here!</a></p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary" name="verify_account" id="submit_button" style="background-color: #f685a2; border:none"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#verificationModal').modal('show');
        });
    </script>
  <?php } else { ?>
    <div class="loginHeader">
      <h1>IMS</h1>
      <p>Inventory Management System</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -120px;">
      <div class="col-lg-7 col-md-7 col-sm-12 col-12">
        <form action="includes/processes.php" method="POST" style="border:2px solid #fff;border-radius: 8px;">
          <div class="loginInputsContainer text-light text-center">
            <h4><b>REGISTRATION</b></h4>
            <p class="text-sm">Fill-in the required fields.</p>
          </div>
          <div class="row p-3">
            <div class="col-lg-12 mt-1 mb-2 ">
              <a class="h5" style="color:#f685a2;"><b>Basic information</b></a>
              <div class="dropdown-divider"></div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span><b>Branch</b></span>
                      <select name="client_branch" class="form-control" id="" required>
                        <option value="" selected disabled>Select branch</option>
                        <option value="1">M.H.del Pilar St, Calamba, Laguna</option>
                        <option value="2">Mabuhay City Road Cabuyao, Laguna</option>
                      </select>
                    </div>
                </div>
              </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                  <span><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                <span><b>Ext/Suffix</b></span>
                <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Complete address</b></span>
                  <br>
                  <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required></textarea>
                </div>
            </div>

            <div class="col-lg-12 mt-2 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5"><b>Vehicle info</b></a>
                <div class="dropdown-divider"></div>
            </div>

            <!-- Type of Vehicle Dropdown -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="vehicleType"><b>Type of Motorcycle</b></span>
                <select class="form-control" name="vehicleType" id="vehicleType" required>
                    <option value="" selected disabled>Select type</option>
                    <option value="Rusi">Rusi</option>
                    <option value="Yamaha">Yamaha</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Skygo">Skygo</option>
                    <option value="Kymco">Kymco</option>
                    <option value="Honda">Honda</option>
                    <option value="Kawasaki">Kawasaki</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <!-- Year Model Input -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="yearModel"><b>Year Model</b></span>
                <input type="number" class="form-control" name="yearModel" id="yearModel" required placeholder="2000">
            </div>


            <div class="col-lg-12 mt-2 mb-2 col-md-12 col-sm-12 col-12">
              <a class="h5"><b>Account password</b></a>
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Password</b></span>
                  <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
                  <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #f685a2;"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Confirm password</b></span>
                  <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_password()" required minlength="8">
                  <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;color: #f685a2;"></small>
                </div>
            </div>
           <!--  <div class="col-12">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <span class="text-white"><b>Enter verification code</b></span>

                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password" minlength="8" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-save"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
          </div> -->
           
            <div class="col-12 text-light">
              <p>Already have an account? <a href="login.php" style="color: #f685a2;">Click here!</a></p>
           
              <button type="submit" class="btn float-right" name="register_client" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  <?php } ?>
  </div>

<?php require_once 'footer.php'; ?>
