<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

<div class="homepageContainer">
	<div class="homepageFeatures">
		<div class="container-fluid">
			<h3 class="text-center text-secondary">Schedule Records</h3>
			<hr>
			<div class="card">
				<div class="card-header p-2">
					<a href="schedule_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> Set new schedule</a><div class="card-tools mr-1 mt-3">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body p-3">
				<table id="example11" class="table table-bordered table-hover text-sm">
					<thead>
						<tr>
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
						$sql = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address,
						CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
						FROM schedule
						JOIN clients ON schedule.client_Id = clients.Id
						JOIN mechanic ON schedule.mechanic_Id = mechanic.Id WHERE schedule.client_Id='$Id' ORDER BY selectedDate DESC");
						while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
							<td><?php echo $row['services']; ?></td>
							<td class="text-primary"><?php echo date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])); ?></td>
							<td>
								<?php if($row['status'] == 0): ?>
								<span class="badge bg-warning pt-1">Pending</span>
								<?php elseif($row['status'] == 1): ?>
								<span class="badge bg-success pt-1">Approved</span>
								<?php else: ?>
								<span class="badge bg-danger pt-1">Danger</span>
								<?php endif; ?>
							</td>
							<td>
								<a class="btn btn-primary btn-sm" href="schedule_view.php?sched_Id=<?php echo $row['sched_Id']; ?>"><i class="fas fa-folder"></i> View</a>
								<?php if($row['status'] == 0): ?>
								<a class="btn btn-info btn-sm" href="schedule_mgmt.php?page=<?php echo $row['sched_Id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
								<button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sched_Id']; ?>"><i class="fas fa-trash"></i> Delete</button>
								<button class="btn btn-success btn-sm float-right mr-2" disabled><i class="fa-solid fa-print"></i> Print</button>
								<?php elseif($row['status'] == 1): ?>
								<a class="btn btn-info btn-sm" href="schedule_mgmt.php?page=<?php echo $row['sched_Id']; ?>" style="pointer-events: none;opacity: .5;"><i class="fas fa-pencil-alt"></i> Edit</a>
								<button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sched_Id']; ?>" disabled><i class="fas fa-trash"></i> Delete</button>
								<a href="schedule_print.php?sched_Id=<?php echo $row['sched_Id']; ?>" class="btn btn-success btn-sm float-right mr-2"><i class="fa-solid fa-print"></i> Print</a>
								<?php else: ?>
								<a class="btn btn-info btn-sm" href="schedule_mgmt.php?page=<?php echo $row['sched_Id']; ?>" style="pointer-events: none;opacity: .5;"><i class="fas fa-pencil-alt"></i> Edit</a>
								<button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sched_Id']; ?>" disabled><i class="fas fa-trash"></i> Delete</button>
								<button class="btn btn-success btn-sm float-right mr-2" disabled><i class="fa-solid fa-print"></i> Print</button>
								<?php endif; ?>
								
							</td>
						</tr>
						<?php include 'schedule_delete.php';
						} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<?php require_once 'footer.php'; ?>