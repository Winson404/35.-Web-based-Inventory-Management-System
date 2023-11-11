<title>IMS | Schedule records</title>s
<?php 
		include 'navbar.php'; 
?>
<div class="homepageContainer">
	<div class="homepageFeatures">
		<div class="container-fluid">
			<?php 
				if(isset($_GET['sched_Id'])) {
				$sched_Id = $_GET['sched_Id'];
				$sql = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address,
					CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
					FROM schedule
					JOIN clients ON schedule.client_Id = clients.Id
					JOIN mechanic ON schedule.mechanic_Id = mechanic.Id WHERE schedule.client_Id='$Id' AND schedule.sched_Id='$sched_Id' ORDER BY selectedDate DESC");
				$row = mysqli_fetch_array($sql);
			?>
			<h3 class="text-center text-secondary">Approved Schedule</h3>
			<hr>
			<div class="card">
				<div class="card-header p-2">
					<button id="printButton" class="btn btn-success btn-sm float-right mr-2"><i class="fa-solid fa-print"></i> Print</button>
				</div>
			<div class="card-body p-3">
				<div class="wrapper">
					<section class="invoice p-3" id="printElement">
						<div class="row">
							<div class="col-12">
								<h2 class="page-header">
								<i class="fas fa-globe"></i> Approved Schedule
								<small class="float-right">Date: <?= date('Y-m-d') ?></small>
								</h2>
							</div>
						</div>
						<div class="col-6">
							<p class="lead">Date approved: <?= date("F d, Y h:i:s A", strtotime($row['date_approved'])) ?></p>
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th style="width:50%">Client name:</th>
										<td><?= ucwords($row['full_name']) ?></td>
									</tr>
									<tr>
										<th>Selected Date:</th>
										<td><?= date("F d, Y", strtotime($row['selectedDate'])) ?></td>
									</tr>
									<tr>
										<th>Selected Time:</th>
										<td><?= date("h:i A", strtotime($row['selectedTime'])) ?></td>
									</tr>
									<tr>
										<th>Mechanic name:</th>
										<td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-12 table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Services</th>
											<th>Other Services</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= $row['services'] ?></td>
											<td><?= $row['otherServices'] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="card-footer">
				<a href="schedule.php" class="btn btn-dark btn-sm float-right">Back</a>
			</div>
		</div>
		<?php } else { ?>
			<div class="error-page">
		        <h2 class="headline text-warning"> 404</h2>
		        <div class="error-content">
		          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
		          <p>
		            We could not find the page you were looking for.
		            Meanwhile, you may <a href="index.php">return to home page.</a>
		          </p>
		          <!-- <form class="search-form">
		            <div class="input-group">
		              <input type="text" name="search" class="form-control" placeholder="Search">

		              <div class="input-group-append">
		                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
		                </button>
		              </div>
		            </div>
		          </form> -->
		        </div>
		      </div>
		<?php } ?>
	</div>
</div>
</div>
<script>
// window.addEventListener("load", window.print());
</script>
<script src="../includes/print.js"></script>
<?php require_once 'footer.php'; ?>