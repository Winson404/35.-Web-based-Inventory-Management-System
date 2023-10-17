<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }


// ************************************* DELETE FUNCTION RECORDS ************************************* \\

	// FUNCTION TO DELETE RECORDS
	function deleteRecord($conn, $table, $idColumn, $idValue, $redirect) {
	    $delete = mysqli_prepare($conn, "DELETE FROM $table WHERE $idColumn = ?");
	    mysqli_stmt_bind_param($delete, "s", $idValue);
	    mysqli_stmt_execute($delete);

	    if (mysqli_stmt_affected_rows($delete) > 0) {
	        $_SESSION['message'] = "Record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
	        header("Location: $redirect");
	    } else {
	        $_SESSION['message'] = "Deletion failed!";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
	        header("Location: $redirect");
	    }
	    mysqli_stmt_close($delete);
	}

// ************************************* END DELETE FUNCTION RECORDS ************************************* \\



	
// ************************************* FUNCTION ADMIN/USERS ************************************* \\
	
	// SAVE SYSTEM USERS - ADMIN/ADMIN_MGMT.PHP || ADMIN/USERS_MGMT.PHP
	function saveUser($conn, $page, $user_type = "User", $path = "images-users/") {
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$password         = md5($_POST['password']);
		$file             = basename($_FILES["fileToUpload"]["name"]);
		$date_registered  = date('Y-m-d');

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	    if (mysqli_num_rows($check_email) > 0) {
	        displayErrorMessage("Email already exists!", $page);
	    } else {
	        $target_dir = $path;
	        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	        $uploadOk = 1;
	        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	        if ($check == false) {
	            displayErrorMessage("File is not an image.", $page);
	            $uploadOk = 0;
	        } elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	            displayErrorMessage("File must be up to 500KB in size.", $page);
	            $uploadOk = 0;
	        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	            displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	            $uploadOk = 0;
	        } elseif ($uploadOk == 0) {
	            displayErrorMessage("Your file was not uploaded.", $page);
	        } else {
	            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	            	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, user_type, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$user_type', '$date_registered')");
	            	displaySaveMessage($save, $page);
	            } else {
	            	displayErrorMessage("There was an error uploading your profile picture.", $page); 
	            }
	        }
	    }
	}



	// UPDATE SYSTEM USERS - ADMIN/ADMIN_MGMT.PHP || ADMIN/USERS_MGMT.PHP
	function updateSystemUser($conn, $user_Id, $user_type="User", $page) {
   		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		if(mysqli_num_rows($check_email) > 0) {
	       displayErrorMessage("Email already exists.", $page);
		} else {
			if(empty($file)) {
				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type' WHERE user_Id='$user_Id' ");
				displayUpdateMessage($update, "Record has been updated.", $page);
			} else {
				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    displayErrorMessage("File is not an image.", $page);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				    displayErrorMessage("File must be up to 500KB in size.", $page);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					displayErrorMessage("Your file was not uploaded.", $page);
				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");
              	     displayUpdateMessage($update, "Record has been updated.", $page);
					} else {
	    	            displayErrorMessage("There was an error uploading your profile picture.", $page);
					}
				}
			}
		}
	}



	// CHANGE ADMIN PASSWORD - ADMIN/ADMIN_DELETE.PHP
	function changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, $page) {
	    $check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");
	    if (mysqli_num_rows($check_old_password) === 1) {
	        if ($password != $cpassword) {
	            displayErrorMessage("Password did not match.", $page);
	        } else {
	            $update = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id'");
	            displayUpdateMessage($update, "Password has been changed.", $page);
	        }
	    } else {
	    	displayErrorMessage("Old password is incorrect.", $page);
	    }
	}



	// UPDATE ADMIN INFO - ADMIN/PROFILE.PHP || USER/PROFILE.PHP
	function updateProfileInfo($conn, $user_Id, $page) {
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id' ");
		if(mysqli_num_rows($check_email) > 0 ) {
		   $_SESSION['message'] = "";
	       displayErrorMessage("Email already exists!", $page);
		} else {
		  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

      	  displayUpdateMessage($update, "Record has been updated", $page);
		}
	}


	
	// UPDATE ADMIN PROFILE - ADMIN/PROFILE.PHP || || USER/PROFILE.PHP
	function updateProfileAdmin($conn, $user_Id, $page) {
	    $file = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . $file;
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if ($check === false) {
	        displayErrorMessage("Selected file is not an image.", $page);
	    }

	    if ($_FILES["fileToUpload"]["size"] > 500000) {
	        displayErrorMessage("File must be up to 500KB in size.", $page);
	    }

	    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
	        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	    }

	    if ($_FILES["fileToUpload"]["error"] != 0) {
	        displayErrorMessage("Your file was not uploaded.", $page);
	    }

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $update = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	        displayUpdateMessage($update, "Profile picture has been updated!", $page);
	    } else {
	        displayErrorMessage("There was an error uploading your file.", $page);
	    }
	}

