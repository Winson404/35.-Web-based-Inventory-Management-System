<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

	
	<div class="homepageContainer">
		<div class="homepageFeatures">
			<div class="container-fluid">
				<?php 
					if(isset($_GET['page'])) {
						$page = $_GET['page'];
						if($page == "create") {
				?>
						<div class="row d-flex justify-content-center">
							<div class="col-lg-8 col-md-8 col-sm-10 col-12">
								<h3 class="text-center text-secondary">Set New Schedule</h3>
								<hr>
								<div class="card">
									<form action="../includes/processes.php" method="POST">
						              <div class="card-header">
						                <p>Fill-in the required fields</p>
						              </div>
						              <div class="card-body p-3">
						              	<div class="form-group">
					              			<input type="hidden" class="form-control" name="client_Id" value="<?= $Id; ?>" required>
						              	</div>
						              	<div class="form-group mb-3">
						              		<div class="row">
						              			<div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
											        <label for="selectedDate">Date</label>
											        <input type="date" class="form-control" name="selectedDate" id="selectedDate" required>
												</div>
								              	<div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
								              		<label for="">Time</label>
						              				<input type="time" class="form-control" name="selectedTime" required>
								              	</div>
						              		</div>
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
						              	<div class="form-group mb-3">
						              		<label for="services">Mechanic name</label>
											<select class="form-control" name="mechanic_Id" required>
											    <option selected disabled value="">Select mechanic</option>
											    <?php 
											    	$get_Mech = mysqli_query($conn, "SELECT * FROM mechanic ORDER BY lastname");
											    	if(mysqli_num_rows($get_Mech) > 0) {
											    		while($row = mysqli_fetch_array($get_Mech)) {
											    			echo '<option value="'.$row['Id'].'">'.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].'</option>';
											    		}
											    	} else {
											    		echo '<option selected disabled value="">No record found</option>';
											    	}
											    ?>
											</select>
						              	</div>
						              </div>
						              <div class="card-footer">
						              	<button type="submit" class="btn btn-primary btn-sm float-right" name="save_Schedule"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
						              	<a href="schedule.php" class="btn btn-dark btn-sm mr-2 float-right"><i class="fa-solid fa-backward"></i> Back </a>
						              </div>
						            </form>
					            </div>
							</div>	
						</div>
				<?php
						} else {
						  $sched_Id = $page;
						  $fetch = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address, 
	                                CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
	                                FROM schedule 
	                                JOIN clients ON schedule.client_Id = clients.Id 
	                                JOIN mechanic ON schedule.mechanic_Id = mechanic.Id WHERE schedule.client_Id='$Id' AND sched_Id='$sched_Id'");
						  $row = mysqli_fetch_array($fetch);
				?>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-md-8 col-sm-10 col-12">
							<h3 class="text-center text-secondary">Update Schedule</h3>
							<hr>
							<div class="card">
								<form action="../includes/processes.php" method="POST">
					              <div class="card-header">
					                <p>Fill-in the required fields</p>
					              </div>
					              <div class="card-body p-3">
					              	<div class="form-group">
				              			<input type="hidden" class="form-control" name="sched_Id" value="<?= $sched_Id; ?>" required>
					              	</div>
					              	<div class="form-group mb-3">
					              		<div class="row">
					              			<div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
							              		<label for="">Date</label>
							              		<input type="date" class="form-control" name="selectedDate" required value="<?= $row['selectedDate'] ?>" id="selectedDate">
							              	</div>
							              	<div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
							              		<label for="">Time</label>
					              				<input type="time" class="form-control" name="selectedTime" required value="<?= $row['selectedTime'] ?>">
							              	</div>
					              		</div>
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
					              	<div class="form-group mb-3">
					              		<label for="services">Mechanic name</label>
										<select class="form-control" name="mechanic_Id" required>
										    <option selected disabled value="">Select mechanic</option>
										    <?php 
										    	$mech_Id = $row['mechanic_Id'];
										    	$get_Mech = mysqli_query($conn, "SELECT * FROM mechanic ORDER BY lastname");
										    	if(mysqli_num_rows($get_Mech) > 0) {
										    		while($row = mysqli_fetch_array($get_Mech)) { ?>
										    			<option value="<?= $row['Id']; ?>" <?php if($row['Id'] == $mech_Id) { echo 'selected'; } ?>><?= $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></option>
										    <?php 		}
										    	} else {
										    		echo '<option selected disabled value="">No record found</option>';
										    	}
										    ?>
										</select>
					              	</div>
					              </div>
					              <div class="card-footer">
					              	<button type="submit" class="btn btn-primary btn-sm float-right" name="update_Schedule"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
					              	<a href="schedule.php" class="btn btn-dark btn-sm mr-2 float-right"><i class="fa-solid fa-backward"></i> Back </a>
					              </div>
					            </form>
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
		</div>
	</div>
	
	<?php require_once 'footer.php'; ?>
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
	</script>





