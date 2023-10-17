<?php 
	include '../config.php';
	include('../phpqrcode/qrlib.php');
	include 'functions.php';
	// use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require 'vendor/PHPMailer/src/Exception.php';
    // require 'vendor/PHPMailer/src/PHPMailer.php';
    // require 'vendor/PHPMailer/src/SMTP.php';

	// USERS LOGIN - LOGIN.PHP
	if(isset($_POST['login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		// Check if the user has attempted to log in before
		if (!isset($_SESSION['login_attempts'])) {
		    $_SESSION['login_attempts'] = 0;
		}

		// Check if the user has reached the maximum number of login attempts
		if ($_SESSION['login_attempts'] > 3) {
		    // Check if the user has been blocked for 30 minutes
		    if (time() - $_SESSION['last_login_attempt'] <= 600) {
		        // User is still blocked, display an error message and exit
				displayErrorMessage("You have been blocked for 10 minutes due to multiple failed login attempts.", "../login.php");
		    } else {
		        // Block has expired, reset the login attempts counter
		        $_SESSION['login_attempts'] = 0;
		    }
		}

		$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
		if(mysqli_num_rows($check)===1) {
			$row = mysqli_fetch_array($check);
			// $position = $row['user_type'];

			$log_ID = $row['user_Id'];
			$login_time = date("Y-m-d h:i A");
			$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_time) VALUES ('$log_ID', '$login_time')");

			// if($position == 'Admin') {
				$_SESSION['login_attempts'] = 0;
	    		$_SESSION['last_login_attempt'] = time();
				$_SESSION['admin_Id'] = $row['user_Id'];
				$_SESSION['login_time'] = $login_time;
				header("Location: ../Admin/dashboard.php");
				exit();
			// } else {
				// $_SESSION['login_attempts'] = 0;
	    		// $_SESSION['last_login_attempt'] = time();
				// $_SESSION['user_Id'] = $row['user_Id'];
				// $_SESSION['login_time'] = $login_time;
				// header("Location: ../User/profile.php");
				// exit();
			// }
		} else {
		    $check2 = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email' AND password='$password'");
			if(mysqli_num_rows($check2)===1) {
				$row = mysqli_fetch_array($check2);
				$_SESSION['Id'] = $row['Id'];
				header("Location: ../User/index.php");
				exit();
			} else {
			    $_SESSION['login_attempts']++;
			    $_SESSION['last_login_attempt'] = time();
				displayErrorMessage("Incorrect password.", "../login.php");
			}
		}
	}





	// REGISTER USER - REGISTER.PHP 
	if (isset($_POST['create_user'])) {
		saveUser($conn, "register.php");
	}




	// REGISTER CLIENT - REGISTER.PHP
	if (isset($_POST['register_client'])) {
		saveClient($conn, "../register.php");
	}

	



	// SEARCH EMAIL - FORGOT-PASSWORD.PHP
	if(isset($_POST['search'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($fetch) > 0) {
      	$row = mysqli_fetch_array($fetch);
      	$user_Id = $row['user_Id'];
      	header("Location: sendcode.php?user_Id=".$user_Id);
      	exit();
      } else {
		displayErrorMessage("Email not found.", "forgot-password.php");
      }
	}





	// SEND CODE - SENDCODE.PHP
	if(isset($_POST['sendcode'])) {

	    $recipientEmail = $_POST['email'];
	    $user_Id        = $_POST['user_Id'];
	    $key            = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

	    $insert_code = mysqli_query($conn, "UPDATE users SET verification_code='$key' WHERE email='$email' AND user_Id='$user_Id'");
	    if($insert_code) {

	      $subject = 'Verification code';
	      $message = '<p>Good day sir/maam '.$email.', your verification code is <b>'.$key.'</b>. Please do not share this code to other people. Thank you!</p>
	      <p>You can change your password by just clicking it <a href="http://localhost/PROJECT%200.%20My%20NEW%20Template%20System/changepassword.php?user_Id='.$user_Id.'">here!</a></p> 
	      <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

    	  sendEmail($subject, $message, $recipientEmail, "verifycode.php?user_Id=".$user_Id."&&email=".$recipientEmail);    
		} else {
			displayErrorMessage("Something went wrong while generating verification code through email.", "sendcode.php?user_Id=".$user_Id);
		} 
	}





	// VERIFY CODE - VERIFYCODE.PHP
	if(isset($_POST['verify_code'])) {
	    $user_Id = $_POST['user_Id'];
	    $email   = $_POST['email'];
	    $code    = mysqli_real_escape_string($conn, $_POST['code']);
	    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND verification_code='$code' AND user_Id='$user_Id'");
	    if(mysqli_num_rows($fetch) > 0) {
			header("Location: changepassword.php?user_Id=".$user_Id);
			exit();
		} else {
			displayErrorMessage("Verification code is incorrect.", "verifycode.php?user_Id=".$user_Id."&&email=".$email);
		}
	}





	// CHANGE PASSWORD - CHANGEPASSWORD.PHP
	if(isset($_POST['changepassword'])) {
		$user_Id   = $_POST['user_Id'];
		$cpassword = md5($_POST['cpassword']);

		$update = mysqli_query($conn, "UPDATE users SET password='$cpassword' WHERE user_Id='$user_Id' ");
		displayUpdateMessage($update, "Password has been changed.", "login.php", "changepassword.php?user_Id=".$user_Id);
	}




// ************************************* PROCESS ADMIN ************************************* \\
	
	// SAVE ADMIN - ADMIN_MGMT.PHP
	if (isset($_POST['create_admin'])) {
	    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
	    $path = "../images-users/";
	    saveUser($conn, "../Admin/admin_mgmt.php?page=create", $user_type, $path);
	}


	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = mysqli_real_escape_string($conn, $_POST['user_type']);
		updateSystemUser($conn, $user_Id, $user_type, "../Admin/admin_mgmt.php?page=".$user_Id);
	}


	// CHANGE ADMIN PASSWORD - ADMIN_DELETE.PHP
	if (isset($_POST['admin_password'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);
	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "../Admin/admin.php");
	}


	// DELETE ADMIN - ADMIN_DELETE.PHP
	if (isset($_POST['delete_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "../Admin/admin.php");
	}

// ************************************* END PROCESS ADMIN ************************************* \\



// ************************************* PROCESS USERS ************************************* \\

	// SAVE USERS - USERS_MGMT.PHP
	if (isset($_POST['create_user'])) {
		$user_type = "User";
		$path = "../images-users/";
	    saveUser($conn, "../Admin/users_mgmt.php?page=create", $user_type, $path);
	}


	// UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_user'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = "User";
		updateSystemUser($conn, $user_Id, $user_type, "../Admin/users_mgmt.php?page=".$user_Id);
	}
    

	// CHANGE USER PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['user_password'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);
	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "../Admin/users.php");
	}


	// DELETE USER - USERS_DELETE.PHP
	if (isset($_POST['delete_user'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "../Admin/users.php");
	}

// ************************************* END PROCESS USERS ************************************* \\


	

// ************************************* PROCESS PRODUCT  ************************************* \\

	// SAVE PRODUCT - PRODUCT_MGMT.PHP 
	if (isset($_POST['create_product'])) {
		saveProduct($conn, "../Admin/product.php", "../images-QR Code/");
	}


	// UPDATE PRODUCT - PRODUCT_MGMT.PHP
	if(isset($_POST['update_product'])) {
		$p_Id		  = mysqli_real_escape_string($conn, $_POST['p_Id']);
		updateProduct($conn, $p_Id, "../Admin/product_mgmt.php?page=".$p_Id);
	}


	// DELETE PRODUCT - PRODUCT_DELETE.PHP
	if (isset($_POST['delete_product'])) {
	    $p_Id = $_POST['p_Id'];
	    deleteRecord($conn, "product", "p_Id", $p_Id, "../Admin/product.php");
	}
	
// ************************************* END PROCESS PRODUCT  ************************************* \\





// ************************************* PROCESS CLIENT  ************************************* \\

	// REGISTER CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['save_client'])) {
		saveClient($conn, "../Admin/client_mgmt.php?page=create");
	}


	// UPDATE CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['update_client'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateClient($conn, $Id, "../Admin/client_mgmt.php?page=".$Id);
	}


	// DELETE CLIENT - CLIENT_DELETE.PHP
	if (isset($_POST['delete_client'])) {
	    $Id = $_POST['Id'];
	    deleteRecord($conn, "clients", "Id", $Id, "../Admin/client.php");
	}
	
