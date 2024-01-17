<title>IMS | Product information</title>
<?php
include 'navbar.php';
if(isset($_GET['p_Id'])) {
$p_Id = $_GET['p_Id'];
$fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE p_Id='$p_Id'");
$row = mysqli_fetch_array($fetch);
?>
<div class="homepageContainer">
  <div class="homepageFeatures">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header d-flex">
            <h4>Product details</h4>
            <button type="button" class="btn btn-tool ml-auto" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div class="card-body p-3">
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
              <p>Product branch:
                <?php
                if ($row['branch'] == 1) {
                echo 'M.H.del Pilar St, Calamba, Laguna';
                } elseif ($row['branch'] == 2) {
                echo 'Mabuhay City Road Cabuyao, Laguna';
                } else {
                echo 'Admin by Superadmin';
                }
                ?>
                
              </p>
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
      </div>
    </div>
  </div>
</div>
<?php } else { include '../includes/404.php'; } ?>
<?php require_once 'footer.php'; ?>