<!-- APPROVE -->
<div class="modal fade" id="approve<?php echo $row['sched_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-check"></i> Approve schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sched_Id']; ?>" name="sched_Id">
          <input type="hidden" class="form-control" value="1" name="status">
          <h6 class="text-center">Are you sure you want to approve this schedule?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_schedule_Status"><i class="fas fa-check"></i> Approve</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- DENY -->
<div class="modal fade" id="deny<?php echo $row['sched_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-times"></i> Deny schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sched_Id']; ?>" name="sched_Id">
          <input type="hidden" class="form-control" value="2" name="status">
          <h6 class="text-center">Are you sure you want to approve this schedule?</h6>
          <div class="form-group mt-4">
            <textarea name="reason" class="form-control" id="" cols="30" rows="3" placeholder="Enter reason for rejecting the schedule" required></textarea>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-warning" name="update_schedule_Status"><i class="fas fa-times"></i> Deny</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['sched_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-calendar"></i> Delete Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sched_Id']; ?>" name="sched_Id">
          <h6 class="text-center">Delete schedule record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_schedule"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>




<!-- DELETE -->
<div class="modal fade" id="assign<?php echo $row['sched_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Assign Mechanic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../includes/processes.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sched_Id']; ?>" name="sched_Id">
          <div class="form-group">
            <select name="mechanic_Id" class="form-control" id="" required>
              <option value="" selected disabled>Select mechanic</option>
              <?php 
                $exist_mechanic = $row['mechanic_Id'];
                $rec = mysqli_query($conn, "SELECT * FROM mechanic WHERE status=1");
                if(mysqli_num_rows($rec) > 0) {
                  while($r_rec = mysqli_fetch_array($rec)) {
                    echo '<option value="' . $r_rec['Id'] . '" ' . ($r_rec['Id'] == $exist_mechanic ? 'selected' : '') . '>'. ucwords($r_rec['firstname']) . ' ' . ucwords($r_rec['middlename']) . ' ' . ucwords($r_rec['lastname']). ' ' . ucwords($r_rec['suffix']) . '</option>';

                  }
                } else {
                  echo '<option value="" selected disabled>No record found</option>';
                }
              ?>
            </select>
          </div>  
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Back</button>
        <button type="submit" class="btn bg-primary" name="assign_mechanic"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>