// ************************************* END FUNCTION ADMIN/USERS ************************************* \\





// ************************************* FUNCTION CLIENT ************************************* \\
	
	// SAVE CLIENT - ADMIN/CLIENT_MGMT.PHP
	function saveClient($conn, $page) {
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$address		  = mysqli_real_escape_string($conn, $_POST['address']);
		$password         = md5($_POST['password']);
		$date_registered  = date('Y-m-d');

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	    if (mysqli_num_rows($check_email) > 0) {
	        displayErrorMessage("Email already exists!", $page);
	    } else {
	        $check_email2 = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
		    if (mysqli_num_rows($check_email2) > 0) {
		        displayErrorMessage("Email already exists!", $page);
		    } else {
		    	$save = mysqli_query($conn, "INSERT INTO clients (firstname, middlename, lastname, suffix, email, address, password, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$email', '$address', '$password', '$date_registered')");
	            	displaySaveMessage($save, $page);
			}
	    }
	}



	// UPDATE CLIENT - CLIENT_MGMT.PHP
	function updateClient($conn, $Id, $page) {
		$Id         = $_POST['Id'];
		$firstname  = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname   = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix     = mysqli_real_escape_string($conn, $_POST['suffix']);
		$email		= mysqli_real_escape_string($conn, $_POST['email']);
		$address    = mysqli_real_escape_string($conn, $_POST['address']);

		$update = mysqli_query($conn, "UPDATE clients SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', email='$email', address='$address' WHERE Id='$Id'");
        displayUpdateMessage($update, "Client information has been updated!", $page);
	}
	

// ************************************* END FUNCTION CLIENT ************************************* \\




// ************************************* FUNCTION MECHANIC ************************************* \\
	
	// SAVE MECHANIC - ADMIN/MECHANIC_MGMT.PHP
	function saveMechanic($conn, $page) {
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$address		  = mysqli_real_escape_string($conn, $_POST['address']);
		$date_registered  = date('Y-m-d');

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	    if (mysqli_num_rows($check_email) > 0) {
	        displayErrorMessage("Email already exists!", $page);
	    } else {
	        $check_email2 = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
		    if (mysqli_num_rows($check_email2) > 0) {
		        displayErrorMessage("Email already exists!", $page);
		    } else {
		    	$check_email3 = mysqli_query($conn, "SELECT * FROM mechanic WHERE email='$email'");
			    if (mysqli_num_rows($check_email3) > 0) {
			        displayErrorMessage("Email already exists!", $page);
			    } else {
			    	$save = mysqli_query($conn, "INSERT INTO mechanic (firstname, middlename, lastname, suffix, email, address, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$email', '$address', '$date_registered')");
		            	displaySaveMessage($save, $page);
				}
			}
	    }
	}



	// UPDATE MECHANIC - MECHANIC_MGMT.PHP
	function updateMechanic($conn, $Id, $page) {
		$Id         = $_POST['Id'];
		$firstname  = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname   = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix     = mysqli_real_escape_string($conn, $_POST['suffix']);
		$email		= mysqli_real_escape_string($conn, $_POST['email']);
		$address    = mysqli_real_escape_string($conn, $_POST['address']);

		$update = mysqli_query($conn, "UPDATE mechanic SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', email='$email', address='$address' WHERE Id='$Id'");
        displayUpdateMessage($update, "Mechanic information has been updated!", $page);
	}
	

// ************************************* END FUNCTION MECHANIC ************************************* \\





