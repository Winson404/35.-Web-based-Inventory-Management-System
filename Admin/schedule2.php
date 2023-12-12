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
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                
              </div>
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-md-3">
                    <div class="sticky-top mb-3">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Draggable Events</h4>
                        </div>
                        <div class="card-body">
                          <!-- the events -->
                          <div id="external-events">
                            <div class="external-event bg-success">Lunch</div>
                            <div class="external-event bg-warning">Go home</div>
                            <div class="external-event bg-info">Do homework</div>
                            <div class="external-event bg-primary">Work on UI design</div>
                            <div class="external-event bg-danger">Sleep tight</div>
                            <div class="checkbox">
                              <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                remove after drop
                              </label>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Create Event</h3>
                        </div>
                        <div class="card-body">
                          <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <ul class="fc-color-picker" id="color-chooser">
                              <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                              <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                              <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                              <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                              <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                            </ul>
                          </div>
                          <!-- /btn-group -->
                          <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                            <div class="input-group-append">
                              <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                            </div>
                            <!-- /btn-group -->
                          </div>
                          <!-- /input-group -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-9">
                    <div class="card card-primary">
                      <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          </div>
          <div class="col-md-8">
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
                    JOIN mechanic ON schedule.mechanic_Id = mechanic.Id ORDER BY selectedDate");
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td><?php echo ucwords($row['full_name']); ?></td>
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
                        <a class="btn btn-primary btn-sm" href="schedule_view.php?sched_Id=<?php echo $row['sched_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#approve<?php echo $row['sched_Id']; ?>"><i class="fas fa-pencil-alt"></i> Approve</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#deny<?php echo $row['sched_Id']; ?>"><i class="fas fa-times"></i> Deny</button>
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
  <script>
  $(function () {
  /* initialize the external events
  -----------------------------------------------------------------*/
  function ini_events(ele) {
  ele.each(function () {
  // create an Event Object (https://fullcalendar.io/docs/event-object)
  // it doesn't need to have a start or end
  var eventObject = {
  title: $.trim($(this).text()) // use the element's text as the event title
  }
  // store the Event Object in the DOM element so we can get to it later
  $(this).data('eventObject', eventObject)
  // make the event draggable using jQuery UI
  $(this).draggable({
  zIndex        : 1070,
  revert        : true, // will cause the event to go back to its
  revertDuration: 0  //  original position after the drag
  })
  })
  }
  ini_events($('#external-events div.external-event'))
  /* initialize the calendar
  -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date()
  var d    = date.getDate(),
  m    = date.getMonth(),
  y    = date.getFullYear()
  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendar.Draggable;
  var containerEl = document.getElementById('external-events');
  var checkbox = document.getElementById('drop-remove');
  var calendarEl = document.getElementById('calendar');
  // initialize the external events
  // -----------------------------------------------------------------
  new Draggable(containerEl, {
  itemSelector: '.external-event',
  eventData: function(eventEl) {
  return {
  title: eventEl.innerText,
  backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
  borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
  textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
  };
  }
  });
  var calendar = new Calendar(calendarEl, {
  headerToolbar: {
  left  : 'prev,next today',
  center: 'title',
  right : 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  themeSystem: 'bootstrap',
  //Random default events
  events: [
  {
  title          : 'All Day Event',
  start          : new Date(y, m, 1),
  backgroundColor: '#f56954', //red
  borderColor    : '#f56954', //red
  allDay         : true
  },
  {
  title          : 'Long Event',
  start          : new Date(y, m, d - 5),
  end            : new Date(y, m, d - 2),
  backgroundColor: '#f39c12', //yellow
  borderColor    : '#f39c12' //yellow
  },
  {
  title          : 'Meeting',
  start          : new Date(y, m, d, 10, 30),
  allDay         : false,
  backgroundColor: '#0073b7', //Blue
  borderColor    : '#0073b7' //Blue
  },
  {
  title          : 'Lunch',
  start          : new Date(y, m, d, 12, 0),
  end            : new Date(y, m, d, 14, 0),
  allDay         : false,
  backgroundColor: '#00c0ef', //Info (aqua)
  borderColor    : '#00c0ef' //Info (aqua)
  },
  {
  title          : 'Birthday Party',
  start          : new Date(y, m, d + 1, 19, 0),
  end            : new Date(y, m, d + 1, 22, 30),
  allDay         : false,
  backgroundColor: '#00a65a', //Success (green)
  borderColor    : '#00a65a' //Success (green)
  },
  {
  title          : 'Click for Google',
  start          : new Date(y, m, 28),
  end            : new Date(y, m, 29),
  url            : 'https://www.google.com/',
  backgroundColor: '#3c8dbc', //Primary (light-blue)
  borderColor    : '#3c8dbc' //Primary (light-blue)
  }
  ],
  editable  : true,
  droppable : true, // this allows things to be dropped onto the calendar !!!
  drop      : function(info) {
  // is the "remove after drop" checkbox checked?
  if (checkbox.checked) {
  // if so, remove the element from the "Draggable Events" list
  info.draggedEl.parentNode.removeChild(info.draggedEl);
  }
  }
  });
  calendar.render();
  // $('#calendar').fullCalendar()
  /* ADDING EVENTS */
  var currColor = '#3c8dbc' //Red by default
  // Color chooser button
  $('#color-chooser > li > a').click(function (e) {
  e.preventDefault()
  // Save color
  currColor = $(this).css('color')
  // Add color effect to button
  $('#add-new-event').css({
  'background-color': currColor,
  'border-color'    : currColor
  })
  })
  $('#add-new-event').click(function (e) {
  e.preventDefault()
  // Get value and make sure it is not null
  var val = $('#new-event').val()
  if (val.length == 0) {
  return
  }
  // Create events
  var event = $('<div />')
    event.css({
    'background-color': currColor,
    'border-color'    : currColor,
    'color'           : '#fff'
    }).addClass('external-event')
    event.text(val)
    $('#external-events').prepend(event)
    // Add draggable funtionality
    ini_events(event)
    // Remove event from text input
    $('#new-event').val('')
    })
    })
    </script>