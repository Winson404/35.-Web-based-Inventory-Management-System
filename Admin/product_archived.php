<title>IMS | Archived product records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Archived product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Archived product records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="card-tools mr-1">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <div class="row mb-2">
                   <a href="../includes/processes.php?pdfExport=Archived" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Archived" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="product_archived_print.php" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>PRODUCT ID</th>
                    <th>CATEGORY</th>
                    <th>PRODUCT NAME</th>
                    <th>STOCK</th>
                    <th>ITEM NO</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                    <tr>
                        <td><?php echo $row['prod_Id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td><?php echo $row['prod_stock']; ?></td>
                        <td><?php echo $row['prod_item_no']; ?></td>
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="product_view.php?p_Id=<?php echo $row['p_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                          <button type="button" class="btn bg-warning btn-sm" data-toggle="modal" data-target="#unarchive<?php echo $row['p_Id']; ?>"><i class="fas fa-archive"></i> Unarchive</button>
                        </td> 
                    </tr>

                    <?php include 'product_delete.php'; } ?>

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