// ************************************* FUNCTION PRODUCTS ************************************* \\

	// SAVE PRODUCT - PRODUCT_MGMT.PHP
	function saveProduct($conn, $page, $qr_image_path) {
		$cat_Id       = $_POST['cat_Id'];
		$prod_Id      = $_POST['prod_Id'];
		$prod_name    = mysqli_real_escape_string($conn, ucwords($_POST['prod_name']));
		$prod_stock   = mysqli_real_escape_string($conn, ucwords($_POST['prod_stock']));
		$prod_item_no = mysqli_real_escape_string($conn, ucwords($_POST['prod_item_no']));
		$file         = basename($_FILES["fileToUpload"]["name"]);
		$date_today   = date('Y-m-d');

		// SAVING QR CODES**********************************************************************
		$prod_qr = uniqid('', true);
		// Generate the QR code image filename (with path)
		$path = $qr_image_path;
		$qr_image_filename = $prod_qr . ".png";
		$qr_image = $path . $qr_image_filename;
		// Save the QR code image
		QRcode::png($prod_qr, $qr_image, 'L', 10, 10);
	    // *************************************************************************************

	    $check1 = mysqli_query($conn, "SELECT * FROM product WHERE prod_qr='$prod_qr'");
	    if (mysqli_num_rows($check1) > 0) {
	        displayErrorMessage("QR ID already exists.", $page);
	    } else {
	    	
		    $target_dir = "../images-product/";
		    $target_file = $target_dir . $file;
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if ($check === false) {
		        displayErrorMessage("Selected file is not an image.", $page);
		    }

		    if ($_FILES["fileToUpload"]["size"] > 500000) {
		        displayErrorMessage("File must be up to 500KB in size.", $page);
		    }

		    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
		        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
		    }

		    if ($_FILES["fileToUpload"]["error"] != 0) {
		        displayErrorMessage("Your file was not uploaded.", $page);
		    }

		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $save = mysqli_query($conn, "INSERT INTO product (cat_Id, prod_Id, prod_name, prod_stock, prod_item_no, prod_image, prod_qr, date_added) VALUES ('$cat_Id', '$prod_Id', '$prod_name', '$prod_stock', '$prod_item_no', '$file', '$qr_image_filename', '$date_today')");
            	displaySaveMessage($save, $page);
		    } else {
		        displayErrorMessage("There was an error uploading your file.", $page);
		    }
	    }
	}


	// UPDATE PRODUCT - PRODUCT_MGMT.PHP
	function updateProduct($conn, $p_Id, $page) {
		$p_Id         = $_POST['p_Id'];
		$cat_Id       = $_POST['cat_Id'];
		$prod_Id      = $_POST['prod_Id'];
		$prod_name    = mysqli_real_escape_string($conn, ucwords($_POST['prod_name']));
		$prod_stock   = mysqli_real_escape_string($conn, ucwords($_POST['prod_stock']));
		$prod_item_no = mysqli_real_escape_string($conn, ucwords($_POST['prod_item_no']));
		$file         = basename($_FILES["fileToUpload"]["name"]);

		if(empty($file)) {
			$update = mysqli_query($conn, "UPDATE product SET cat_Id='$cat_Id', prod_Id='$prod_Id', prod_name='$prod_name', prod_name='$prod_name', prod_stock='$prod_stock', prod_item_no='$prod_item_no' WHERE p_Id='$p_Id'");
            displayUpdateMessage($update, "Product information has been updated!", $page);
		} else {
			$target_dir = "../images-product/";
		    $target_file = $target_dir . $file;
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if ($check === false) {
		        displayErrorMessage("Selected file is not an image.", $page);
		    }

		    if ($_FILES["fileToUpload"]["size"] > 500000) {
		        displayErrorMessage("File must be up to 500KB in size.", $page);
		    }

		    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
		        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
		    }

		    if ($_FILES["fileToUpload"]["error"] != 0) {
		        displayErrorMessage("Your file was not uploaded.", $page);
		    }

		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $update = mysqli_query($conn, "UPDATE product SET cat_Id='$cat_Id', prod_Id='$prod_Id', prod_name='$prod_name', prod_name='$prod_name', prod_stock='$prod_stock', prod_item_no='$prod_item_no', prod_image='$file' WHERE p_Id='$p_Id'");
            	displayUpdateMessage($update, "Product information has been updated!", $page);
		    } else {
		        displayErrorMessage("There was an error uploading your file.", $page);
		    }
		}
	}

// ************************************* FUNCTION PRODUCTS ************************************* \\




