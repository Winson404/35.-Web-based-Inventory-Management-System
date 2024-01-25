<?php 
	include '../config.php';
	include('../phpqrcode/qrlib.php');
	include("XLSXLibrary.php");
	include('../dompdf/autoload.inc.php');
	use Dompdf\Dompdf;
	include 'functions.php';

	// $assigned_branch = $_SESSION['assigned_branch'];
	// $logged_in_user = $_SESSION['logged_in_user'];
	// Check if the session variables are set before using them
    $assigned_branch = isset($_SESSION['assigned_branch']) ? $_SESSION['assigned_branch'] : null;
    $logged_in_user = isset($_SESSION['logged_in_user']) ? $_SESSION['logged_in_user'] : null;

	// use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require 'vendor/PHPMailer/src/Exception.php';
    // require 'vendor/PHPMailer/src/PHPMailer.php';
    // require 'vendor/PHPMailer/src/SMTP.php';

	// USERS LOGIN - LOGIN.PHP
	if(isset($_POST['login'])) {
		$branch_type = $_POST['branch_type'];
		$email       = $_POST['email'];
		$password    = md5($_POST['password']);

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

		if($branch_type == 'branch-1') {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
			if(mysqli_num_rows($check)===1) {
				$row = mysqli_fetch_array($check);
				$assigned_branch = $row['assigned_branch'];
				if($assigned_branch == 0 || $assigned_branch == 1) {
					$log_ID = $row['user_Id'];
					$login_time = date("Y-m-d h:i A");
					$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_time) VALUES ('$log_ID', '$login_time')");
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['admin_Id'] = $row['user_Id'];
					$_SESSION['login_time'] = $login_time;
					header("Location: ../Admin/dashboard.php");
					exit();
				} else {
					$_SESSION['login_attempts']++;
				    $_SESSION['last_login_attempt'] = time();
					displayErrorMessage("You cannot login in this branch.", "../login.php?page=branch-1");
				}
				
			} else {
				$_SESSION['login_attempts']++;
			    $_SESSION['last_login_attempt'] = time();
				displayErrorMessage("Incorrect password.", "../login.php?page=branch-1");
			}
		} if($branch_type == 'branch-2') {
			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
			if(mysqli_num_rows($check)===1) {
				$row = mysqli_fetch_array($check);
				$assigned_branch = $row['assigned_branch'];
				if($assigned_branch == 0 || $assigned_branch == 2) {
					$log_ID = $row['user_Id'];
					$login_time = date("Y-m-d h:i A");
					$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_time) VALUES ('$log_ID', '$login_time')");
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['admin_Id'] = $row['user_Id'];
					$_SESSION['login_time'] = $login_time;
					header("Location: ../Admin/dashboard.php");
					exit();
				} else {
					$_SESSION['login_attempts']++;
				    $_SESSION['last_login_attempt'] = time();
					displayErrorMessage("You cannot login in this branch.", "../login.php?page=branch-2");
				}
				
			} else {
				$_SESSION['login_attempts']++;
			    $_SESSION['last_login_attempt'] = time();
				displayErrorMessage("Incorrect password.", "../login.php?page=branch-2");
			}
			
		} else {
			$check2 = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email' AND password='$password'");
			if(mysqli_num_rows($check2)===1) {
				$row = mysqli_fetch_array($check2);
				if($row['is_verified'] == 0) {
					$_SESSION['login_attempts']++;
				    $_SESSION['last_login_attempt'] = time();
					displayErrorMessage("Account is not verified.", "../login.php");
				} else {
					$_SESSION['type'] = 'Client';
					$_SESSION['Id'] = $row['Id'];
					header("Location: ../User/index.php");
					exit();
				}
			} else {
			    $check3 = mysqli_query($conn, "SELECT * FROM mechanic WHERE email='$email' AND password='$password'");
				if(mysqli_num_rows($check3)===1) {
					$row = mysqli_fetch_array($check3);
					$_SESSION['type'] = 'Mechanic';
					$_SESSION['Id'] = $row['Id'];
					header("Location: ../User/index.php");
					exit();
				} else {
				    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
					if(mysqli_num_rows($check)===1) {
						$row = mysqli_fetch_array($check);
						$assigned_branch = $row['assigned_branch'];
						if($assigned_branch == 0) {
							$log_ID = $row['user_Id'];
							$login_time = date("Y-m-d h:i A");
							$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_time) VALUES ('$log_ID', '$login_time')");
							$_SESSION['login_attempts'] = 0;
				    		$_SESSION['last_login_attempt'] = time();
							$_SESSION['admin_Id'] = $row['user_Id'];
							$_SESSION['login_time'] = $login_time;
							header("Location: ../Admin/dashboard.php");
							exit();
						} else {
							$_SESSION['login_attempts']++;
						    $_SESSION['last_login_attempt'] = time();
							displayErrorMessage("Only clients can login here.", "../login.php");
						}
					} else {
						$_SESSION['login_attempts']++;
					    $_SESSION['last_login_attempt'] = time();
						displayErrorMessage("Incorrect password.", "../login.php");
					}
				}
			}
		}
	}





	// REGISTER USER - REGISTER.PHP 
	// if (isset($_POST['create_user'])) {
	// 	saveUser($conn, "register.php");
	// }




	// REGISTER CLIENT - REGISTER.PHP
	if (isset($_POST['register_client'])) {
		registerClient($conn);
	}



	// VERIFY CLIENT ACCOUNT REGISRATION - REGISTER_VERIFICATION.PHP
	if (isset($_POST['verify_account'])) {
		$Id = mysqli_real_escape_string($conn, $_POST['Id']);
		registerClientVerification($conn, "../login.php");
	}
	



	// SEARCH EMAIL - FORGOT-PASSWORD.PHP
	if(isset($_POST['search'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($fetch) > 0) {
      	$row = mysqli_fetch_array($fetch);
      	$user_Id = $row['user_Id'];
      	header("Location: ../sendcode.php?user_Id=" . urlencode($user_Id) . "&type=Admin");
      	exit();
      } else {
		  $fetch2 = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
	      if(mysqli_num_rows($fetch2) > 0) {
	      	$row = mysqli_fetch_array($fetch2);
	      	$user_Id = $row['Id'];
	      	header("Location: ../sendcode.php?user_Id=" . urlencode($user_Id) . "&type=Client");
	      	exit();
	      } else {
			  $fetch3 = mysqli_query($conn, "SELECT * FROM mechanic WHERE email='$email'");
		      if(mysqli_num_rows($fetch3) > 0) {
		      	$row = mysqli_fetch_array($fetch3);
		      	$user_Id = $row['Id'];
		      	header("Location: ../sendcode.php?user_Id=" . urlencode($user_Id) . "&type=Mechanic");
		      	exit();
		      } else {
				displayErrorMessage("Email not found.", "../forgot_password.php");
		      }
	      }
      }
	}





	// SEND CODE - SENDCODE.PHP
	if(isset($_POST['sendcode'])) {
		$type           = $_POST['type'];
	    $recipientEmail = $_POST['email'];
	    $user_Id        = $_POST['user_Id'];
	    $key            = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

	      $insert_code = '';
	      if($type == 'Client') {
	        $insert_code = mysqli_query($conn, "UPDATE clients SET verification_code='$key' WHERE email='$recipientEmail' AND Id='$user_Id'");
	      } elseif($type == 'Admin') { 
	        $insert_code = mysqli_query($conn, "UPDATE users SET verification_code='$key' WHERE email='$recipientEmail' AND user_Id='$user_Id'");
	      } else {
	        $insert_code = mysqli_query($conn, "UPDATE mechanic SET verification_code='$key' WHERE email='$recipientEmail' AND Id='$user_Id'");
	      }

	    
	    if($insert_code) {

	      $subject = 'Verification code';
	      $message = '<p>Good day sir/maam '.$recipientEmail.', your verification code is <b>'.$key.'</b>. Please do not share this code to other people. Thank you!</p>
	      <p>You can change your password by just clicking it <a href="http://localhost/PROJECT%200.%20My%20NEW%20Template%20System/changepassword.php?user_Id='.$user_Id.'">here!</a></p> 
	      <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

    	  sendEmail($subject, $message, $recipientEmail, "../verifycode.php?user_Id=".$user_Id."&&email=".$recipientEmail."&&type=".$type); 
    	  $_SESSION['message'] = "Email has been sent";
		  $_SESSION['text'] = "Saved successfully!";
		  $_SESSION['status'] = "success";
		  header("Location: ../verifycode.php?user_Id=".$user_Id."&&email=".$recipientEmail."&&type=".$type);
		  exit(); 
	} else {
		  displayErrorMessage("Something went wrong while generating verification code through email.", "../sendcode.php?user_Id=".$user_Id."&&type=".$type);
		} 
	}





	// VERIFY CODE - VERIFYCODE.PHP
	if(isset($_POST['verify_code'])) {
	    $user_Id = $_POST['user_Id'];
	    $email   = $_POST['email'];
	    $type           = $_POST['type'];
	    $code    = mysqli_real_escape_string($conn, $_POST['code']);

	      $insert_code = '';
	      if($type == 'Client') {
	        $fetch = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email' AND verification_code='$code' AND Id='$user_Id'");
	      } elseif($type == 'Admin') { 
	        $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND verification_code='$code' AND user_Id='$user_Id'");
	      } else {
	        $fetch = mysqli_query($conn, "SELECT * FROM mechanic WHERE email='$email' AND verification_code='$code' AND Id='$user_Id'");
	      }
	    
	    if(mysqli_num_rows($fetch) > 0) {
			header("Location: ../changepassword.php?user_Id=".$user_Id."&&type=".$type);
			exit();
		} else {
			displayErrorMessage("Verification code is incorrect.", "../verifycode.php?user_Id=".$user_Id."&&email=".$email."&&type=".$type);
		}
	}





	// CHANGE PASSWORD - CHANGEPASSWORD.PHP
	if(isset($_POST['changepassword'])) {
		$user_Id   = $_POST['user_Id'];
		$type      = $_POST['type'];
		$cpassword = md5($_POST['cpassword']);
		$insert_code = '';
	      if($type == 'Client') {
	        $update = mysqli_query($conn, "UPDATE clients SET password='$cpassword', verification_code=0 WHERE Id='$user_Id' ");
	      } elseif($type == 'Admin') { 
	        $update = mysqli_query($conn, "UPDATE users SET password='$cpassword', verification_code=0 WHERE user_Id='$user_Id' ");
	      } else {
	        $update = mysqli_query($conn, "UPDATE mechanic SET password='$cpassword', verification_code=0 WHERE Id='$user_Id' ");
	      }
		
		displayUpdateMessage($update, "Password has been changed.", "../login.php");
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


	// ARCHIVE PRODUCT - PRODUCT_DELETE.PHP
	if (isset($_POST['archive_product'])) {
	    $p_Id = $_POST['p_Id'];
	    archiveProduct($conn, $p_Id, "../Admin/product.php");
	}


	// UNARCHIVE PRODUCT - PRODUCT_DELETE.PHP
	if (isset($_POST['unarchive_product'])) {
	    $p_Id = $_POST['p_Id'];
	    unarchiveProduct($conn, $p_Id, "../Admin/product_archived.php");
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
		saveClient($conn, "../Admin/client.php");
	}


	// UPDATE CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['update_client'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateClient($conn, $Id, "../Admin/client.php");
	}


	// DELETE CLIENT - CLIENT_DELETE.PHP
	if (isset($_POST['delete_client'])) {
	    $Id = $_POST['Id'];
	    deleteRecord($conn, "clients", "Id", $Id, "../Admin/client.php");
	}


	// UPDATE CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['update_client_profile'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateClient($conn, $Id, "../User/profile.php");
	}


	// CHANGE PASSWORD CLIENT - USER/REQUESTCHANGEPASS.PHP
	if(isset($_GET['Id'])) {
		$Id = $_GET['Id'];
		requestChangePass($conn, $Id, "../User/requestChangePass.php");
	}


	// UPDATE CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['update_client_password'])) {
		$Id = mysqli_real_escape_string($conn, $_POST['Id']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		update_client_password($conn, $Id, $password, "../User/profile.php");
	}



