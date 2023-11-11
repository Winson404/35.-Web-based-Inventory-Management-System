<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Schedule records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Schedule records</li>
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
                <!-- <a href="mechanic_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Schedule</a> -->
                <div class="card-tools mr-1 mt-2">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <div class="row mb-2">
                   <a href="../includes/processes.php?pdfExport=Schedule" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Schedule" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="schedule_print.php" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>CLIENT NAME</th>
                    <th>SERVICES</th>
                    <th>SCHEDULED DATE-TIME</th>
                    <th>STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        // $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id=clients.Id JOIN mechanic ON schedule.mechanic_Id=mechanic.Id ORDER BY selectedDate DESC ");
                        $sql = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address, 
                                CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
                                FROM schedule 
                                JOIN clients ON schedule.client_Id = clients.Id 
                                JOIN mechanic ON schedule.mechanic_Id = mechanic.Id ORDER BY selectedDate DESC");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                    <tr>

                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['services']; ?></td>
                        <td class="text-primary"><?php echo date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])); ?></td>
                        <td>
                          <?php if($row['status'] == 0): ?>
                            <span class="badge bg-warning pt-1">Pending</span>
                          <?php elseif($row['status'] == 1): ?>
                            <span class="badge bg-success pt-1">Approved</span>
                          <?php else: ?>
                            <span class="badge bg-danger pt-1">Denied</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="schedule_view.php?sched_Id=<?php echo $row['sched_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                          <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateStatus<?php echo $row['sched_Id']; ?>"><i class="fas fa-pencil-alt"></i> Update status</button>
                          <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sched_Id']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        </td> 
                    </tr>

                    <?php include 'schedule_update_delete.php'; } ?>
                     

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