// ************************************* FUNCTION CATEGORY ************************************* \\

	// SAVE CATEGORY - CATEGORY_ADD.PHP
	function saveCategory($conn, $cat_name, $cat_description, $page) {
	    $fetch = mysqli_query($conn, "SELECT * FROM category WHERE cat_name='$cat_name'");
		if(mysqli_num_rows($fetch) > 0) {
			displayErrorMessage("Category already exists.", $page);
		} else {
			$save = mysqli_query($conn, "INSERT INTO category (cat_name, cat_description, date_created) VALUES ('$cat_name', '$cat_description', NOW())");
			if($save) {
				displaySaveMessage($save, $page);
			} else {
				displayErrorMessage("Something went wrong while saving the information.", $page);
			}
		}
	}


	// UPDATE CATEGORY - CATEGORY_UPDATE_DELETE.PHP
	function updateCategory($conn, $cat_Id, $cat_name, $cat_description, $page) {
	    $fetch = mysqli_query($conn, "SELECT * FROM category WHERE cat_name='$cat_name' AND cat_Id != '$cat_Id' ");
		if(mysqli_num_rows($fetch) > 0) {
			displayErrorMessage("Category already exists.", $page);
		} else {
			$update = mysqli_query($conn, "UPDATE category SET cat_name='$cat_name', cat_description='$cat_description' WHERE cat_Id = '$cat_Id'");
			if($update) {
				displayUpdateMessage($update, "Category information has been updated!", $page);
			} else {
				displayErrorMessage("Something went wrong while updating the information.", $page);
			}
		}
	}


// ************************************* FUNCTION CATEGORY ************************************* \\