// ************************************* END PROCESS CLIENT  ************************************* \\




// ************************************* PROCESS MECHANIC  ************************************* \\

	// REGISTER MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	if (isset($_POST['save_mechanic'])) {
		saveMechanic($conn, "../Admin/mechanic_mgmt.php?page=create");
	}


	// UPDATE MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	if (isset($_POST['update_mechanic'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateMechanic($conn, $Id, "../Admin/mechanic_mgmt.php?page=".$Id);
	}


	// DELETE PRODUCT - MECHANIC_DELETE.PHP
	if (isset($_POST['delete_mechanic'])) {
	    $Id = $_POST['Id'];
	    deleteRecord($conn, "mechanic", "Id", $Id, "../Admin/mechanic.php");
	}
	
// ************************************* END PROCESS MECHANIC  ************************************* \\





// ************************************* PROCESS SCHEDULES  ************************************* \\

	// SAVE SCHEDULE - USER/SCHEDULE_MGMT.PHP
	if (isset($_POST['save_Schedule'])) {
	    saveSchedule($conn, "../User/schedule_mgmt.php?page=create");
	}


	// DELETE SCHEDULE - SCHEDULE_DELETE.PHP
	if (isset($_POST['delete_schedule'])) {
	    $sched_Id = $_POST['sched_Id'];
	    deleteRecord($conn, "schedule", "sched_Id", $sched_Id, "../Admin/schedule.php");
	}



	// DELETE SCHEDULE - USER/SCHEDULE_VIEW_DELETE.PHP
	if (isset($_POST['delete_schedule_byBorrower'])) {
	    $sched_Id = $_POST['sched_Id'];
	    deleteRecord($conn, "schedule", "sched_Id", $sched_Id, "../User/schedule.php");
	}



	// UPDATE SCHEDULE STATUS - SCHEDULE_DELETE.PHP
	if (isset($_POST['update_schedule_Status'])) {
	    $sched_Id = mysqli_real_escape_string($conn, $_POST['sched_Id']);
	    $status   = mysqli_real_escape_string($conn, $_POST['status']);
		updateScheduleStatus($conn, $sched_Id, $status, "../Admin/schedule.php");
	}



	// UPDATE SCHEDULE - SCHEDULE_DELETE.PHP
	if (isset($_POST['update_Schedule'])) {
	    $sched_Id = mysqli_real_escape_string($conn, $_POST['sched_Id']);
		updateSchedule($conn, $sched_Id, "../User/schedule_mgmt.php?page=".$sched_Id);
	}


	



	
