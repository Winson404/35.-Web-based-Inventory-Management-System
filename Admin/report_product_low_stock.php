<title>IMS | Low Stock Product reports</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Low Stock Product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Low Stock Product reports</li>
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
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND DATE(product.date_added)='$dailyDate'");
                    } else {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch AND DATE(product.date_added)='$dailyDate'");
                    }             
                ?>
                <div class="row mb-3">
                    <a href="../includes/processes.php?pdfExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Daily" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="../includes/processes.php?ExcelExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Daily" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="product_low_stock_print.php?print=Daily" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                  </div>
                  <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                      <tr>
                        <th>QR CODE</th>
                        <th>PRODUCT ID</th>
                        <th>CATEGORY</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>DATE ADDED</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                        <td>
                          <a data-toggle="modal" data-target="#qr_image<?php echo $row['p_Id']; ?>">
                            <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                          </a>
                        </td>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td title="<?php echo ($row['prod_stock'] <= 15) ? 'Low stock' : ''; ?>">
                          <?php echo $row['prod_stock']; ?>
                          <?php if ($row['prod_stock'] <= 15): ?>
                          <i class="fas fa-exclamation-triangle text-danger"></i>
                          <?php endif; ?>
                        </td>
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
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                      </tr>
                      <?php  } ?>
                    </tbody>
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
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND DATE(product.date_added) BETWEEN '$startDate' AND '$endDate'");
                    } else {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch AND DATE(product.date_added) BETWEEN '$startDate' AND '$endDate'");
                    } 
                ?>

                <div class="row mb-3">
                    <a href="../includes/processes.php?pdfExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Weekly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="../includes/processes.php?ExcelExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Weekly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="product_low_stock_print.php?print=Weekly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                  </div>
                  <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                      <tr>
                        <th>QR CODE</th>
                        <th>PRODUCT ID</th>
                        <th>CATEGORY</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>DATE ADDED</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                        <td>
                          <a data-toggle="modal" data-target="#qr_image<?php echo $row['p_Id']; ?>">
                            <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                          </a>
                        </td>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td title="<?php echo ($row['prod_stock'] <= 15) ? 'Low stock' : ''; ?>">
                          <?php echo $row['prod_stock']; ?>
                          <?php if ($row['prod_stock'] <= 15): ?>
                          <i class="fas fa-exclamation-triangle text-danger"></i>
                          <?php endif; ?>
                        </td>
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
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table>

                <?php } elseif(isset($_POST['monthly'])) { 
                  $monthlyMonth = $_POST['monthlyMonth'];
                  $_SESSION['monthlyMonth'] = $monthlyMonth;
                  $currentYear = date('Y');
                  $sql = '';

                   if($assigned_branch == 0) {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND MONTH(product.date_added) = '$monthlyMonth' AND YEAR(product.date_added) = '$currentYear'");
                    } else {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch AND MONTH(product.date_added) = '$monthlyMonth' AND YEAR(product.date_added) = '$currentYear'");
                    } 
                ?>

                <div class="row mb-3">
                    <a href="../includes/processes.php?pdfExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Monthly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="../includes/processes.php?ExcelExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Monthly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="product_low_stock_print.php?print=Monthly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                  </div>
                  <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                      <tr>
                        <th>QR CODE</th>
                        <th>PRODUCT ID</th>
                        <th>CATEGORY</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>DATE ADDED</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                        <td>
                          <a data-toggle="modal" data-target="#qr_image<?php echo $row['p_Id']; ?>">
                            <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                          </a>
                        </td>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td title="<?php echo ($row['prod_stock'] <= 15) ? 'Low stock' : ''; ?>">
                          <?php echo $row['prod_stock']; ?>
                          <?php if ($row['prod_stock'] <= 15): ?>
                          <i class="fas fa-exclamation-triangle text-danger"></i>
                          <?php endif; ?>
                        </td>
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
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                <?php } elseif(isset($_POST['yearly'])) { 
                  $yearlyDate = $_POST['yearlyDate'];
                  $_SESSION['yearlyDate'] = $yearlyDate;
                  $currentYear = date('Y');
                  $sql = '';
                  if($assigned_branch == 0) {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND YEAR(product.date_added) = '$yearlyDate'");
                    } else {
                      $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch AND YEAR(product.date_added) = '$yearlyDate'");
                    } 
                ?>
                  <div class="row mb-3">
                    <a href="../includes/processes.php?pdfExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Yearly" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="../includes/processes.php?ExcelExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=Yearly" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="product_low_stock_print.php?print=Yearly" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                  </div>
                  <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                      <tr>
                        <th>QR CODE</th>
                        <th>PRODUCT ID</th>
                        <th>CATEGORY</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>DATE ADDED</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php while ($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                        <td>
                          <a data-toggle="modal" data-target="#qr_image<?php echo $row['p_Id']; ?>">
                            <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                          </a>
                        </td>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td title="<?php echo ($row['prod_stock'] <= 15) ? 'Low stock' : ''; ?>">
                          <?php echo $row['prod_stock']; ?>
                          <?php if ($row['prod_stock'] <= 15): ?>
                          <i class="fas fa-exclamation-triangle text-danger"></i>
                          <?php endif; ?>
                        </td>
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
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                <?php } else { ?>
                  <div class="row mb-2">
                    <a href="../includes/processes.php?pdfExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=All" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="../includes/processes.php?ExcelExport=ProductLowStack&&assigned_branch=<?= $assigned_branch ?>&&print=All" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="product_low_stock_print.php?print=All" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                  </div>
                  <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                    <thead>
                      <tr>
                        <th>QR CODE</th>
                        <th>PRODUCT ID</th>
                        <th>CATEGORY</th>
                        <th>PRODUCT NAME</th>
                        <th>STOCK</th>
                        <?php if($assigned_branch == 0): ?>
                        <th>BRANCH</th>
                        <?php endif; ?>
                        <th>DATE ADDED</th>
                      </tr>
                    </thead>
                    <tbody id="users_data">
                      <?php
                      $sql = '';
                      if($assigned_branch == 0) {
                        $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15");
                      } else {
                        $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch");
                      }

                      while ($row = mysqli_fetch_array($sql)) {
                      ?>
                      <tr>
                        <td>
                          <a data-toggle="modal" data-target="#qr_image<?php echo $row['p_Id']; ?>">
                            <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                          </a>
                        </td>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td title="<?php echo ($row['prod_stock'] <= 15) ? 'Low stock' : ''; ?>">
                          <?php echo $row['prod_stock']; ?>
                          <?php if ($row['prod_stock'] <= 15): ?>
                          <i class="fas fa-exclamation-triangle text-danger"></i>
                          <?php endif; ?>
                        </td>
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
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                        
                      </tr>
                      <?php  } ?>
                    </tbody>
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