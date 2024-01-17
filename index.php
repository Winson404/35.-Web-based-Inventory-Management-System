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
	.hover-effect {
    position: relative;
    display: inline-block;
}

.hover-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    text-align: center;
    color: black;
}

.hover-effect:hover .hover-text {
    opacity: 1;
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
<div class="banner">
	<div class="homepageContainer p-5">
		<div class="row">
			<div class="col-lg-12 col-md-12 mb-2">
				<div class="bannerHeader" style="margin-top: -120px;">
					<h1>RBF</h1>
					<p style="margin-top: -20px;">Online Scheduling</p>
					<button id="scanButton" class="btn btn-sm" style="background-color: #f685a2; color: white;"><i class="fa-solid fa-camera"></i> Scan QR</button>
				</div>
			</div>
			<!-- Right Section -->
			<div class="col-lg-4 col-md-4 col-sm-12 col-12 bg-light" id="containerScanner" style="display: none;">
				<div class="card-header text-center justify-content-center d-flex p-0 ">
					<div class="col-12">
						<p>Place the QR Code</p>
					</div>
				</div>
				<form action="includes/processes.php" method="POST" class="form-horizontal">
					<input type="hidden" name="productQR" id="productQR" class="form-control" autofocus>
				</form>
				<div class="card-body p-0">
					<div class="d-block m-auto bg-dark">
					<video id="preview" width="100%" class="shadow-sm" style="border: 2px solid gray;"></video>
				</div>
			</div>
			<div class="m-2">
				<button type="button" class="btn d-block btn-xs m-auto text-white" id="clickMe" onclick="refreshPage()" style="background-color: #f685a2;"><i class="fa-solid fa-camera"></i> RESET CAMERA</button>
			</div>
		</div>
	</div>
	<div class="col-md-8 position-absolute" style="right:10px; top:70px">
		<div class="row d-flex justify-content-end">
			<!-- First Div -->
			<div class="col-md-3 bg-red">
				
				<div style="display: flex; flex-direction: column; width: 60px; border-radius: 50%; position: absolute; right: 0;">
					<a href="login.php?page=branch-1" class="hover-effect">
						<div style="height: 60px; border-radius: 50%; overflow: hidden; display: flex;">
							<!-- Picture goes here -->
							<img src="images/user.png" alt="Branch Picture 1" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
						</div>
						<span class="hover-text"><b>Admin 1</b></span>
					</a>
					<a href="login.php?page=branch-2" class="hover-effect">
						<div style="height: 60px; border-radius: 50%; overflow: hidden;">
							<!-- Picture goes here -->
							<img src="images/user.png" alt="Branch Picture 2" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
						</div>
						<span class="hover-text"><b>Admin 2</b></span>
					</a>
				</div>
			</div>
			
			
		</div>
	</div>
</div>
</div>
</div>
	
	
<?php require_once 'footer.php'; ?>
<script type="text/javascript" src="plugins/instascan.min.js"></script>
<script>
    document.getElementById("scanButton").addEventListener("click", function () {
        document.getElementById("containerScanner").style.display = "block";
        load_upmodal();
    });

    function load_upmodal() {
        document.getElementById("containerScanner").classList.remove("bg-dark");
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
                document.getElementById("containerScanner").classList.add("bg-dark");
            }
        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (c) {
            document.getElementById('productQR').value = c;
            document.forms[0].submit();
        });
    }

    // REFRESH PAGE ON BUTTON CLICK
	 function refreshPage() {
	    document.getElementById("containerScanner").style.display = "block";
	    load_upmodal();
	    document.getElementById('productQR').value = '';
	    window.scrollTo(0, 0);
	}




</script>