// ************************************* END PROCESS CLIENT  ************************************* \\




// ************************************* PROCESS MECHANIC  ************************************* \\

	// REGISTER MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	if (isset($_POST['save_mechanic'])) {
		saveMechanic($conn, "../Admin/mechanic.php");
	}


	// UPDATE MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	if (isset($_POST['update_mechanic'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateMechanic($conn, $Id, "../Admin/mechanic.php");
	}


	// UPDATE MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	if (isset($_POST['update_mechanic_profile'])) {
		$Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateMechanic($conn, $Id, "../User/profile.php");
	}


	// DELETE MECHANIC - MECHANIC_DELETE.PHP
	if (isset($_POST['delete_mechanic'])) {
	    $Id = $_POST['Id'];
	    deleteRecord($conn, "mechanic", "Id", $Id, "../Admin/mechanic.php");
	}


	// UPDATE STATUS MECHANIC - MECHANIC_DELETE.PHP
	if (isset($_POST['status_mechanic'])) {
	    $Id		  = mysqli_real_escape_string($conn, $_POST['Id']);
		updateMechanicStatus($conn, $Id, "../Admin/mechanic.php");
	}


	// CHANGE PASSWORD MECHANIC - USER/REQUESTCHANGEPASS.PHP
	if(isset($_GET['mechanic_Id'])) {
		$Id = $_GET['mechanic_Id'];
		requestMechanicChangePass($conn, $Id, "../User/requestChangePass.php");
	}


	// UPDATE CLIENT - ADMIN/CLIENT_MGMT.PHP
	if (isset($_POST['update_mechanic_password'])) {
		$Id = mysqli_real_escape_string($conn, $_POST['Id']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		update_mechanic_password($conn, $Id, $password, "../User/profile.php");
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



	// UPDATE SCHEDULE STATUS - SCHEDULE_UPDATE_DELETE.PHP
	if (isset($_POST['update_schedule_Status'])) {
	    $sched_Id = mysqli_real_escape_string($conn, $_POST['sched_Id']);
	    $status   = $_POST['status'];
	    $reason   = $_POST['reason'];
		updateScheduleStatus($conn, $sched_Id, $status, $reason, "../Admin/schedule.php");
	}



	// UPDATE SCHEDULE - SCHEDULE_DELETE.PHP
	if (isset($_POST['update_Schedule'])) {
	    $sched_Id = mysqli_real_escape_string($conn, $_POST['sched_Id']);
		updateSchedule($conn, $sched_Id, "../User/schedule_mgmt.php?page=".$sched_Id);
	}


	
	// ASSIGN MECHANIC TO SCHEDULE - SCHEDULE_UPDATE_DELETE.PHP
	if (isset($_POST['assign_mechanic'])) {
	    $sched_Id = mysqli_real_escape_string($conn, $_POST['sched_Id']);
		assignMechanic($conn, $sched_Id, "../Admin/schedule.php");
	}


	// UPDATE PRODUCT USED IN SCHEDULES BY MECHANIC - SCHEDULE_VIEW.PHP
	if(isset($_POST['EditStockUsed'])) {
		$sched_Id    = mysqli_real_escape_string($conn, $_POST['sched_Id']);
		
		


		EditStockUsed($conn, $sched_Id, "../User/schedule_view.php?sched_Id=".$sched_Id);
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

	    sendEmail($subject, $message, $recipientEmail="rbfmotorshop@gmail.com", "../User/contact.php");

	}


	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if (isset($_POST['sendEmailHome'])) {
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

	    sendEmail($subject, $message, $recipientEmail="rbfmotorshop@gmail.com", "../contact.php");

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
	

// ************************************* END CATEGORY PROCESSES ************************************* \\


// ************************************* EXPORT TO PDF PROCESSES ************************************* \\

	// EXPORT CLIENT RECORDS TO PDF
	if(isset($_GET['pdfExport']) && isset($_GET['assigned_branch'])) {
		$pdfExport       = $_GET['pdfExport'];
		$assigned_branch = $_GET['assigned_branch'];
		$branch_name = '';
		$export_contact = '';
		if($assigned_branch == 0) {
          $branch_name = 'All records in 2 Branches';
          $export_contact = 'Contact: +63 992 268 7202';
        } elseif($assigned_branch == 1) {
          $branch_name = 'M.H.del Pilar St, Calamba, Laguna';
          $export_contact = 'Contact: +63 992 268 7202 | Email: rbfmotorshop@gmail.com;';
        } else {
          $branch_name = 'Mabuhay City Road Cabuyao, Laguna';
          $export_contact = 'Contact: +63 992 268 7202 | Email: rbfmotorshop2@gmail.com;';
        }

		// CLIENT PDF EXPORT
		if($pdfExport == 'Client') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM clients WHERE is_verified=1 ORDER BY firstname");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM clients WHERE is_verified=1 AND client_branch=$assigned_branch ORDER BY firstname");
	        }
			
			if(mysqli_num_rows($sql) > 0) {
			
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>

		        ';

				$html .= '
					<h2 style="text-align: center; margin-bottom: 20px;">Client Records</h2>
					<hr style="border-color: #ddd; margin: 10px 0;">
		            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
			            <thead style="background-color: #f2f2f2;">
			                <tr>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Name</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Email</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Vehicle type</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Year Model</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Registered</th>
			                </tr>
			            </thead>
			            <tbody id="users_data">	
				';
			
				$i = 1;
				foreach($sql as $row) {
					$name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
					$html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($name) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['email']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['vehicleType']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['yearModel'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_registered'])) . '</td>
						</tr>
					';
				}
			
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("A4", "portrait");
				$dompdf->render();
				$dompdf->stream("Client records.pdf");
			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/client.php");
			}
		}

		// SUPPLIER PDF EXPORT
		elseif($pdfExport == 'Supplier') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' ORDER BY firstname");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND assigned_branch=$assigned_branch ORDER BY firstname ");
	        }
			
			if(mysqli_num_rows($sql) > 0) {
			
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>

		        ';

				$html .= '
					<h2 style="text-align: center; margin-bottom: 20px;">Supplier Records</h2>
					<hr style="border-color: #ddd; margin: 10px 0;">
		            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
			            <thead style="background-color: #f2f2f2;">
			                <tr>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Name</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">DOB</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Age</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Birthplace</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Gender</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Civil Status</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Occupation</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Religion</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Email/Contact</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Address</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Registered</th>
			                </tr>
			            </thead>
			            <tbody id="users_data">	
				';
				foreach($sql as $row) {
					$name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
					$address = $row['house_no'].' '.$row['street_name'].' '.$row['purok'].' '.$row['zone'].' '.$row['barangay'].' '.$row['municipality'].' '.$row['province'].' '.$row['region'];
					$html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($name) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['dob'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['age'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['birthplace']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['gender']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['civilstatus']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['occupation']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['religion']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['email']) . '<br> +63 ' . $row['contact'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($address) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_registered'])) . '</td>
						</tr>
					';
				}
			
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("Letter", "landscape");
				$dompdf->render();
				$dompdf->stream("Supplier records.pdf");
			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/users.php");
			}
		}

		// SCHEDULE PDF EXPORT
		elseif($pdfExport == 'Schedule') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() ORDER BY selectedDate");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch ORDER BY selectedDate");
	        }
			
			if(mysqli_num_rows($sql) > 0) {
			
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>

		        ';

				$html .= '
					<h2 style="text-align: center; margin-bottom: 20px;">Schedule Records</h2>
					<hr style="border-color: #ddd; margin: 10px 0;">
		            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
			            <thead style="background-color: #f2f2f2;">
			                <tr>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Client Name</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Services</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Scheduled Date-Time</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Mechanic name</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Status</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Approved</th>
			                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
			                </tr>
			            </thead>
			            <tbody id="users_data">	
				';
				foreach($sql as $row) {
				  $mech_Id = $row['mechanic_Id'];
                  $mech_name = '';
                  $mech_email = '';
                  $mech_address = '';

                  $get_mech = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$mech_Id'");
                  if(mysqli_num_rows($get_mech) > 0){
                    $row2 = mysqli_fetch_array($get_mech);
                    $mech_name = ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']);
                    $mech_email = $row2['email'];
                    $mech_address = $row2['address'];
                  } else {
                    $mech_name = 'No Mechanic Available';
                  }

					$name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
					$services = '';
					if($row['services'] == 'Others') {
						$services = $row['otherServices'];
					} else {
						$services = $row['services'];
					}

					$status = ''; 
					if($row['status'] == 0) {
						$status = 'Pending';
					} elseif($row['status'] == 1) {
						$status = 'Approved';
					} else {
						$status = 'Denied';
					}
					$html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($name) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($services) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($mech_name) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $status . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ($row['date_approved'] != '' ? date("F d, Y", strtotime($row['date_approved'])) : 'N/A') . '</td>

	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
						</tr>
					';
				}
			
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("Letter", "landscape");
				$dompdf->render();
				$dompdf->stream("Schedule records.pdf");
			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/schedule.php");
			}
		}

		// PRODUCT RECORDS PDF EXPORT
		elseif($pdfExport == 'Product') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 ORDER BY product.prod_Id");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.branch=$assigned_branch ORDER BY product.prod_Id");
	        }
			
			if(mysqli_num_rows($sql) > 0) {

			
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>

		        ';

				$html .= '
				    <h2 style="text-align: center; margin-bottom: 20px;">Product Records</h2>
				    <hr style="border-color: #ddd; margin: 10px 0;">
				    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
				        <thead style="background-color: #f2f2f2;">
				            <tr>
				                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Product ID</th>
				                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Category</th>
				                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Name</th>
				                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Stock</th>';
								if ($assigned_branch == 0) {
								    $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Branch</th>';
								}
					  $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
				            </tr>
				        </thead>
				        <tbody id="users_data">    
				    ';

				foreach($sql as $row) {
					$branch = '';
					if ($row['branch'] == 1) {
                      $branch = 'M.H.del Pilar St, Calamba, Laguna';
                    } elseif ($row['branch'] == 2) {
                      $branch = 'Mabuhay City Road Cabuyao, Laguna';
                    } else {
                      $branch = 'Admin by Superadmin';
                    }

					$html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_Id'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['cat_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['prod_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_stock'] . '</td>';
	                        if ($assigned_branch == 0) {
	                        	$html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $branch . '</td>';
	                        }
                  $html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
						</tr>
					';
				}
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
					      
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("Letter", "portrait");
				$dompdf->render();
				$dompdf->stream("Product records.pdf");

			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product.php");
			}
		}

		// ARCHIVED PRODUCT RECORDS PDF EXPORT
		elseif($pdfExport == 'Archived') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1 ORDER BY product.prod_Id");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1 AND product.branch=$assigned_branch ORDER BY product.prod_Id");
	        }
			
			if(mysqli_num_rows($sql) > 0) {
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>
		        ';



				$html .= '
				<h2 style="text-align: center; margin-bottom: 20px;">Archived Product Records</h2>
				<hr style="border-color: #ddd; margin: 10px 0;">
	            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
		            <thead style="background-color: #f2f2f2;">
		                <tr>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Product ID</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Category</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Name</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Stock</th>';
							if ($assigned_branch == 0) {
							    $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Branch</th>';
							}
				  $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
			            </tr>
		            </thead>
		            <tbody id="users_data">	
			    ';
				foreach($sql as $row) {
					$branch = '';
					if ($row['branch'] == 1) {
                      $branch = 'M.H.del Pilar St, Calamba, Laguna';
                    } elseif ($row['branch'] == 2) {
                      $branch = 'Mabuhay City Road Cabuyao, Laguna';
                    } else {
                      $branch = 'Admin by Superadmin';
                    }

                    $html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_Id'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['cat_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['prod_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_stock'] . '</td>';
	                        if ($assigned_branch == 0) {
	                        	$html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $branch . '</td>';
	                        }
                  	$html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
						</tr>
					';

				}
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("Letter", "portrait");
				$dompdf->render();
				$dompdf->stream("Archived Product records.pdf");
			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product_archived.php");
			}
		}

		// LOW STOCK PRODUCT RECORDS PDF EXPORT
		elseif($pdfExport == 'ProductLowStack') {
			$sql = '';
			if($assigned_branch == 0) {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 ORDER BY product.prod_Id");
	        } else {
	          $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch ORDER BY product.prod_Id");
	        }
			
			if(mysqli_num_rows($sql) > 0) {
				$html = '';
				// Header with Logo, Business Name, Address, and Contact
		        $html .= '
		            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
					    <h2 style="margin: 0px;">Inventory Management System</h2>
					    <p style="margin: 0px;">'.$branch_name.'</p>
					    <p style="margin: 0px;">'.$export_contact.'</p>
					</div>
		        ';

				$html .= '
				<h2 style="text-align: center; margin-bottom: 20px;">Low Stock Product Records</h2>
				<hr style="border-color: #ddd; margin: 10px 0;">
	            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
		            <thead style="background-color: #f2f2f2;">
		                <tr>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Product ID</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Category</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Name</th>
			                <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Stock</th>';
							if ($assigned_branch == 0) {
							    $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Branch</th>';
							}
				  $html .= '<th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
			            </tr>
		            </thead>
		            <tbody id="users_data">	
			    ';
				foreach($sql as $row) {
					$branch = '';
					if ($row['branch'] == 1) {
                      $branch = 'M.H.del Pilar St, Calamba, Laguna';
                    } elseif ($row['branch'] == 2) {
                      $branch = 'Mabuhay City Road Cabuyao, Laguna';
                    } else {
                      $branch = 'Admin by Superadmin';
                    }

                    $html .= '
						<tr>
							<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_Id'] . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['cat_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['prod_name']) . '</td>
	                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_stock'] . '</td>';
	                        if ($assigned_branch == 0) {
	                        	$html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $branch . '</td>';
	                        }
                  	$html .= '<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
						</tr>
					';
				}
				$html .= '</table>
						  <div class="col-md-12 d-flex mt-3" style="display: flex; position: relative">
					        <p class="text-sm ml-auto" style="position: absolute; right: 0;">Printed by: <br> <span class="text-muted">' . ucwords($logged_in_user) . '</span></p>
					        <p class="text-sm ml-auto" style="position: absolute; left: 0;">From branch: <br> <span class="text-muted">' . ucwords($branch_name) . '</span></p>
					      </div>';
				$dompdf = new DOMPDF();
				$dompdf->loadHtml($html);
				$dompdf->setPaper("Letter", "portrait");
				$dompdf->render();
				$dompdf->stream("Low Stock Product records.pdf");
			} else {
				$_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product_low_stock.php");
			}
		}

		else {
			$_SESSION['message'] = "404 : Page not found";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: ../Admin/dashboard.php");
			exit();
		}
	}

