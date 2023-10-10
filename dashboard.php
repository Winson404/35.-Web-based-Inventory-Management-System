<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="dist/css/login.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body>
<div id="dashboardMainContainer">
    <div class="dashboard_sidebar" id="dashboard_sidebar">
		<h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
		<div class="dashboard_sidebar_user">
			<img src="images/user/selena.jpg" alt="User image." id="userImage" />
			<span>fd</span>
		</div>
		 <div class="dashboard_sidebar_menus">
			<ul class="dashboard_menu_lists">
				<!--  class="menuActive" -->
			    <li>
					<a href="./dashboard.php"><i class="fa fa-dashboard"></i> <span class="menuText">Dashboard</span></a>
				</li>
				<li>
					<a href="./users-add.php"><i class="fa fa-user-plus"></i> <span class="menuText">Add User</span></a>
			</ul>
		</div>
	</div>
	<div class="dashboard_content_container" id="dashboard_content_container">
		   <div class="dashboard_topNav">
				<a href="" id="toggleBtn"><i class="fa fa-navicon"></i></a>
				<a href="database/logout.php" id="logoutBtn"><i class="fa fa-power-off"></i> Log-out</a>
			</div>
		<div class="dashboard_content">
			<div class="dashboard_content_main">	
			</div>
		</div>
	</div>
  </div>

  <script src="dist/js/script.js"></script>
</body>
</html>