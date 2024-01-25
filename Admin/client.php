<title>IMS | Client records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Client</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Client records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <?php 
              if(isset($_GET['Id'])) {
                $Id = $_GET['Id'];
                $fetch = mysqli_query($conn, "SELECT * FROM clients WHERE Id='$Id'");
                $row = mysqli_fetch_array($fetch);
            ?>
              <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="Id" required value="<?php echo $row['Id']; ?>">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <a class="h5 text-primary"><b>Basic information</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                    <div class="form-group">
                      <span><b>First name</b></span>
                      <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?= $row['firstname']; ?>">
                    </div>
                    <div class="form-group">
                        <span><b>Middle name</b></span>
                        <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)" value="<?= $row['middlename']; ?>">
                    </div>
                      <div class="form-group">
                        <span><b>Last name</b></span>
                        <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?= $row['lastname']; ?>">
                      </div>
                    <div class="form-group">
                      <span><b>Ext/Suffix</b></span>
                      <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" value="<?= $row['suffix']; ?>">
                    </div>
                    <div class="form-group">
                      <span><b>Email</b></span>
                      <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?= $row['email']; ?>">
                      <small id="text" style="font-style: italic;"></small>
                    </div>
                    <div class="form-group">
                      <span><b>Complete address</b></span>
                      <br>
                      <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required><?= $row['address']; ?></textarea>
                    </div>
                  
                    <div class="form-group">
                        <a class="h5 text-primary"><b>Vehicle info</b></a>
                        <div class="dropdown-divider"></div>
                    </div>

                  <!-- Type of Vehicle Dropdown -->
                  <div class="form-group">
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
                  <div class="form-group">
                      <span for="yearModel"><b>Year Model</b></span>
                      <input type="number" class="form-control" name="yearModel" id="yearModel" required placeholder="2000" value="<?= $row['yearModel']; ?>">
                  </div>
                  </div>
                  <div class="card-footer">
                      <button type="submit" class="btn bg-primary float-right" name="update_client" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                      <a href="client.php" class="btn bg-dark float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
                  </div>
                </div>
              </form>
            <?php } else { ?>
              <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="branch" value="<?= $assigned_branch ?>" readonly>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <a class="h5 text-primary"><b>Basic information</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                    <div class="form-group">
                      <span><b>First name</b></span>
                      <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                    </div>
                    <div class="form-group">
                      <span><b>Middle name</b></span>
                      <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
                    </div>
                    <div class="form-group">
                      <span><b>Last name</b></span>
                      <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                    </div>
                    <div class="form-group">
                      <span><b>Ext/Suffix</b></span>
                      <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
                    </div>
                    <div class="form-group">
                      <span><b>Email</b></span>
                      <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                      <small id="text" style="font-style: italic;"></small>
                    </div>
                    <div class="form-group">
                      <span><b>Complete address</b></span>
                      <br>
                      <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required></textarea>
                    </div>
                    <div class="form-group">
                      <a class="h5 text-primary"><b>Vehicle info</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                    <!-- Type of Vehicle Dropdown -->
                    <div class="form-group">
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
                    <div class="form-group">
                      <span for="yearModel"><b>Year Model</b></span>
                      <input type="number" class="form-control" name="yearModel" id="yearModel" required placeholder="2000">
                    </div>
                    <div class="form-group">
                      <a class="h5 text-primary"><b>Account password</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                    <div class="form-group">
                      <span><b>Password</b></span>
                      <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8" required>
                      <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></span>
                    </div>
                    <div class="form-group">
                      <span><b>Confirm password</b></span>
                      <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_password()" required minlength="8">
                      <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;"></small>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn bg-primary float-right" name="save_client" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </form>
            <?php } ?>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="card-tools mr-1 mt-3 mb-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <table id="example11" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $sql = '';
                        if($assigned_branch == 0) {
                          $sql = mysqli_query($conn, "SELECT * FROM clients WHERE is_verified=1");
                        } else {
                          $sql = mysqli_query($conn, "SELECT * FROM clients WHERE is_verified=1 AND client_branch=$assigned_branch");
                        }
                        
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                    <tr>
                        <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td class="text-primary"><?php echo date("F d, Y",strtotime($row['date_registered'])); ?></td>
                        <td>
                          <a class="btn btn-info btn-sm" href="client.php?Id=<?php echo $row['Id']; ?>" <?php if($u_type == 'Staff') { echo 'style="pointer-events: none; opacity: .5"'; } ?>><i class="fas fa-pencil-alt"></i> Edit</a>
                          <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                        </td> 
                    </tr>

                    <?php include 'client_delete.php'; } ?>
                     

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include '../includes/footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->