// ************************************* END EXPORT TO PDF PROCESSES ************************************* \\



// ************************************* EXPORT TO EXCEL PROCESSES ************************************* \\

	// EXPORT CLIENT RECORDS TO EXCEL
	if(isset($_GET['ExcelExport']) && isset($_GET['assigned_branch'])) {
		$ExcelExport = $_GET['ExcelExport'];
		$assigned_branch = $_GET['assigned_branch'];

		// CLIENT EXCEL EXPORT
		if($ExcelExport == 'Client') {
			
			$client = [
		        ['No.', 'Full name', 'Email', 'Address', 'Vehicle Type', 'Year Model', 'Date registered']
		      ];

		      $id = 0;
		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM clients WHERE is_verified=1 ORDER BY firstname";
	          } else {
	          	$sql = "SELECT * FROM clients WHERE is_verified=1 AND client_branch=$assigned_branch ORDER BY firstname";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
		          $name = $row['firstname']. ' ' .$row['middlename']. ' ' .$row['lastname']. ' ' .$row['suffix'];
		          // $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
		          $client = array_merge($client, array(array($id, ucwords($name), ucwords($row['email']), ucwords($row['address']), ucwords($row['vehicleType']), $row['yearModel'], date("F d, Y", strtotime($row['date_registered'])))));
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/client.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($client);
		      $xlsx->downloadAs('Client records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($client);

		      header('Location: ../Admin/client.php');

		}

		// SUPPLIER EXCEL EXPORT
		elseif($ExcelExport == 'Supplier') {
			
			$users = [
		        ['No.', 'Full name', 'DOB', 'Age', 'Birthplace', 'Gender', 'Civil Status', 'Occupation', 'Religion', 'Email', 'Contact', 'Address', 'Date registered']
		      ];

		      $id = 0;
		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM users WHERE user_type = 'User' ORDER BY firstname";
	          } else {
	          	$sql = "SELECT * FROM users WHERE user_type = 'User' AND assigned_branch='$assigned_branch' ORDER BY firstname";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
		          $name = $row['firstname']. ' ' .$row['middlename']. ' ' .$row['lastname']. ' ' .$row['suffix'];
		          $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
		          $users = array_merge($users, array(array($id, ucwords($name), $row['dob'], $row['age'], ucwords($row['birthplace']), ucwords($row['gender']), ucwords($row['civilstatus']), ucwords($row['occupation']), ucwords($row['religion']),  ucwords($row['email']), '+63 '.$row['contact'], ucwords($address), date("F d, Y", strtotime($row['date_registered'])))));
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/users.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($users);
		      $xlsx->downloadAs('Supplier records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($users);

		      header('Location: ../Admin/users.php');

		}

		// SCHEDULE EXCEL EXPORT
		elseif($ExcelExport == 'Schedule') {
			$schedule = [
		        ['No.', 'Client Name', 'Services', 'Scheduled Date-Time', 'Mechanic name', 'Status', 'Date Approved', 'Date Added']
		      ];

		      $id = 0;
		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() ORDER BY selectedDate";
	          } else {
	          	$sql = "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.selectedDate >= CURDATE() AND clients.client_branch=$assigned_branch ORDER BY selectedDate";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;

		          $mech_Id = $row['mechanic_Id'];
                  $mech_name = '';
                  $mech_email = '';
                  $mech_address = '';

                  $get_mech = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$mech_Id'");
                  if(mysqli_num_rows($get_mech) > 0){
                    $row2 = mysqli_fetch_array($get_mech);
                    $mech_name = ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']);
                    $mech_email = $row2['email'];
                    $mech_address = $row2['address'];
                  } else {
                    $mech_name = 'No Mechanic Available';
                  }


		          $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];				
		          $services = '';
					if($row['services'] == 'Others') {
						$services = $row['otherServices'];
					} else {
						$services = $row['services'];
					}

					$status = ''; 
					if($row['status'] == 0) {
						$status = 'Pending';
					} elseif($row['status'] == 1) {
						$status = 'Approved';
					} else {
						$status = 'Denied';
					}

		          $schedule = array_merge($schedule, array(array($id, ucwords($name), ucwords($services),  date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])), ucwords($mech_name), $status, ($row['date_approved'] != '' ? date("F d, Y", strtotime($row['date_approved'])) : 'N/A'), date("F d, Y", strtotime($row['date_added'])) )));
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/schedule.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($schedule);
		      $xlsx->downloadAs('Schedule records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($schedule);

		      header('Location: ../Admin/schedule.php');
		}

		// PRODUCT RECORDS EXCEL EXPORT
		elseif($ExcelExport == 'Product') {
			if($assigned_branch == 0) {
				$product = [
			        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Branch', 'Date Added']
			      ];
			} else {
				$product = [
			        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Date Added']
			      ];
			}
			

		      $id = 0;

		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 ORDER BY product.prod_Id";
	          } else {
	          	$sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.branch=$assigned_branch ORDER BY product.prod_Id";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
	        	$branch = '';
				if ($row['branch'] == 1) {
                  $branch = 'M.H.del Pilar St, Calamba, Laguna';
                } elseif ($row['branch'] == 2) {
                  $branch = 'Mabuhay City Road Cabuyao, Laguna';
                } else {
                  $branch = 'Admin by Superadmin';
                }

	            $id++;
	            if($assigned_branch == 0) {
					$product = array_merge($product, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], $branch, date("F d, Y", strtotime($row['date_added'])) )));
				} else {
					$product = array_merge($product, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], date("F d, Y", strtotime($row['date_added'])) )));
				}
		          
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($product);
		      $xlsx->downloadAs('Product records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($product);

		      header('Location: ../Admin/product.php');
		}

		// ARCHIVED PRODUCT RECORDS EXCEL EXPORT
		elseif($ExcelExport == 'Archived') {
			
		    if($assigned_branch == 0) {
				$product_archived = [
			        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Branch', 'Status', 'Date Added']
			      ];
			} else {
				$product_archived = [
			        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Status', 'Date Added']
			      ];
			}

		      $id = 0;
		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1 ORDER BY product.prod_Id";
	          } else {
	          	$sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1 AND product.branch=$assigned_branch ORDER BY product.prod_Id";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		        	$branch = '';
					if ($row['branch'] == 1) {
	                  $branch = 'M.H.del Pilar St, Calamba, Laguna';
	                } elseif ($row['branch'] == 2) {
	                  $branch = 'Mabuhay City Road Cabuyao, Laguna';
	                } else {
	                  $branch = 'Admin by Superadmin';
	                }
		            $id++;
		            if($assigned_branch == 0) {
		            	$product_archived = array_merge($product_archived, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], $branch, 'Archived', date("F d, Y", strtotime($row['date_added'])) )));
					} else {
						$product_archived = array_merge($product_archived, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], 'Archived', date("F d, Y", strtotime($row['date_added'])) )));
					}
		          
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product_archived.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($product_archived);
		      $xlsx->downloadAs('Archived Product records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($product_archived);

		      header('Location: ../Admin/product_archived.php');
		}

		// LOW STOCK PRODUCT RECORDS EXCEL EXPORT
		elseif($ExcelExport == 'ProductLowStack') {
			
		        if($assigned_branch == 0) {
					$product_archived = [
				        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Branch', 'Status', 'Date Added']
				      ];
				} else {
					$product_archived = [
				        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Status', 'Date Added']
				      ];
				}

		      $id = 0;
		      $sql = '';
		      if($assigned_branch == 0) {
	            $sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 ORDER BY product.prod_Id";
	          } else {
	          	$sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0 AND product.prod_stock <= 15 AND product.branch=$assigned_branch ORDER BY product.prod_Id";
	          }
		      
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		        	$branch = '';
					if ($row['branch'] == 1) {
	                  $branch = 'M.H.del Pilar St, Calamba, Laguna';
	                } elseif ($row['branch'] == 2) {
	                  $branch = 'Mabuhay City Road Cabuyao, Laguna';
	                } else {
	                  $branch = 'Admin by Superadmin';
	                }
		          $id++;
		            if($assigned_branch == 0) {
		            	$product_archived = array_merge($product_archived, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], $branch, 'Archived', date("F d, Y", strtotime($row['date_added'])) )));
					} else {
						$product_archived = array_merge($product_archived, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], 'Archived', date("F d, Y", strtotime($row['date_added'])) )));
					}
		          
		        }
		      } else {
		        $_SESSION['message'] = "No record found in the database.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
		        header("Location: ../Admin/product_low_stock.php");
		      }

		      $xlsx = SimpleXLSXGen::fromArray($product_archived);
		      $xlsx->downloadAs('Low Stock Product records.xlsx'); // This will download the file to your local system

		      // $xlsx->saveAs('resident.xlsx'); // This will save the file to your server

		      echo "<pre>";

		      print_r($product_archived);

		      header('Location: ../Admin/product_low_stock.php');
		}

		else {
			$_SESSION['message'] = "404 : Page not found";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: ../Admin/dashboard.php");
			exit();
		}
	}

// ************************************* END EXPORT TO EXCEL PROCESSES ************************************* \\


// ************************************* SCAN QR CODE OF PRODUCT ******************************************* \\
// QR CODE SCANNING - SCANQRCODE.PHP
if (isset($_POST['productQR'])) {
    $productQR = $_POST['productQR'];

    // Assuming $productQR contains the format prod_Id-prod_name
    list($prod_Id, $prod_name) = explode('-', $productQR);

    // Perform a query to fetch the corresponding product details
    $check = mysqli_query($conn, "SELECT * FROM product WHERE prod_Id='$prod_Id' AND prod_name='$prod_name'");

    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_array($check);
        $p_Id = $row['p_Id'];
        $prod_name = $row['prod_name'];
        $prod_Id = $row['prod_Id'];
        header('Location: ../product_view.php?p_Id='.$p_Id.'');
        // echo "Product Name: $prod_name<br>";
        // echo "Product ID: $prod_Id<br>";
    } else {
        $_SESSION['message'] = "There is no product record found with this QR Code.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: ../index.php");
    }
}

// ************************************* SCAN QR CODE OF PRODUCT ******************************************* \\

?>
