<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Schedule</h3>
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
          <div class="col-lg-7 col-md-7 col-sm-12 col-12">
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
                   <a href="../includes/processes.php?pdfExport=Schedule&&assigned_branch=<?= $assigned_branch ?>" class="btn btn-xs bg-danger ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                   <a href="../includes/processes.php?ExcelExport=Schedule&&assigned_branch=<?= $assigned_branch ?>" class="btn btn-xs bg-success float-right ml-1"><i class="fa-solid fa-file-excel"></i> Excel</a>
                   <a href="schedule_print.php" class="btn btn-xs bg-secondary float-right ml-1"><i class="fas fa-print"></i> Print</a>
                 </div>
                 <table id="example11" class="table table-bordered table-hover table-sm text-sm">
                  <thead>
                  <tr> 
                    <th>CLIENT NAME</th>
                    <th>MECHANIC NAME</th>
                    <th>SERVICES</th>
                    <th>SCHEDULED DATE-TIME</th>
                    <th>STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        // $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id=clients.Id JOIN mechanic ON schedule.mechanic_Id=mechanic.Id ORDER BY selectedDate DESC ");
                        $sql = '';
                        if($assigned_branch == 0) {
                          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() ORDER BY schedule.selectedDate");
                        } else {
                          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch ORDER BY schedule.selectedDate");
                        }
                        
                        while ($row = mysqli_fetch_array($sql)) {
                        $mech_Id = '';
                        $mech_name = '';

                        $mech_Id = $row['mechanic_Id'];
                        $get_mech = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$mech_Id'");
                        if(mysqli_num_rows($get_mech) > 0){
                          $row2 = mysqli_fetch_array($get_mech);
                          $mech_name = ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']);
                        } else {
                          $mech_name = 'No Mechanic Available';
                        }
                      ?>
                    <tr>
                        <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                        <td><?php echo $mech_name; ?></td>
                        <td><?php echo ucwords($row['services']); ?></td>
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
                          <a class="btn btn-primary btn-xs" href="schedule_view.php?sched_Id=<?php echo $row['sched_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                          <button type="button" class="btn bg-success btn-xs" data-toggle="modal" data-target="#assign<?php echo $row['sched_Id']; ?>"><i class="fas fa-user-plus"></i> Assign</button>
                          <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#approve<?php echo $row['sched_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?> <?php if($row['status'] == 1) { echo 'disabled'; } ?> ><i class="fas fa-pencil-alt"></i> Approve</button>
                          <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#deny<?php echo $row['sched_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-times"></i> Deny</button>
                          <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['sched_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?> <?php if($row['status'] == 2) { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                        </td> 
                    </tr>

                    <?php include 'schedule_update_delete.php'; } ?>
                     

                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-12 col-12">
            <div class="card">
              <div class="card-body">
                <div id="calendar"></div>
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
<?php 
  include '../includes/footer.php';
  $query = mysqli_query($conn, "SELECT * FROM schedule");

  $scheduledDates = array();

  while ($row = mysqli_fetch_assoc($query)) {
      $scheduledDates[] = array(
          'title' => $row['services'].' '.$row['selectedTime'],
          'start' => $row['selectedDate'],
          'backgroundColor' => 'green'
      );
  }

// Close the database connection if needed

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var scheduledDates = <?php echo json_encode($scheduledDates); ?>;

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: scheduledDates,
            eventRender: function (info) {
                // Customize the rendering based on your requirements
                // You can access event properties using info.event
                // For example, info.event.title, info.event.start, etc.

                // Customize background color for events
                info.el.style.backgroundColor = info.event.backgroundColor;
                info.el.style.fontSize = '1px';
            },
            editable: true,
            droppable: true,
            drop: function (info) {
                // Handle dropped events if needed
            }
        });

        calendar.render();
    });
</script>