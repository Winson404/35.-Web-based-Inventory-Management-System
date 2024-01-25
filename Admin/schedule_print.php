<title>IMS | Schedule records</title>
<?php 
    include 'navbar.php'; 
	$export_contact = '';
	if($assigned_branch == 0) {
      $export_contact = 'Contact: +63 992 268 7202';
    } elseif($assigned_branch == 1) {
      $export_contact = 'Contact: +63 992 268 7202 | Email: rbfmotorshop@gmail.com;';
    } else {
      $export_contact = 'Contact: +63 992 268 7202 | Email: rbfmotorshop2@gmail.com;';
    }

    if(isset($_GET['print'])) {
      $sort_by = $_GET['print'];

      $sql = '';
      $range = '';
      if ($sort_by == 'Daily') {
        if (isset($_SESSION['dailyDate'])) {
          $dailyDate = $_SESSION['dailyDate'];
          $range = 'on '.date('F d, Y', strtotime($dailyDate));
          if($assigned_branch == 0) {
            $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND DATE(schedule.selectedDate)='$dailyDate' ORDER BY schedule.selectedDate");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch AND DATE(schedule.selectedDate)='$dailyDate' ORDER BY schedule.selectedDate");
          } 
        } else {
          header('Location: report_schedule.php');
        }
      } else if($sort_by == 'Weekly') {
        if (isset($_SESSION['weeklyStartDate']) && isset($_SESSION['weeklyEndDate'])) {
          $weeklyStartDate = $_SESSION['weeklyStartDate'];
          $weeklyEndDate = $_SESSION['weeklyEndDate'];
          $startDate = date('Y-m-d', strtotime($weeklyStartDate));
          $endDate = date('Y-m-d', strtotime($weeklyEndDate));

         $range = 'between ' . strtoupper(date("F d, Y", strtotime($weeklyStartDate))) . ' - ' . strtoupper(date("F d, Y", strtotime($weeklyEndDate)));

          if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND DATE(schedule.selectedDate) BETWEEN '$startDate' AND '$endDate' ORDER BY schedule.selectedDate");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch AND DATE(schedule.selectedDate) BETWEEN '$startDate' AND '$endDate' ORDER BY schedule.selectedDate");
                  }
        } else {
          header('Location: report_schedule.php');
        }
      } else if ($sort_by == 'Monthly') {
        if (isset($_SESSION['monthlyMonth'])) {
          $monthlyMonth = $_SESSION['monthlyMonth'];
          $currentYear = date('Y');
          $range = 'on the month of '.strtoupper(date("F", strtotime("$currentYear-$monthlyMonth-01"))) . " $currentYear";
          if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND MONTH(schedule.selectedDate) = '$monthlyMonth' AND YEAR(schedule.selectedDate) = '$currentYear' ORDER BY schedule.selectedDate");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch AND MONTH(schedule.selectedDate) = '$monthlyMonth' AND YEAR(schedule.selectedDate) = '$currentYear' ORDER BY schedule.selectedDate");
                  } 
        } else {
          header('Location: report_schedule.php');
        }
      } else if ($sort_by == 'Yearly') {
        if (isset($_SESSION['yearlyDate'])) {
          $yearlyDate = $_SESSION['yearlyDate'];
          $currentYear = date('Y');
          $range = 'on year '.$yearlyDate;
          if($assigned_branch == 0) {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND YEAR(schedule.selectedDate) = '$yearlyDate' ORDER BY schedule.selectedDate");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch AND YEAR(schedule.selectedDate) = '$yearlyDate' ORDER BY schedule.selectedDate");
                  }
        } else {
          header('Location: report_schedule.php');
        }
      } else {
        // $range = 'in 2 branches';
        if($assigned_branch == 0) {
          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() ORDER BY schedule.selectedDate");
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch ORDER BY schedule.selectedDate");
        }
      }
?>

<style>
  div.card-body #printElement div.header {
    text-align: center; 
    margin-bottom: 10px; 
    padding-bottom: 10px;
  }
  div.card-body #printElement div.header .header-texts{
    margin: 0px;
  }
  div.card-body #printElement .title-text{
    text-align: center; 
    margin-bottom: 15px;
  }
  div.card-body table {
    width: 100%; 
    border-collapse: collapse; 
    font-size: 10px;
  }
  div.card-body table thead{
    background-color: #f2f2f2;
  }
  div.card-body table thead tr th, div.card-body table tbody tr td{
    border: 1px solid #ddd; 
    padding: 5px; 
    text-align: left;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Schedule records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Schedule records</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <button id="printButton" class="btn btn-success btn-sm float-right mr-2"><i class="fa-solid fa-print"></i> Print</button>
                <a href="report_schedule.php" class="btn bg-secondary btn-sm float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                 <section id="printElement">
                  <div class="header">
                      <p  class="header-texts"><b>Inventory Management System</b></p>
                      <small class="header-texts"><?= $branch_name ?></small> <br>
                      <small  class="header-texts"><?= $export_contact ?></small>
                  </div>
                  <p class="title-text"><b>Schedule Records <?= $range ?></b></p>
                  <table>
                    <thead>
                      <tr> 
                        <th>Client Name</th>
                        <th>Services</th>
                        <th>Scheduled Date-Time</th>
                        <th>Mechanic name</th>
                        <th>Status</th>
                        <th>Date Approved</th>
                        <th>Date Added</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php 
                          if(mysqli_num_rows($sql) > 0) {
                          while ($row = mysqli_fetch_array($sql)) {

                             $mech_Id = $row['mechanic_Id'];
                              $mech_name = '';
                              $mech_email = '';
                              $mech_address = '';

                              $get_mech = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$mech_Id'");
                              if(mysqli_num_rows($get_mech) > 0){
                                $row2 = mysqli_fetch_array($get_mech);
                                $mech_name = ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']);
                                $mech_email = $row2['email'];
                                $mech_address = $row2['address'];
                              } else {
                                $mech_name = 'No Mechanic Available';
                              }

                            $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
                            $services = '';
                            if($row['services'] == 'Others') {
                              $services = $row['otherServices'];
                            } else {
                              $services = $row['services'];
                            }

                            $status = ''; 
                            if($row['status'] == 0) {
                              $status = 'Pending';
                            } elseif($row['status'] == 1) {
                              $status = 'Approved';
                            } else {
                              $status = 'Denied';
                            }
                        ?>
                      <tr>
                          <td><?php echo ucwords($name) ?></td>
                          <td><?php echo ucwords($services) ?></td>
                          <td><?php echo date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])) ?></td>
                          <td><?php echo ucwords($mech_name) ?></td>
                          <td><?php echo $status ?></td>
                          <td><?php echo ($row['date_approved'] != '' ? date("F d, Y", strtotime($row['date_approved'])) : 'N/A') ?></td>
                          <td><?php echo date("F d, Y", strtotime($row['date_added'])) ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr style="border: 1px solid #ddd; padding: 5px; text-align: left;">
                          <td colspan="7" style="text-align: center;">No record found in the database</td>
                        </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                  <div class="col-md-12 d-flex mt-3">
                    <p class="text-sm">From Branch: <br> <span class="text-muted"><?php echo ucwords($branch_name); ?></span></p>
                    <p class="text-sm ml-auto">Generated by: <br> <span class="text-muted"><?php echo ucwords($logged_in_user); ?></span></p>
                  </div>
                 </section>
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
<script src="../includes/print.js"></script>
<?php } else { include '../includes/404.php'; } include '../includes/footer.php';  ?>
 <script>
   $(window).on('load', function() {
    document.getElementById("printButton").click();
   })
 </script>