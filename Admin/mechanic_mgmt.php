<title>IMS | Mechanic info</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



<?php if($page === 'create') { ?>

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>New Mechanic</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Mechanic info</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12 mt-1 mb-2 ">
                        <a class="h5 text-primary"><b>Basic information</b></a>
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
                    </div>
                    <!-- END ROW -->
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="mechanic.php" class="btn bg-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn bg-primary" name="save_mechanic" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->









<?php } else { 
  $Id = $page;
  $fetch = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$Id'");
  $row = mysqli_fetch_array($fetch);
?>


  <!-- UPDATE -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3>Update Mechanic</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Mechanic info</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
          <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="Id" required value="<?php echo $row['Id']; ?>">
            <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-12 mt-1 mb-2 ">
                        <a class="h5 text-primary"><b>Basic information</b></a>
                        <div class="dropdown-divider"></div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span><b>First name</b></span>
                            <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?= $row['firstname']; ?>">
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <span><b>Middle name</b></span>
                            <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)" value="<?= $row['middlename']; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span><b>Last name</b></span>
                            <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?= $row['lastname']; ?>">
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                          <span><b>Ext/Suffix</b></span>
                          <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" value="<?= $row['suffix']; ?>">
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                          <div class="form-group">
                            <span><b>Email</b></span>
                            <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?= $row['email']; ?>">
                            <small id="text" style="font-style: italic;"></small>
                          </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="form-group">
                            <span><b>Complete address</b></span>
                            <br>
                            <textarea name="address" id="" class="form-control" rows="2" placeholder="Complete address" required><?= $row['address']; ?></textarea>
                          </div>
                      </div>
                    </div>
                  <!-- END ROW -->
              </div>
              <div class="card-footer">
                <div class="float-right">
                  <a href="mechanic.php" class="btn bg-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <button type="submit" class="btn bg-primary" name="update_mechanic" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END UPDATE -->


<?php } ?>



</div>

<?php } else { include '../includes/404.php'; } ?>



<br>
<br>
<br>
<br>
<br>
<br>
<?php include '../includes/footer.php';  ?>

