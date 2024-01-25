<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

	
			<div class="container-fluid mt-4">
				<?php 
					if(isset($_GET['page'])) {
						$page = $_GET['page'];
						if($page == "create") {
				?>
						<div class="row d-flex justify-content-center">
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<h3 class="text-center text-secondary">Set New Schedule</h3>
								<hr>
								<div class="card" style="min-height: 526px;">
									<form action="../includes/processes.php" method="POST">
						              <div class="card-header">
						                <p>Fill-in the required fields</p>
						              </div>
						              <div class="card-body p-3">
						              	<div class="form-group">
					              			<input type="hidden" class="form-control" name="client_Id" value="<?= $Id; ?>" required>
						              	</div>
						              	<div class="form-group mb-3">
									        <label for="selectedDate">Date</label>
									        <input type="date" class="form-control" name="selectedDate" id="selectedDate" required >
										</div>
						              	<div class="form-group mb-3">
										    <label for="selectedTime">Time</label>
										    <input type="time" class="form-control" name="selectedTime" id="selectedTime" required >
						              	</div>
						              	<div class="form-group mb-3">
						              		<label for="services">Services</label>
											<select class="form-control" name="services" id="servicesDropdown" required onchange="toggleOtherServices()">
											    <option selected disabled value="">Select services</option>
											    <option value="Change oil">Change oil</option>
											    <option value="Minor tune up">Minor tune up</option>
											    <option value="Major tune up">Major tune up</option>
											    <option value="Engine oil">Engine oil</option>
											    <option value="Engine oil filter">Engine oil filter</option>
											    <option value="Gear oil">Gear oil</option>
											    <option value="Tappet Cap O-ring">Tappet Cap O-ring</option>
											    <option value="Timing Hole Cap O-ring">Timing Hole Cap O-ring</option>
											    <option value="Drain Plug Washer">Drain Plug Washer</option>
											    <option value="Gasket Cylinder Cover">Gasket Cylinder Cover</option>
											    <option value="Gasket Packing">Gasket Packing</option>
											    <option value="Spark Plug">Spark Plug</option>
											    <option value="Gasket Cylinder">Gasket Cylinder</option>
											    <option value="Gasket Cylinder Head">Gasket Cylinder Head</option>
											    <option value="Gasket Oil Filter">Gasket Oil Filter</option>
											    <option value="Piston">Piston</option>
											    <option value="Piston Ring">Piston Ring</option>
											    <option value="Air Filter Element">Air Filter Element</option>
											    <option value="Belt Drive">Belt Drive</option>
											    <option value="Brake Shoe">Brake Shoe</option>
											    <option value="Brake Pad">Brake Pad</option>
											    <option value="Head Light Bulb">Head Light Bulb</option>
											    <option value="Tail Light Bulb">Tail Light Bulb</option>
											    <option value="Others">Others</option>
											</select>
						              	</div>
						              	<div class="form-group mb-3" id="otherServicesGroup" style="display: none;">
						              		<label for="">Specify other service you want</label>
						              		<textarea name="otherServices" class="form-control" id="otherServices" cols="30" rows="2" placeholder="Specify other service you want"></textarea>
						              	</div>
						              </div>
						              <div class="card-footer">
						              	<button type="submit" class="btn btn-primary btn-sm float-right" name="save_Schedule"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
						              	<a href="schedule.php" class="btn btn-dark btn-sm mr-2 float-right"><i class="fa-solid fa-backward"></i> Back </a>
						              </div>
						            </form>
					            </div>
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<h3 class="text-center text-secondary">Services Scheduled on Calendar</h3>
								<hr>
								<div class="card">
									<div class="card-header">
						                <p>Schedules</p>
					                </div>
									<div class="card-body">
										<div id="calendar"></div>
									</div>
								</div>
							</div>
						</div>
				<?php
						} else {
						  $sched_Id = $page;
						  $fetch = '';
						  if($type == 'Client') {
						  	$fetch = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.client_Id='$Id' AND schedule.sched_Id='$sched_Id'");
						  } else {
						  	$fetch = mysqli_query($conn, "SELECT * FROM schedule JOIN mechanic ON schedule.mechanic_Id = mechanic.Id WHERE schedule.mechanic_Id='$Id' AND schedule.sched_Id='$sched_Id'");
						  }
						  
						  $row = mysqli_fetch_array($fetch);
				?>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<h3 class="text-center text-secondary">Update Schedule</h3>
							<hr>
							<div class="card" style="min-height: 526px;">
								<form action="../includes/processes.php" method="POST">
					              <div class="card-header">
					                <p>Fill-in the required fields</p>
					              </div>
					              <div class="card-body p-3">
					              	<div class="form-group">
				              			<input type="hidden" class="form-control" name="sched_Id" value="<?= $sched_Id; ?>" required>
					              	</div>
					              	
			              			<div class="form-group mb-3">
					              		<label for="">Date</label>
					              		<input type="date" class="form-control" name="selectedDate" required value="<?= $row['selectedDate'] ?>" id="selectedDate">
					              	</div>
					              	<div class="form-group mb-3">
					              		<label for="">Time</label>
			              				<input type="time" class="form-control" name="selectedTime" id="selectedTime" required value="<?= $row['selectedTime'] ?>">
					              	</div>
					              	<div class="form-group mb-3">
					              		<label for="services">Services</label>
										<select class="form-control" name="services" id="servicesDropdown" required onchange="toggleOtherServices()">
										    <option selected disabled value="">Select services</option>
										    <?php
										        $servicesList = [
										            "Change oil", "Minor tune up", "Major tune up", "Engine oil", "Engine oil filter",
										            "Gear oil", "Tappet Cap O-ring", "Timing Hole Cap O-ring", "Drain Plug Washer",
										            "Gasket Cylinder Cover", "Gasket Packing", "Spark Plug", "Gasket Cylinder",
										            "Gasket Cylinder Head", "Gasket Oil Filter", "Piston", "Piston Ring",
										            "Air Filter Element", "Belt Drive", "Brake Shoe", "Brake Pad", "Head Light Bulb",
										            "Tail Light Bulb", "Others"
										        ];

										        foreach ($servicesList as $service) {
										            $selected = ($row['services'] == $service) ? 'selected' : '';
										            echo "<option value=\"$service\" $selected>$service</option>";
										        }
										        ?>
										</select>
					              	</div>
					              	<?php if($row['services'] == "Others"): ?>
					              	<div class="form-group mb-3" id="otherServicesGroup">
					              		<label for="">Specify other service you want</label>
					              		<textarea name="otherServices" class="form-control" id="otherServices" cols="30" rows="2" placeholder="Specify other service you want"><?= $row['otherServices'] ?></textarea>
					              	</div>
									<?php endif; ?>
					              </div>
					              <div class="card-footer">
					              	<button type="submit" class="btn btn-primary btn-sm float-right" name="update_Schedule"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
					              	<a href="schedule.php" class="btn btn-dark btn-sm mr-2 float-right"><i class="fa-solid fa-backward"></i> Back </a>
					              </div>
					            </form>
				            </div>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<h3 class="text-center text-secondary">Services Scheduled on Calendar</h3>
							<hr>
							<div class="card">
								<div class="card-header">
					                <p>Schedules</p>
				                </div>
								<div class="card-body">
									<div id="calendar"></div>
								</div>
							</div>
						</div>
					</div>
				<?php
						}
					} else {
				?>
					<div class="error-content m-5 p-3">
				      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
				      <p>
				        We could not find the page you were looking for.
				        Meanwhile, you may <a href="index.php">return to home page.</a>
				      </p>
				    </div>
				<?php
					}
				?>
			</div>
	
