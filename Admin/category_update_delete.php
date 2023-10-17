<!-- Update -->
<div class="modal fade" id="update<?php echo $row['cat_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-tags"></i> Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <input type="hidden" class="form-control" placeholder="Category name" name="cat_Id" required value="<?php echo $row['cat_Id']; ?>">
          <div class="col-lg-12">
              <div class="form-group">
                <label>Category name</label>
                <input type="text" class="form-control"  placeholder="Category name" name="cat_name" required value="<?php echo $row['cat_name']; ?>">
              </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
                <label>Category description</label>
                <input type="text" class="form-control"  placeholder="Category description" name="cat_description" required value="<?php echo $row['cat_description']; ?>">
            </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info" name="update_category">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************DELETE*********************************************************************** -->
<div class="modal fade" id="delete<?php echo $row['cat_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-tags"></i> Delete category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['cat_Id']; ?>" name="cat_Id">
          <h6 class="text-center">Delete category record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_category">Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>



