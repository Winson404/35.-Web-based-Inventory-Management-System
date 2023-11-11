<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>
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
                <a href="schedule.php" class="btn bg-secondary btn-sm float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                 <section id="printElement">
                  <div class="header">
                      <p  class="header-texts"><b>Inventory Management System</b></p>
                      <small class="header-texts">Business Address, City, State, Zip Code</small> <br>
                      <small  class="header-texts">Contact: (123) 456-7890 | Email: info@example.com</small>
                  </div>
                  <p class="title-text"><b>Schedule Records</b></p>
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
                          $sql = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address, 
                                CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
                                FROM schedule 
                                JOIN clients ON schedule.client_Id = clients.Id 
                                JOIN mechanic ON schedule.mechanic_Id = mechanic.Id ORDER BY selectedDate DESC");
                          if(mysqli_num_rows($sql) > 0) {
                          while ($row = mysqli_fetch_array($sql)) {
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
                          <td><?php echo ucwords($row['full_name']) ?></td>
                          <td><?php echo ucwords($services) ?></td>
                          <td><?php echo date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])) ?></td>
                          <td><?php echo ucwords($name) ?></td>
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
<?php include '../includes/footer.php';  ?>
 <script>
   $(window).on('load', function() {
    document.getElementById("printButton").click();
   })
 </script>