<?php
  require_once 'footer.php';
  $query = mysqli_query($conn, "SELECT * FROM schedule s JOIN clients c ON s.client_Id=c.Id");

  $scheduledDates = array();

  while ($row = mysqli_fetch_assoc($query)) {
      $client_name = ucwords($row['firstname'].' '.$row['lastname']);
      $scheduledDates[] = array(
          'title' => $client_name.' '.$row['selectedTime'],
          // 'title' => $row['services'].' '.$row['selectedTime'],
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
<script>
    function toggleOtherServices() {
        var dropdown = document.getElementById("servicesDropdown");
        var otherServicesGroup = document.getElementById("otherServicesGroup");
        var otherServicesTextarea = document.getElementById("otherServices");

        // Check if the selected value is "Others"
        if (dropdown.value === "Others") {
            otherServicesGroup.style.display = "block";
            otherServicesTextarea.setAttribute("required", "required");
        } else {
            otherServicesGroup.style.display = "none";
            otherServicesTextarea.removeAttribute("required");
        }
    }

  // Get today's date in the format 'YYYY-MM-DD'
  const today = new Date().toISOString().split('T')[0];

  // Set the min attribute to the current date
  document.getElementById('selectedDate').min = today;


document.getElementById('selectedTime').addEventListener('change', function() {
    var selectedTime = this.value;

    if (selectedTime) {
        var selectedHour = parseInt(selectedTime.split(':')[0], 10);
        var selectedMinute = parseInt(selectedTime.split(':')[1], 10);

        if (selectedHour < 8 || (selectedHour === 17 && selectedMinute > 0) || selectedHour > 17) {
            alert('Please select a time between 8:00 AM and 5:00 PM.');
            this.value = ''; // Clear the input
        }
    }
});
</script>



