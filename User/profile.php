<title>IMS | Client profile</title>
<?php include 'navbar.php'; ?>

  <div class="container">
    <div class="row d-flex justify-content-center" style="margin-top: 20px;">
      <div class="col-lg-7 col-md-7 col-sm-12 col-12">
        <?php if($type === 'Mechanic') { ?>
        <form action="../includes/processes.php" method="POST" class="bg-light" style="border:2px solid #fff;border-radius: 8px;">
          <input type="hidden" class="form-control" name="Id" required value="<?php echo $row['Id']; ?>">
          <div class="loginInputsContainer text-center">
            <h4><b>MECHANIC PROFILE</b></h4>
            <p class="text-sm">Mechanic information</p>
          </div>
          <div class="row p-3">
            <div class="col-lg-12 mt-1 mb-2 ">
              <a class="h5" style="color:#f685a2;"><b>Basic information</b></a>
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?= $row['firstname'] ?>">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                  <span><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)" value="<?= $row['lastname'] ?>">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?= $row['lastname'] ?>">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                <span><b>Ext/Suffix</b></span>
                <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" value="<?= $row['suffix'] ?>">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?= $row['email'] ?>">
                  <small id="text" style="font-style: italic;"></small>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Contact number</b></span>
                <div class="input-group">
                  <div class="input-group-text">+63</div>
                  <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" value="<?= $row['contact'] ?>" required maxlength="10">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Complete address</b></span>
                  <br>
                  <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required><?= $row['address'] ?></textarea>
                </div>
            </div>
           
            <div class="col-12 text-light">
              <button type="submit" class="btn float-right" name="update_mechanic_profile" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Edit</button>
            </div>
          </div>

        </form>
        <?php } else { ?>
        <form action="../includes/processes.php" method="POST" class="bg-light" style="border:2px solid #fff;border-radius: 8px;">
          <input type="hidden" class="form-control" name="Id" required value="<?php echo $row['Id']; ?>">
          <div class="loginInputsContainer text-center">
            <h4><b>CLIENT PROFILE</b></h4>
            <p class="text-sm">Client information</p>
          </div>
          <div class="row p-3">
            <div class="col-lg-12 mt-1 mb-2 ">
              <a class="h5" style="color:#f685a2;"><b>Basic information</b></a>
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?= $row['firstname'] ?>">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                  <span><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)" value="<?= $row['lastname'] ?>">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?= $row['lastname'] ?>">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                <span><b>Ext/Suffix</b></span>
                <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" value="<?= $row['suffix'] ?>">
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?= $row['email'] ?>">
                  <small id="text" style="font-style: italic;"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <span><b>Complete address</b></span>
                  <br>
                  <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required><?= $row['address'] ?></textarea>
                </div>
            </div>

            <div class="col-lg-12 mt-1 mb-2 ">
              <a class="h5" style="color:#f685a2;"><b>Vehicle type</b></a>
              <div class="dropdown-divider"></div>
            </div>
            <!-- Type of Vehicle Dropdown -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="vehicleType"><b>Type of Motorcycle</b></span>
                <select class="form-control" name="vehicleType" id="vehicleType" required>
                    <option value="" selected disabled>Select type</option>
                    <option value="Rusi" <?php if($row['vehicleType'] == 'Rusi') { echo 'selected'; } ?>>Rusi</option>
                    <option value="Yamaha" <?php if($row['vehicleType'] == 'Yamaha') { echo 'selected'; } ?>>Yamaha</option>
                    <option value="Suzuki" <?php if($row['vehicleType'] == 'Suzuki') { echo 'selected'; } ?>>Suzuki</option>
                    <option value="Skygo" <?php if($row['vehicleType'] == 'Skygo') { echo 'selected'; } ?>>Skygo</option>
                    <option value="Kymco" <?php if($row['vehicleType'] == 'Kymco') { echo 'selected'; } ?>>Kymco</option>
                    <option value="Honda" <?php if($row['vehicleType'] == 'Honda') { echo 'selected'; } ?>>Honda</option>
                    <option value="Kawasaki" <?php if($row['vehicleType'] == 'Kawasaki') { echo 'selected'; } ?>>Kawasaki</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <!-- Year Model Input -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                <span for="yearModel"><b>Year Model</b></span>
                <input type="number" class="form-control" name="yearModel" id="yearModel" required placeholder="2000" value="<?= $row['yearModel']; ?>">
            </div>
           
            <div class="col-12 text-light">
              <button type="submit" class="btn float-right" name="update_client_profile" id="submit_button" style="background-color: #f685a2;"><i class="fa-solid fa-floppy-disk"></i> Edit</button>
            </div>
          </div>

        </form>
        <?php } ?>
      </div>
    </div>
  </div>

<?php require_once 'footer.php'; ?>