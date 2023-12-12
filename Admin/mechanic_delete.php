<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Delete Mechanic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['Id']; ?>" name="Id">
          <h6 class="text-center">Delete mechanic record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_mechanic"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- DELETE -->
<div class="modal fade" id="status<?php echo $row['Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['Id']; ?>" name="Id">
          <div class="form-group">
            <span class="text-dark"><b>Status</b></span>
            <select name="status" class="form-control" id="" required>
              <option value="0" <?php if($row['status'] == 0) { echo 'selected'; } ?>>Unavailable</option>
              <option value="1" <?php if($row['status'] == 1) { echo 'selected'; } ?>>Available</option>
            </select>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="status_mechanic"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>
