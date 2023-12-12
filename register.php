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
                <span for="vehicleType"><b>Type of Vehicle</b></span>
                <select class="form-control" name="vehicleType" id="vehicleType" required>
                    <option value="" selected disabled>Select type</option>
                    <option value="sedan">Sedan</option>
                    <option value="suv">SUV</option>
                    <option value="truck">Truck</option>
                    <option value="van">Van</option>
                    <option value="motorcycle">Motorcycle</option>
                    <option value="convertible">Convertible</option>
                    <option value="hatchback">Hatchback</option>
                    <option value="coupe">Coupe</option>
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
           
            <div class="col-12 text-light">
              <p>Already have an account? <a href="login.php" style="color: #f685a2;">Click here!</a></p>
           
              <button type="submit" class="btn float-right" name="register_client" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

<?php require_once 'footer.php'; ?>
