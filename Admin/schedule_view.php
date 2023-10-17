<title>IMS | Schedule Details</title>
<?php 
    include 'navbar.php';
    if(isset($_GET['sched_Id'])) {
    $sched_Id = $_GET['sched_Id'];
    $fetch = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address, 
          CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
          FROM schedule 
          JOIN clients ON schedule.client_Id = clients.Id 
          JOIN mechanic ON schedule.mechanic_Id = mechanic.Id WHERE sched_Id='$sched_Id'");
    $row = mysqli_fetch_array($fetch);
  ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Schedule</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Schedule Details</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-8">

            <div class="card card-solid">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#clientprofile" data-toggle="tab">Client profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#mechanicProfile" data-toggle="tab">Mechanic profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#scheduleDetails" data-toggle="tab">Schedule details</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">

                <div class="tab-content" >

                  <div class="active tab-pane" id="clientprofile">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  name="firstname" value="<?= $row['full_name']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $row['client_email']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $row['client_address']; ?>" readonly>
                        </div>
                      </div>
                  </div>

                  <div class="tab-pane" id="mechanicProfile">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?= $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $row['email']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $row['address']; ?>" readonly>
                        </div>
                      </div>
                  </div>

                  <div class="tab-pane" id="scheduleDetails">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Selected Date</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?= date("F d, Y",strtotime($row['selectedDate'])); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Selected Time</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php echo date("h:i A", strtotime($row['selectedTime'])); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Services</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php echo $row['services']; ?>" readonly>
                        </div>
                      </div>
                      <?php if($row['services'] == "Others"): ?>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Other services</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php echo $row['otherServices']; ?>" readonly>
                        </div>
                      </div>
                      <?php endif; ?>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control"
                          value="<?php if($row['status'] == 0) { echo 'Pending'; } elseif($row['status'] == 1) { echo 'Approved'; }else { echo 'Denied'; } ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date approved</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php if(!empty($row['date_approved'])) { echo date("F d, Y h:i:s A",strtotime($row['date_approved'])); } else { echo 'N/A'; } ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date scheduled</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php echo date("F d, Y",strtotime($row['date_added'])); ?>" readonly>
                        </div>
                      </div>
                  </div>

                </div>

              </div>
              <div class="card-footer">
                <a href="schedule.php" class="btn bg-secondary btn-flat float-right"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <?php } else { include '../includes/404.php'; } ?>
<?php include '../includes/footer.php';  ?>

