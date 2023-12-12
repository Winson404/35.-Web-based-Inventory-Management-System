<title>IMS | Product information</title>
<?php 
    include 'navbar.php';
    if(isset($_GET['p_Id'])) {
    $p_Id = $_GET['p_Id'];
    $fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE p_Id='$p_Id'");
    $row = mysqli_fetch_array($fetch);
  ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product information</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12">
                <img src="../images-product/<?php echo $row['prod_image']; ?>" class="product-image" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Product ID: <?php echo $row['prod_Id']; ?></h3>
              <p>Product name: <?php echo $row['prod_name']; ?></p>
              <hr>

              <h4>Category : <?php echo $row['cat_name']; ?></h4>
              <hr>

              <h4>Stock : <?php echo $row['prod_stock']; ?></h4>
              <hr>

              <p class="font-italic">Date added: <?php echo date("F d, Y", strtotime($row['date_added'])); ?></p>
              <div class="py-2 px-3 mt-4">
                <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" class="img-fluid" alt="Product Image" width="180" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
              </div>

            </div>
          </div>
        </div>
        <div class="card-footer">
          <a href="javascript:history.back()" class="btn bg-secondary btn-flat float-right"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
      </div>
    </section>

  </div>
  <?php } else { include '../includes/404.php'; } ?>
<?php include '../includes/footer.php';  ?>

