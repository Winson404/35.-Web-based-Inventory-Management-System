<title>IMS | Client records</title>
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
            <h3>Client records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Client records</li>
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
                <a href="client.php" class="btn bg-secondary btn-sm float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                 <section id="printElement">
                  <div class="header">
                      <p  class="header-texts"><b>Inventory Management System</b></p>
                      <small class="header-texts"><?= $branch_name ?></small> <br>
                      <small  class="header-texts">Contact: (123) 456-7890 | Email: info@example.com</small>
                  </div>
                  <p class="title-text"><b>Client Records</b></p>
                  <table>
                    <thead>
                      <tr> 
                        <th>Client name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Vehicle Type</th>
                        <th>Year Model</th>
                        <th>Date added</th>
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
                          if(mysqli_num_rows($sql) > 0) {
                          while ($row = mysqli_fetch_array($sql)) {
                            $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'];
                        ?>
                      <tr>
                          <td><?php echo ucwords($name); ?></td>
                          <td><?php echo ucwords($row['email']); ?></td>
                          <td><?php echo ucwords($row['address']); ?></td>
                          <td><?php echo ucwords($row['vehicleType']); ?></td>
                          <td><?php echo $row['yearModel']; ?></td>
                          <td><?php echo date("F d, Y",strtotime($row['date_registered'])); ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr style="border: 1px solid #ddd; padding: 5px; text-align: left;">
                          <td colspan="4" style="text-align: center;">No record found in the database</td>
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