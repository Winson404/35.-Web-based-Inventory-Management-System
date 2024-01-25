<title>IMS | Supplier reports</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Supplier</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Supplier reports</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="card-tools mr-1 mt-2 mb-2">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <form id="sortingForm" method="POST">
                    <div class="form-row">
                      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-12">
                        <label for="sortBy">Sort By:</label>
                        <select id="sortBy" class="form-control form-control-sm" onchange="showDateInputs()" required>
                          <option value="" selected disabled>Select sorting type</option>
                          <option value="daily">Daily</option>
                          <option value="weekly">Weekly</option>
                          <option value="monthly">Monthly</option>
                          <option value="yearly">Yearly</option>
                          <!-- <option value="custom">Custom Date</option> -->
                        </select>
                      </div>
                      <div id="dateInputs" class="form-group col-lg-4 col-md-4 col-sm-12 col-12">
                        <!-- Date inputs will be dynamically added here based on the selection -->
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12" style="margin-top: 31px;">
                        <button type="submit" class="btn btn-warning btn-sm" onclick="sortRecords()"><i class="fa-solid fa-sort"></i> Sort Records</button>
                        <button type="button" name="filter" class="btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                      </div>
                    </div>
                  </form>

                <?php 
                if(isset($_POST['daily'])) {
                  $dailyDate = $_POST['dailyDate'];
                  $_SESSION['dailyDate'] = $dailyDate;
                  $sql = '';
                  if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND DATE(date_registered)='$dailyDate'");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND DATE(date_registered)='$dailyDate'");
                  }              
                ?>
                <div class="row mb-3">
                   <a href="../includes/processes.php?pdfExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Daily" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Daily" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="users_print.php?print=Daily" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                    <tr> 
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>GENDER</th>
                      <th>EMAIL/CONTACT</th>
                      <th>DATE ADDED</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                          <td>
                              <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                              </a href="">
                          </td>
                          <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                          <td class="text-primary"><?php echo date('F d, Y', strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody >
                  </table>

                <?php } elseif(isset($_POST['weekly'])) { 
                  $weeklyStartDate = $_POST['weeklyStartDate'];
                  $weeklyEndDate = $_POST['weeklyEndDate'];

                  $_SESSION['weeklyStartDate'] = $weeklyStartDate;
                  $_SESSION['weeklyEndDate'] = $weeklyEndDate;
                  // Modify the format of the selected dates if needed
                  $startDate = date('Y-m-d', strtotime($weeklyStartDate));
                  $endDate = date('Y-m-d', strtotime($weeklyEndDate));
                  $sql = '';
                  if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND DATE(date_registered) BETWEEN '$startDate' AND '$endDate'");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND DATE(date_registered) BETWEEN '$startDate' AND '$endDate'");
                  }  
                ?>

                <div class="row mb-3">
                   <a href="../includes/processes.php?pdfExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Weekly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Weekly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="users_print.php?print=Weekly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                    <tr> 
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>GENDER</th>
                      <th>EMAIL/CONTACT</th>
                      <th>DATE ADDED</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                          <td>
                              <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                              </a href="">
                          </td>
                          <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                          <td class="text-primary"><?php echo date('F d, Y', strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody >
                  </table>

                <?php } elseif(isset($_POST['monthly'])) { 
                  $monthlyMonth = $_POST['monthlyMonth'];
                  $_SESSION['monthlyMonth'] = $monthlyMonth;
                  $currentYear = date('Y');
                  $sql = '';
                  if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND MONTH(date_registered) = '$monthlyMonth' AND YEAR(date_registered) = '$currentYear'");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND MONTH(date_registered) = '$monthlyMonth' AND YEAR(date_registered) = '$currentYear'");
                  }  
                ?>

                <div class="row mb-3">
                   <a href="../includes/processes.php?pdfExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Monthly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Monthly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="users_print.php?print=Monthly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                    <tr> 
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>GENDER</th>
                      <th>EMAIL/CONTACT</th>
                      <th>DATE ADDED</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                          <td>
                              <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                              </a href="">
                          </td>
                          <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                          <td class="text-primary"><?php echo date('F d, Y', strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody >
                  </table>
                <?php } elseif(isset($_POST['yearly'])) { 
                  $yearlyDate = $_POST['yearlyDate'];
                  $_SESSION['yearlyDate'] = $yearlyDate;
                  $currentYear = date('Y');
                  $sql = '';
                  if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND YEAR(date_registered) = '$yearlyDate'");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND YEAR(date_registered) = '$yearlyDate'");
                  }  
                ?>
                  <div class="row mb-3">
                     <a href="../includes/processes.php?pdfExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Yearly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                     <a href="../includes/processes.php?ExcelExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=Yearly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                     <a href="users_print.php?print=Yearly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                   </div>
                   <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                    <tr> 
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>GENDER</th>
                      <th>EMAIL/CONTACT</th>
                      <th>DATE ADDED</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                          <td>
                              <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                              </a href="">
                          </td>
                          <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                          <td class="text-primary"><?php echo date('F d, Y', strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody >
                  </table>
                <?php } else { ?>
                 <div class="row mb-3">
                   <a href="../includes/processes.php?pdfExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=All" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Supplier&&assigned_branch=<?= $assigned_branch ?>&&print=All" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="users_print.php?print=All" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                    <tr> 
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>GENDER</th>
                      <th>EMAIL/CONTACT</th>
                      <th>DATE ADDED</th>
                    </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php 
                          $sql = '';
                          if($assigned_branch == 0) {
                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' ");
                          } else {
                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' ");
                          }
                          while ($row = mysqli_fetch_array($sql)) {
                        ?>
                      <tr>
                          <td>
                              <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                              </a href="">
                          </td>
                          <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                          <td class="text-primary"><?php echo date('F d, Y', strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody >
                  </table>
                <?php } ?>
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