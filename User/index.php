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
			<div class="bannerHeader">
				<h1>IMS</h1>
				<p>Inventory Management System</p>
			</div>
			<p class="bannerTagline">
				Track your goods throughout your entire supply chain, from purchasing to production to end sales
			</p>
			<div class="bannerIcons">
				<a href=""><i class="fa fa-apple"></i></a>
				<a href=""><i class="fa fa-android"></i></a>
				<a href=""><i class="fa fa-windows"></i></a>
			</div>
		</div>
	</div>



	<div class="homepageContainer">
		<div class="homepageFeatures">
			<div class="homepageFeature">
				<span class="featureIcon"><i class="fa fa-gear"></i></span>
				<h3 class="featureTitle">Editable Theme</h3>
				<p class="featureDescription">qwertyuiopasdfghjkaasd
				fghjwertyuiqwertyu</p>
			</div>
			<div class="homepageFeature">
				<span class="featureIcon"><i class="fa fa-star"></i></span>
				<h3 class="featureTitle">Flat Design</h3>
				<p class="featureDescription">qwertyuiopasdfghjkaasd
				fghjwertyuiqwertyu</p>
			</div>
			<div class="homepageFeature">
				<span class="featureIcon"><i class="fa fa-globe"></i></span>
				<h3 class="featureTitle">Reach Your Audience</h3>
				<p class="featureDescription">qwertyuiopasdfghjkaasdf
				ghjwertyuiqwertyu</p>
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
	<?php require_once 'footer.php'; ?>