<title>IMS | Product records</title>
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
              <li class="breadcrumb-item active">Product records</li>
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
                <a href="product_mgmt.php?page=create" class="btn btn-xs bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Product</a>

                <div class="card-tools mr-1 mt-3">
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
                          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0");
                        } else {
                          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.branch=$assigned_branch");
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
                        <td>
                          <a class="btn btn-primary btn-xs" href="product_view.php?p_Id=<?php echo $row['p_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-xs" href="product_mgmt.php?page=<?php echo $row['p_Id']; ?>" style="display: <?php if($assigned_branch != 0) { echo 'none'; } ?>" ><i class="fas fa-pencil-alt"></i> Edit</a>
                          <button type="button" class="btn bg-warning btn-xs" data-toggle="modal" data-target="#archive<?php echo $row['p_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-archive"></i> Archive</button>
                          <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['p_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
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