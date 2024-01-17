<title>IMS | Home</title>
<?php include 'navbar.php'; ?>
<style>
	.banner {
    	position: relative;
	}

	.overlay {
	    position: absolute;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	    background-color: rgba(0, 0, 0, 0.6);
	    z-index: 1;
	}

	.homepageContainer {
	    position: relative;
	    z-index: 2;
	    text-decoration: none;
      margin-bottom: none;
	}
	.bannerTagline {
		text-shadow: 2px 2px 1px rgba(0, 0, 1, 0.5); z-index: 2;
	}
	 .homepageContainer a.active {
        background-color: white;
        color: #f685a2;
        border-radius: 5px;
    }
</style>
<div class="banner" style="background-image: url('../images/schedule.jpg');">
    <div class="overlay"></div>
    <div class="homepageContainer">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="bannerHeader">
                    <h1>RBF</h1>
                    <p>Online Scheduling</p>
                </div>
                <p class="bannerTagline">
                    Track your goods throughout your entire supply chain, from purchasing to production to end sales
                </p>
                <!-- <button id="scanButton" class="btn" style="background-color: #f685a2;"><i class="fa-solid fa-camera"></i> Scan QR</button> -->
            </div>

            <!-- Right Section -->
           <!--  <div class="col-lg-4 col-md-12 col-sm-12 col-12 bg-light pb-2"  id="containerScanner"  style="margin-top: -30px; display: none;">
                <div class="card-header text-center justify-content-center d-flex p-0">
                    <div class="col-12 p-2">
                        
                        <a class="h3"><b>INPUT QR CODE</b></a>
                        <p>Please place the QR Code located at the back of your ID in front of the camera.</p>
                    </div>
                </div>
                <form action="../includes/processes.php" method="POST" class="form-horizontal">
                    <input type="hidden" name="productQR" id="productQR" class="form-control" autofocus>
                </form>
                <div class="card-body p-2">
                    <div class="position-relative">
                        <div class="d-block m-auto bg-dark">
                            <video id="preview" width="100%" class="shadow-sm" style="border: 4px solid gray;"></video>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn d-block m-auto" id="clickMe" onclick="refreshPage()" style="background-color: #f685a2;"><i class="fa-solid fa-camera"></i> RESET CAMERA</button>
                </div>
            </div> -->
        </div>
    </div>
</div>






	<?php require_once 'footer.php'; ?>
<!-- <script type="text/javascript" src="../plugins/instascan.min.js"></script>
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
        location.reload();
        load_upmodal();
    }
</script> -->