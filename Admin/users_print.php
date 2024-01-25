<title>IMS | Supplier records</title>
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
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND DATE(date_registered)='$dailyDate'");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND DATE(date_registered)='$dailyDate'");
          } 
        } else {
          header('Location: report_users.php');
        }
      } else if($sort_by == 'Weekly') {
        if (isset($_SESSION['weeklyStartDate']) && isset($_SESSION['weeklyEndDate'])) {
          $weeklyStartDate = $_SESSION['weeklyStartDate'];
          $weeklyEndDate = $_SESSION['weeklyEndDate'];
          $startDate = date('Y-m-d', strtotime($weeklyStartDate));
          $endDate = date('Y-m-d', strtotime($weeklyEndDate));

          $range = 'between ' . strtoupper(date("F d, Y", strtotime($weeklyStartDate))) . ' - ' . strtoupper(date("F d, Y", strtotime($weeklyEndDate)));
         
          if($assigned_branch == 0) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND DATE(date_registered) BETWEEN '$startDate' AND '$endDate'");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND DATE(date_registered) BETWEEN '$startDate' AND '$endDate'");
          }
        } else {
          header('Location: report_users.php');
        }
      } else if ($sort_by == 'Monthly') {
        if (isset($_SESSION['monthlyMonth'])) {
          $monthlyMonth = $_SESSION['monthlyMonth'];
          $currentYear = date('Y');
          $range = 'on the month of '.strtoupper(date("F", strtotime("$currentYear-$monthlyMonth-01"))) . " $currentYear";
          if($assigned_branch == 0) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND MONTH(date_registered) = '$monthlyMonth' AND YEAR(date_registered) = '$currentYear'");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND MONTH(date_registered) = '$monthlyMonth' AND YEAR(date_registered) = '$currentYear'");
          }
        } else {
          header('Location: report_users.php');
        }
      } else if ($sort_by == 'Yearly') {
        if (isset($_SESSION['yearlyDate'])) {
          $yearlyDate = $_SESSION['yearlyDate'];
          $currentYear = date('Y');
          $range = 'on year '.$yearlyDate;
          if($assigned_branch == 0) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND YEAR(date_registered) = '$yearlyDate'");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' AND YEAR(date_registered) = '$yearlyDate'");
          }
        } else {
          header('Location: report_users.php');
        }
      } else {
        // $range = 'in 2 branches';
        if($assigned_branch == 0) {
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' ");
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE assigned_branch=$assigned_branch AND user_type = 'User' ");
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
    font-size: 9px;
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
            <h3>Supplier records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Supplier records</li>
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
                <a href="report_users.php" class="btn bg-secondary btn-sm float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                 <section id="printElement">
                  <div class="header">
                      <p class="header-texts"><b>Inventory Management System</b></p>
                      <small class="header-texts"><?= $branch_name ?></small> <br>
                      <small  class="header-texts"><?= $export_contact ?></small>
                  </div>
                  <p class="title-text"><b>Supplier Records <?= $range ?></b></p>
                  <table>
                    <thead>
                      <tr> 
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>Birthplace</th>
                        <th>Gender</th>
                        <th>Civil Status</th>
                        <th>Occupation</th>
                        <th>Religion</th>
                        <th>Email/Contact</th>
                        <th>Address</th>
                        <th>Date Registered</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php 
                          
                          if(mysqli_num_rows($sql) > 0) {
                          while ($row = mysqli_fetch_array($sql)) {
                            $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
                            $address = $row['house_no'].' '.$row['street_name'].' '.$row['purok'].' '.$row['zone'].' '.$row['barangay'].' '.$row['municipality'].' '.$row['province'].' '.$row['region'];
                        ?>
                      <tr>
                          <td><?php echo ucwords($name) ?></td>
                          <td><?php echo $row['dob'] ?></td>
                          <td><?php echo $row['age'] ?></td>
                          <td><?php echo ucwords($row['birthplace'])  ?></td>
                          <td><?php echo ucwords($row['gender']) ?></td>
                          <td><?php echo ucwords($row['civilstatus']) ?></td>
                          <td><?php echo ucwords($row['occupation']) ?></td>
                          <td><?php echo ucwords($row['religion']) ?></td>
                          <td><?php echo ucwords($row['email']) . '<br> +63 ' . $row['contact'] ?></td>
                          <td><?php echo ucwords($address) ?></td>
                          <td><?php echo date("F d, Y", strtotime($row['date_registered'])) ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr style="border: 1px solid #ddd; padding: 5px; text-align: left;">
                          <td colspan="11" style="text-align: center;">No record found in the database</td>
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