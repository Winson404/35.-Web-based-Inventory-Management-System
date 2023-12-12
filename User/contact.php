<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>
<div class="homepageContainer">
	<div class="homepageFeatures">
		<div class="container-fluid">
			<h3 class="text-center text-secondary">Contact Us</h3>
			<hr>
			<div class="card">
				<div class="card-body row">
					<div class="col-5 text-center d-flex align-items-center justify-content-center">
						<div class="">
							<h2>SCHEDULING<strong> SYSTEM</strong></h2>
							<p class="lead mb-5">sample<br>
								Phone: +1 234 56789012
							</p>
						</div>
					</div>
					<div class="col-7">
						<form action="../includes/processes.php" method="POST">
							<div class="form-group">
								<label for="inputName">Name</label>
								<input type="text" id="inputName" class="form-control"  name="name" required />
							</div>
							<div class="form-group">
								<label for="inputEmail">E-Mail</label>
								<input type="email" id="inputEmail" class="form-control"  name="email" required />
							</div>
							<div class="form-group">
								<label for="inputSubject">Subject</label>
								<input type="text" id="inputSubject" class="form-control"  name="subject" required />
							</div>
							<div class="form-group">
								<label for="inputMessage">Message</label>
								<textarea id="inputMessage" class="form-control" rows="4" name="message" required ></textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" value="Send message" name="sendEmail">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'sweetalert_messages.php'; ?>
<?php require_once 'footer.php'; ?>