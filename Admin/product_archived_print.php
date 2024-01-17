<title>IMS | Archived Product records</title>
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
            <h3>Archived Product records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Archived Product records</li>
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
                <a href="product_archived.php" class="btn bg-secondary btn-sm float-right mr-2"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                 <section id="printElement">
                  <div class="header">
                      <p  class="header-texts"><b>Inventory Management System</b></p>
                      <small class="header-texts"><?= $branch_name ?></small> <br>
                      <small  class="header-texts"><?= $export_contact ?></small>
                  </div>
                  <p class="title-text"><b>Archived Product Records</b></p>
                  <table>
                    <thead>
                      <tr> 
                        <th>Product ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>Date Added</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                        <?php 
                          $sql = '';
                          if($assigned_branch == 0) {
                            $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1");
                          } else {
                            $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1 AND product.branch=$assigned_branch");
                          }
                          if(mysqli_num_rows($sql) > 0) {
                          while ($row = mysqli_fetch_array($sql)) {
                        ?>
                      <tr>
                          <td><?php echo $row['prod_Id'] ?></td>
                          <td><?php echo ucwords($row['cat_name']) ?></td>
                          <td><?php echo ucwords($row['prod_name']) ?></td>
                          <td><?php echo $row['prod_stock'] ?></td>
                          <?php if($assigned_branch == 0): ?>
                          <td>
                            <?php
                              if ($row['branch'] == 1) {
                                echo 'M.H.del Pilar St, Calamba, Laguna';
                              } elseif ($row['branch'] == 2) {
                                echo 'Mabuhay City Road Cabuyao, Laguna';
                              } else {
                                echo 'Admin by Superadmin';
                              }
                            ?>
                          </td>
                          <?php endif; ?>
                          <td><?php echo date("F d, Y", strtotime($row['date_added'])) ?></td>
                      </tr>
                      <?php } } else { ?>
                        <tr style="border: 1px solid #ddd; padding: 5px; text-align: left;">
                          <td colspan="6" style="text-align: center;">No record found in the database</td>
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
<?php include '../includes/footer.php';  ?>
 <script>
   $(window).on('load', function() {
    document.getElementById("printButton").click();
   })
 </script>