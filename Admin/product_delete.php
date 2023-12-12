<!-- ARCHIVE -->
<div class="modal fade" id="archive<?php echo $row['p_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-shopping-cart"></i> Archive product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['p_Id']; ?>" name="p_Id">
          <h6 class="text-center">Move this product to archive?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="archive_product"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- UNARCHIVE -->
<div class="modal fade" id="unarchive<?php echo $row['p_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-shopping-cart"></i> Unarchive product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['p_Id']; ?>" name="p_Id">
          <h6 class="text-center">Move this product back to records?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="unarchive_product"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['p_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-shopping-cart"></i> Delete product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['p_Id']; ?>" name="p_Id">
          <h6 class="text-center">Delete product record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_product"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- VIEW QR CODE -->
<!-- ... (your HTML code) ... -->

<div class="modal fade" id="qr_image<?php echo $row['p_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Product Image/QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                        <img src="../images-product/<?php echo $row['prod_image']; ?>" alt="" class="img-fluid d-block m-auto" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; object-fit: cover; height: 350px; width: 100%;">
                        <a href="../images-product/<?php echo $row['prod_image']; ?>" type="buttton" class="btn bg-gradient-primary mt-3" download><i class="fa-solid fa-download"></i> Download</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                        <img src="../images-QR Code/<?php echo $row['prod_qr']; ?>" alt="" class="img-fluid d-block m-auto" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; object-fit: cover; height: 350px; width: 100%;">
                        <a href="../images-QR Code/<?php echo $row['prod_qr']; ?>" type="button" class="btn bg-gradient-primary mt-3" download><i class="fa-solid fa-download"></i> Download</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- ... (the rest of your HTML code) ... -->