// ************************************* FUNCTION SCHEDULE ************************************* \\

	// SAVE SCHEDULE - USER/SCHEDULE_MGMT.PHP
	function saveSchedule($conn, $page) {
		$client_Id     = $_POST['client_Id'];
		$selectedDate  = $_POST['selectedDate'];
		$selectedTime  = $_POST['selectedTime'];
		$services      = $_POST['services'];
		$otherServices = $_POST['otherServices'];
		$mechanic_Id   = $_POST['mechanic_Id'];
		$save = mysqli_query($conn, "INSERT INTO schedule (client_Id, selectedDate, selectedTime, services, otherServices, mechanic_Id, date_added) VALUES ('$client_Id', '$selectedDate', '$selectedTime', '$services', '$otherServices', '$mechanic_Id', NOW())");
    	displaySaveMessage($save, $page);
	}
	

	// UPDATE SCHEDULE STATAUS - SCHEDULE_VIEW_DELETE.PHP
	function updateScheduleStatus($conn, $sched_Id, $status, $page) {
		if($status == 1) {
			$update = mysqli_query($conn, "UPDATE schedule SET status='$status', date_approved=NOW() WHERE sched_Id = '$sched_Id'");
			if($update) {
				$fetch = mysqli_query($conn, "SELECT *, clients.email AS client_email, 
	                    CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
	                    FROM schedule 
	                    JOIN clients ON schedule.client_Id = clients.Id 
	                    JOIN mechanic ON schedule.mechanic_Id = mechanic.Id 
	                    WHERE sched_Id = '$sched_Id'");

				if(mysqli_num_rows($fetch) > 0) {
				    $row = mysqli_fetch_array($fetch);

				    $stat_text = "";
				    if($status == 0) {
				    	$stat_text = "Pending";
				    } elseif($status == 1) {
				    	$stat_text = "Approved";
				    } else {
				    	$stat_text = "Denied";
				    }

				    $name = $row['full_name'];
				    $email = $row['client_email'];
				    $subject = "Schedule status: ".$stat_text;
			        $message = '<p>Good day sir/maam '.$name.', This is to inform you that the schedule you have set was moved to status: <b>'.$stat_text.'</b></p> 
			        <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

				    $mail = new PHPMailer(true);
				    try {
				        // Server settings
				        $mail->isSMTP();
				        $mail->Host = 'smtp.gmail.com';
				        $mail->SMTPAuth = true;
				        $mail->Username = 'tatakmedellin@gmail.com';
				        $mail->Password = 'nzctaagwhqlcgbqq';
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				                'verify_peer' => false,
				                'verify_peer_name' => false,
				                'allow_self_signed' => true
				            )
				        );
				        $mail->SMTPSecure = 'ssl';
				        $mail->Port = 465;

				        // Send Email
				        $mail->setFrom('tatakmedellin@gmail.com');

				        // Recipients
				        $mail->addAddress($email);
				        $mail->addReplyTo('tatakmedellin@gmail.com');

				        // Content
				        $mail->isHTML(true);
				        $mail->Subject = $subject;
				        $mail->Body = $message;

				        $mail->send();

				        displayUpdateMessage($mail, "Schedule status has been set to ".$stat_text.". ", $page);

				    } catch (Exception $e) {
				        $_SESSION['success'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
				        header("Location: $page");
				    }

				} else {
					displayErrorMessage("Schedule not found.", $page);
				}
				
			} else {
				displayErrorMessage("Something went wrong while updating the information.", $page);
			}
		} else {
			$update = mysqli_query($conn, "UPDATE schedule SET status='$status' WHERE sched_Id = '$sched_Id'");
			if($update) {
				$fetch = mysqli_query($conn, "SELECT *, clients.email AS client_email, 
	                    CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname, ' ', clients.suffix) AS full_name
	                    FROM schedule 
	                    JOIN clients ON schedule.client_Id = clients.Id 
	                    JOIN mechanic ON schedule.mechanic_Id = mechanic.Id 
	                    WHERE sched_Id = '$sched_Id'");

				if(mysqli_num_rows($fetch) > 0) {
				    $row = mysqli_fetch_array($fetch);

				    $stat_text = "";
				    if($status == 0) {
				    	$stat_text = "Pending";
				    } elseif($status == 1) {
				    	$stat_text = "Approved";
				    } else {
				    	$stat_text = "Denied";
				    }

				    $name = $row['full_name'];
				    $email = $row['client_email'];
				    $subject = "Schedule status: ".$stat_text;
			        $message = '<p>Good day sir/maam '.$name.', This is to inform you that the schedule you have set was moved to status: <b>'.$stat_text.'</b></p> 
			        <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

				    $mail = new PHPMailer(true);
				    try {
				        // Server settings
				        $mail->isSMTP();
				        $mail->Host = 'smtp.gmail.com';
				        $mail->SMTPAuth = true;
				        $mail->Username = 'tatakmedellin@gmail.com';
				        $mail->Password = 'nzctaagwhqlcgbqq';
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				                'verify_peer' => false,
				                'verify_peer_name' => false,
				                'allow_self_signed' => true
				            )
				        );
				        $mail->SMTPSecure = 'ssl';
				        $mail->Port = 465;

				        // Send Email
				        $mail->setFrom('tatakmedellin@gmail.com');

				        // Recipients
				        $mail->addAddress($email);
				        $mail->addReplyTo('tatakmedellin@gmail.com');

				        // Content
				        $mail->isHTML(true);
				        $mail->Subject = $subject;
				        $mail->Body = $message;

				        $mail->send();

				        displayUpdateMessage($mail, "Schedule status has been set to ".$stat_text.". ", $page);

				    } catch (Exception $e) {
				        $_SESSION['success'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
				        header("Location: $page");
				    }

				} else {
					displayErrorMessage("Schedule not found.", $page);
				}
				
			} else {
				displayErrorMessage("Something went wrong while updating the information.", $page);
			}
	    }
	}


	// UPDATE SCHEDULE - USER/SCHEDULE_MGMT.PHP
	function updateSchedule($conn, $sched_Id, $page) {
		$selectedDate  = $_POST['selectedDate'];
		$selectedTime  = $_POST['selectedTime'];
		$services      = $_POST['services'];
		$otherServices = $_POST['otherServices'];
		$mechanic_Id   = $_POST['mechanic_Id'];
		$update = mysqli_query($conn, "UPDATE schedule SET selectedDate='$selectedDate', selectedTime='$selectedTime', services='$services', otherServices='$otherServices', mechanic_Id='$mechanic_Id' WHERE sched_Id = '$sched_Id'");
		if($update) {
			displayUpdateMessage($update, "Schedule has been updated.", $page);
		} else {
			displayErrorMessage("Something went wrong while updating the information.", $page);
		}
	}

// ************************************* FUNCTION SCHEDULE ************************************* \\





	// CONTACT EMAIL MESSAGING
	function sendEmail($subject, $message, $recipientEmail, $page) {
	    $mail = new PHPMailer(true);
	    try {
	        // Server settings
	        $mail->isSMTP();
	        $mail->Host = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'tatakmedellin@gmail.com';
	        $mail->Password = 'nzctaagwhqlcgbqq';
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );
	        $mail->SMTPSecure = 'ssl';
	        $mail->Port = 465;

	        // Send Email
	        $mail->setFrom('tatakmedellin@gmail.com');

	        // Recipients
	        $mail->addAddress($recipientEmail);
	        $mail->addReplyTo('tatakmedellin@gmail.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $subject;
	        $mail->Body = $message;

	        $mail->send();

	        $_SESSION['success'] = "Email sent successfully!";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");

	    } catch (Exception $e) {
	        $_SESSION['success'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	        header("Location: $page");
	    }
	}


?>



