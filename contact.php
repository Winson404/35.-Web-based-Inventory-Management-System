<title>IMS Homepage - Inventory Management System</title>
<?php 
	include 'navbar.php'; 
	$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
	.homepageContainer a.active {
        background-color: white;
        color: #f685a2;
        border-radius: 5px;
    }
</style>
<body>
	<div class="header">
		<div class="homepageContainer">
			<a class="m-2 <?php echo $current_page === 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
			<a class="m-2 <?php echo $current_page === 'about-us.php' ? 'active' : ''; ?>" href="about-us.php">About Us</a>
			<a class="m-2 <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
			<a class="m-2 <?php echo $current_page === 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
		</div>
	</div>

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
						<form action="includes/processes.php" method="POST">
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
								<input type="submit" class="btn btn-primary" value="Send message" name="sendEmailHome">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="homepageNotified">
		<div class="homepageContainer">
			<div class="homepageNotifiedContainer">
				<div class="emailForm">
					<h3>Get Notified Of An Any Updates!</h3>
					<p>qwertyuiopqwertyuiopwertyu
						qwertyuioqwertyuiowertyuiowertyuio
					qwertyuiopwertyuiopwertyuiopertyuioperty</p>
					<form action="">
						<div class="formContainer">
							<input type="text" placeholder="Email Address" />
							<button>Notify</button>
						</div>
					</form>
				</div>
				<div class="video">
					<iframe src="https://www.youtube.com/embed/48VkVOHYGWw" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
	<div class="socials">
		<div class="homepageContainer">
			<h3 class="socialHeader">Say Hi & Get In Touch</h3>
			<p class="socialText">qwertyuiopwertyuiuid   dfwfdfguwgfghf dffyfyfyuqsfysff</p>
			<div class="socialIconsContainer">
				<a href=""><i class="fa fa-twitter"></i></a>
				<a href=""><i class="fa fa-facebook"></i></a>
				<a href=""><i class="fa fa-pinterest"></i></a>
				<a href=""><i class="fa fa-google-plus"></i></a>
				<a href=""><i class="fa fa-linkedin"></i></a>
				<a href=""><i class="fa fa-youtube"></i></a>
			</div>
			
		</div>
	</div>
	<div class="footer">
		<div class="homepageContainer">
			<a href="">Contact</a>
			<a href="">Download</a>
			<a href="">Press</a>
			<a href="">Email</a>
			<a href="">Support</a>
			<a href="">Privacy Policy</a>
		</div>
	</div>

<script src="sweetalert2.min.js"></script>

<!-- SUCCESS -->
<?php if(isset($_SESSION['success']) && isset($_SESSION['text']) && isset($_SESSION['status'])) { ?>

    <script>
      swal ({
        title: '<?php echo $_SESSION['success']; ?>',
        text: "<?php echo $_SESSION['text']; ?>",
        icon: "<?php echo $_SESSION['status']; ?>",
        confirmButtonColor: '#3085d6',
        confirmButtonText: "Okay",
        timer: 4000
      });

    </script>

<?php unset($_SESSION['success']); unset($_SESSION['text']); unset($_SESSION['status']); } ?>

<?php require_once 'footer.php'; ?>