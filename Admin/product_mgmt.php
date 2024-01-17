<title>IMS | Product info</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];

      $fetch = mysqli_query($conn, "SELECT * FROM product ORDER BY prod_Id DESC LIMIT 1");
      $lastProductId = "00000000";

      if(mysqli_num_rows($fetch) > 0) {
          $row = mysqli_fetch_assoc($fetch);
          $lastProductId = $row['prod_Id'];
      }
      $newProductId = str_pad((int)$lastProductId + 1, strlen($lastProductId), '0', STR_PAD_LEFT);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



<?php if($page === 'create') { ?>

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>New Product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Product info</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-7">
            <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="branch" value="<?= $assigned_branch ?>" readonly>
               
              <div class="card">
                <div class="card-header">
                  <a class="h5 text-primary">Fill in the required fields</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Product ID</b></span>
                              <input type="text" class="form-control" placeholder="Product ID" name="prod_Id" value="<?php echo $newProductId; ?>" readonly>
                            </div>
                        </div>
                        <?php if($assigned_branch == 0): ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group">
                              <span class="text-dark"><b>Assign product</b></span>
                              <select class="form-control" name="branch" required>
                                <option selected disabled value="">Select branch</option>
                                <option value="1">M.H.del Pilar St, Calamba, Laguna</option>
                                <option value="2">Mabuhay City Road Cabuyao, Laguna</option>
                              </select>
                            </div>
                        </div>
                        <?php else: ?>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group mt-4">
                              <input type="hidden" class="form-control"  placeholder="Product name" name="branch" value="<?= $assigned_branch ?>" required>
                            </div>
                          </div>
                        <?php endif; ?>
                        <div class="col-lg-12 col col-md-12 col-sm-12 col-12">
                          <div class="form-group">
                              <span class="text-dark"><b>Category</b></span>
                              <select class="form-control" name="cat_Id" required>
                                <option selected disabled value="">Select category</option>
                                <?php
                                  $cat = mysqli_query($conn, "SELECT * FROM category ORDER BY cat_name"); 
                                  if(mysqli_num_rows($cat) > 0) {
                                    while ($row_cat = mysqli_fetch_array($cat)) {
                                      echo '<option value="'.$row_cat['cat_Id'].'">'.$row_cat['cat_name'].'</option>';
                                    }
                                  } else {
                                    echo '<option value="">No record found</option>';
                                  }
                                ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-8 col col-md-8 col-sm-8 col-12">
                          <div class="form-group">
                              <span class="text-dark"><b>Product name</b></span>
                              <input type="text" class="form-control"  placeholder="Product name" name="prod_name" required>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Stock</b></span>
                              <input type="number" class="form-control"  placeholder="Stock" name="prod_stock" required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Product image</b></span>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)" required>
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                              </div>
                              <p class="help-block text-danger">Max. 500KB</p>
                            </div>
                        </div>
                         <!-- LOAD IMAGE PREVIEW -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="form-group" id="preview">
                            </div>
                        </div>
                    </div>
                    <!-- END ROW -->
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="product.php" class="btn bg-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn bg-primary" name="create_product" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->









<?php } else { 
  $p_Id = $page;
  $fetch = mysqli_query($conn, "SELECT * FROM product WHERE p_Id='$p_Id'");
  $row = mysqli_fetch_array($fetch);
?>


  <!-- UPDATE -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3>Update Product</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product info</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-7">
          <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="p_Id" required value="<?php echo $row['p_Id']; ?>">
            <div class="card">
              <div class="card-header">
                <a class="h5 text-primary">Fill in the required fields</a>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Product ID</b></span>
                            <input type="text" class="form-control"  placeholder="Product ID" name="prod_Id" required value="<?php echo $row['prod_Id']; ?>" readonly>
                          </div>
                      </div>
                      <div class="col-lg-12 col col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <span class="text-dark"><b>Category</b></span>
                            <select class="form-control" name="cat_Id" required>
                              <option selected disabled value="">Select category</option>
                              <?php
                                $cat = mysqli_query($conn, "SELECT * FROM category ORDER BY cat_name"); 
                                if(mysqli_num_rows($cat) > 0) {
                                  while ($row_cat = mysqli_fetch_array($cat)) { 
                              ?>
                                    <option value="<?= $row_cat['cat_Id']; ?>" <?php if($row_cat['cat_Id'] == $row['cat_Id']) { echo 'selected'; } ?>><?= $row_cat['cat_name']; ?></option>
                              <?php }
                                } else {
                                  echo '<option value="">No record found</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-8 col col-md-8 col-sm-8 col-12">
                        <div class="form-group">
                            <span class="text-dark"><b>Product name</b></span>
                            <input type="text" class="form-control"  placeholder="Product name" name="prod_name" required value="<?php echo $row['prod_name']; ?>">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Stock</b></span>
                            <input type="number" class="form-control"  placeholder="Stock" name="prod_stock" required value="<?php echo $row['prod_stock']; ?>">
                          </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Product image</b></span>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)" >
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                            </div>
                            <p class="help-block text-danger">Max. 500KB</p>
                          </div>
                      </div>
                       <!-- LOAD IMAGE PREVIEW -->
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                          <div class="form-group" id="preview">
                          </div>
                      </div>
                  </div>
                  <!-- END ROW -->
              </div>
              <div class="card-footer">
                <div class="float-right">
                  <a href="product.php" class="btn bg-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <button type="submit" class="btn bg-primary" name="update_product" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END UPDATE -->


<?php } ?>



</div>

<?php } else { include '../includes/404.php'; } ?>

<?php include '../includes/footer.php';  ?>

