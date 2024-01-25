<title>IMS | Low Stock Product records</title>
<?php include 'navbar.php'; ?>
<style>
  .img-circle:hover {
    opacity: 0.5;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Low Stock Product records</li>
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
                    <th>TOOLS</th>
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
                        <td><?php echo $row['prod_stock']; ?></td>
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
                        <td>
                          <a class="btn btn-primary btn-xs" href="product_view.php?p_Id=<?php echo $row['p_Id']; ?>"><i class="fas fa-folder"></i> View</a>
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