// ************************************* END PROCESS SCHEDULES  ************************************* \\





// ************************************* LOGGED IN ADMIN PROCESSES ************************************* \\

	// UPDATE ADMIN INFO - PROFILE.PHP
	if (isset($_POST['update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "../Admin/profile.php");
	}


	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "../Admin/profile.php");
	}


	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);
	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "../Admin/profile.php");
	}

// ************************************* END LOGGED IN ADMIN PROCESSES ************************************* \\



// ************************************* LOGGED IN USER PROCESSES ************************************* \\

	// UPDATE USER INFO - PROFILE.PHP
	if (isset($_POST['user_update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "../User/profile.php");
	}


	// UPDATE USER PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_user'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "../User/profile.php");
	}


	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_user'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);
	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "../User/profile.php");
	}


	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if (isset($_POST['sendEmail'])) {
	    $name = mysqli_real_escape_string($conn, $_POST['name']);
	    $email = mysqli_real_escape_string($conn, $_POST['email']);
	    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
	    $msg = mysqli_real_escape_string($conn, $_POST['message']);

	    $message = '<h3>' . $subject . '</h3>
	        <p>
	            Good day!<br>
	            ' . $msg . '
	        </p>
	        <p>
	            Name of Sender: ' . $name . '<br>
	            Email: ' . $email . '
	        </p>
	        <p><b>Note:</b> This is a system generated email please do not reply.</p>';

	    sendEmail($subject, $message, $recipientEmail="sonerwin12@gmail.com", "../User/contact-us.php");

	}


// ************************************* END LOGGED IN USER PROCESSES ************************************* \\




// ************************************* CATEGORY PROCESSES ************************************* \\	

	// SAVE CATEGORY - CATEGORY.PHP
	if(isset($_POST['create_category'])) {
		$cat_name        = $_POST['cat_name'];
		$cat_description = $_POST['cat_description'];
		saveCategory($conn, $cat_name, $cat_description, "../Admin/category.php");
	}


	// UPDATE CATEGORY - CATEGORY_UPDATE_DELETE.PHP
	if(isset($_POST['update_category'])) {
		$cat_Id        = $_POST['cat_Id'];
		$cat_name        = $_POST['cat_name'];
		$cat_description = $_POST['cat_description'];
		updateCategory($conn, $cat_Id, $cat_name, $cat_description, "../Admin/category.php");
	}


	// DELETE CATEGORY - CATEGORY_UPDATE_DELETE.PHP
	if (isset($_POST['delete_category'])) {
	    $cat_Id = $_POST['cat_Id'];
	    deleteRecord($conn, "category", "cat_Id", $cat_Id, "../Admin/category.php");
	}
	

// ************************************* CATEGORY PROCESSES ************************************* \\
?>
