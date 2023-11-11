<?php 
	include '../config.php';
	include('../phpqrcode/qrlib.php');
	include("XLSXLibrary.php");
	include('../dompdf/autoload.inc.php');
	use Dompdf\Dompdf;
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
	

// ************************************* END CATEGORY PROCESSES ************************************* \\


// ************************************* EXPORT TO PDF PROCESSES ************************************* \\

// EXPORT CLIENT RECORDS TO PDF
if(isset($_GET['pdfExport'])) {
	$pdfExport = $_GET['pdfExport'];

	// CLIENT PDF EXPORT
	if($pdfExport == 'Client') {
		$sql = mysqli_query($conn, "SELECT * FROM clients");
		if(mysqli_num_rows($sql) > 0) {
		
			$html = '';
			// Header with Logo, Business Name, Address, and Contact
	        $html .= '
	            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
				    <h2 style="margin: 0px;">Inventory Management System</h2>
				    <p style="margin: 0px;">Business Address, City, State, Zip Code</p>
				    <p style="margin: 0px;">Contact: (123) 456-7890 | Email: info@example.com</p>
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
		                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Address</th>
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
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['address']) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_registered'])) . '</td>
					</tr>
				';
			}
		
			$html .= '</table>';
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
		$sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User'");
		if(mysqli_num_rows($sql) > 0) {
		
			$html = '';
			// Header with Logo, Business Name, Address, and Contact
	        $html .= '
	            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
				    <h2 style="margin: 0px;">Inventory Management System</h2>
				    <p style="margin: 0px;">Business Address, City, State, Zip Code</p>
				    <p style="margin: 0px;">Contact: (123) 456-7890 | Email: info@example.com</p>
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
			foreach($sql2 as $row) {
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
		
			$html .= '</table>';
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
		$sql = mysqli_query($conn, "SELECT *, clients.email AS client_email, clients.address AS client_address, 
                                CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
                                FROM schedule 
                                JOIN clients ON schedule.client_Id = clients.Id 
                                JOIN mechanic ON schedule.mechanic_Id = mechanic.Id ORDER BY selectedDate DESC");
		if(mysqli_num_rows($sql) > 0) {
		
			$html = '';
			// Header with Logo, Business Name, Address, and Contact
	        $html .= '
	            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
				    <h2 style="margin: 0px;">Inventory Management System</h2>
				    <p style="margin: 0px;">Business Address, City, State, Zip Code</p>
				    <p style="margin: 0px;">Contact: (123) 456-7890 | Email: info@example.com</p>
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
			foreach($sql2 as $row) {
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
						<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['full_name']) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($services) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($name) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $status . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ($row['date_approved'] != '' ? date("F d, Y", strtotime($row['date_approved'])) : 'N/A') . '</td>

                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
					</tr>
				';
			}
		
			$html .= '</table>';
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
		$sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0");
		if(mysqli_num_rows($sql) > 0) {
		
			$html = '';
			// Header with Logo, Business Name, Address, and Contact
	        $html .= '
	            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
				    <h2 style="margin: 0px;">Inventory Management System</h2>
				    <p style="margin: 0px;">Business Address, City, State, Zip Code</p>
				    <p style="margin: 0px;">Contact: (123) 456-7890 | Email: info@example.com</p>
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
		                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Stock</th>
		                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Item No</th>
		                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
		                </tr>
		            </thead>
		            <tbody id="users_data">	
			';
		
			foreach($sql as $row) {
				$html .= '
					<tr>
						<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_Id'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['cat_name']) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['prod_name']) . '</td>
                        <<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_stock'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_item_no'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
					</tr>
				';
			}
			$html .= '</table>';
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
		$sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1");
		if(mysqli_num_rows($sql) > 0) {
			$html = '';
			// Header with Logo, Business Name, Address, and Contact
	        $html .= '
	            <div style="text-align: center; margin-bottom: 10px; padding-bottom: 10px;">
				    <h2 style="margin: 0px;">Inventory Management System</h2>
				    <p style="margin: 0px;">Business Address, City, State, Zip Code</p>
				    <p style="margin: 0px;">Contact: (123) 456-7890 | Email: info@example.com</p>
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
	                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Stock</th>
	                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Item No</th>
	                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Date Added</th>
	                </tr>
	            </thead>
	            <tbody id="users_data">	
		    ';
			foreach($sql as $row) {
				$html .= '
					<tr>
						<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_Id'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['cat_name']) . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . ucwords($row['prod_name']) . '</td>
                        <<td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_stock'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . $row['prod_item_no'] . '</td>
                        <td style="border: 1px solid #ddd; padding: 12px; text-align: left;">' . date("F d, Y", strtotime($row['date_added'])) . '</td>
					</tr>
				';
			}
			$html .= '</table>';
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
	if(isset($_GET['ExcelExport'])) {
		$ExcelExport = $_GET['ExcelExport'];

		// CLIENT EXCEL EXPORT
		if($ExcelExport == 'Client') {
			
			$client = [
		        ['No.', 'Full name', 'Email', 'Address', 'Date registered']
		      ];

		      $id = 0;
		      $sql = "SELECT * FROM clients ORDER BY firstname";
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
		          $name = $row['firstname']. ' ' .$row['middlename']. ' ' .$row['lastname']. ' ' .$row['suffix'];
		          // $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
		          $client = array_merge($client, array(array($id, ucwords($name), ucwords($row['email']), ucwords($row['address']), date("F d, Y", strtotime($row['date_registered'])))));
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
		      $sql = "SELECT * FROM users WHERE user_type = 'User'";
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
		      $sql = "SELECT *, clients.email AS client_email, clients.address AS client_address, 
	                                CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
	                                FROM schedule 
	                                JOIN clients ON schedule.client_Id = clients.Id 
	                                JOIN mechanic ON schedule.mechanic_Id = mechanic.Id ORDER BY selectedDate DESC";
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
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

		          $schedule = array_merge($schedule, array(array($id, ucwords($row['full_name']), ucwords($services),  date("F d, Y",strtotime($row['selectedDate'])).' - '.date("h:i A", strtotime($row['selectedTime'])), ucwords($name), $status, ($row['date_approved'] != '' ? date("F d, Y", strtotime($row['date_approved'])) : 'N/A'), date("F d, Y", strtotime($row['date_added'])) )));
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
			$product = [
		        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Product Item No', 'Date Added']
		      ];

		      $id = 0;
		      $sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=0";
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
		          $product = array_merge($product, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], $row['prod_item_no'], date("F d, Y", strtotime($row['date_added'])) )));
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
			$product_archived = [
		        ['No.', 'Product ID', 'Category', 'Product Name', 'Product Stock', 'Product Item No', 'Status', 'Date Added']
		      ];

		      $id = 0;
		      $sql = "SELECT * FROM product JOIN category ON product.cat_Id=category.cat_Id WHERE product.is_archived=1";
		      $res = mysqli_query($conn, $sql);
		      if (mysqli_num_rows($res) > 0) {
		        foreach ($res as $row) {
		          $id++;
		          $product_archived = array_merge($product_archived, array(array($id, $row['prod_Id'], ucwords($row['cat_name']), ucwords($row['prod_name']), $row['prod_stock'], $row['prod_item_no'], date("F d, Y", 'Archived', strtotime($row['date_added'])) )));
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

		else {
			$_SESSION['message'] = "404 : Page not found";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: ../Admin/dashboard.php");
			exit();
		}
	}

// ************************************* END EXPORT TO EXCEL PROCESSES ************************************* \\

?>
