<title>IMS | Schedule records</title>
<?php include 'navbar.php'; ?>

	
	<div class="homepageContainer">
		<div class="homepageFeatures">
			<div class="container-fluid">
			<?php if($type === 'Client') { ?>
				<?php 
					  if(isset($_GET['sched_Id'])) {
						$sched_Id = $_GET['sched_Id'];
						$fetch = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.sched_Id='$sched_Id'");
					    $row = mysqli_fetch_array($fetch);

					    $mech_Id = '';
						$mech_name = '';
						$mech_email = '';
						$mech_address = '';

						if($row['mechanic_Id'] == 0) {
							$mech_name = 'No Mechanic Assigned';
						} else {
							$mech_Id = $row['mechanic_Id'];
							$get_mech = mysqli_query($conn, "SELECT * FROM mechanic WHERE Id='$mech_Id'");
							if(mysqli_num_rows($get_mech) > 0){
								$row2 = mysqli_fetch_array($get_mech);
								$mech_name = ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']);
								$mech_email = ucwords($row2['email']);
								$mech_address = ucwords($row2['address']);
							} else {
								$mech_name = 'No Mechanic Available';
							}
						}
				?>
						<div class="row d-flex justify-content-center">
				          <div class="col-md-8">

				            <div class="card card-solid">
				              <div class="card-header p-2">
				                <ul class="nav nav-pills">
				                <?php if($row['mechanic_Id'] != 0): ?>
				                  <li class="nav-item"><a class="nav-link active" href="#mechanicProfile" data-toggle="tab">Mechanic profile</a></li>
				                <?php endif; ?>
				                  <li class="nav-item"><a class="nav-link <?php if($row['mechanic_Id'] == 0) { echo 'active'; } ?>" href="#scheduleDetails" data-toggle="tab">Schedule details</a></li>
				                  <li class="nav-item"><a class="nav-link" href="#vehicleDetails" data-toggle="tab">Vehicle details</a></li>
				                </ul>
				              </div><!-- /.card-header -->
				              <div class="card-body">

				                <div class="tab-content" >
				                <?php if($row['mechanic_Id'] != 0): ?>
				                  <div class="tab-pane active" id="mechanicProfile">
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Full name</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $mech_name; ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Email</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $mech_email; ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Address</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $mech_address; ?>" readonly>
				                        </div>
				                      </div>
				                  </div>
				                 <?php endif; ?>

				                  <div class="tab-pane <?php if($row['mechanic_Id'] == 0) { echo 'active'; } ?>" id="scheduleDetails">
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Selected Date</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?= date("F d, Y",strtotime($row['selectedDate'])); ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Selected Time</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo date("h:i A", strtotime($row['selectedTime'])); ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Services</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo $row['services']; ?>" readonly>
				                        </div>
				                      </div>
				                      <?php if($row['services'] == "Others"): ?>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Other services</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo $row['otherServices']; ?>" readonly>
				                        </div>
				                      </div>
				                      <?php endif; ?>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Status</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control"
				                          value="<?php if($row['status'] == 0) { echo 'Pending'; } elseif($row['status'] == 1) { echo 'Approved'; }else { echo 'Denied'; } ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Date approved</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php if(!empty($row['date_approved'])) { echo date("F d, Y h:i:s A",strtotime($row['date_approved'])); } else { echo 'N/A'; } ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Date scheduled</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo date("F d, Y",strtotime($row['date_added'])); ?>" readonly>
				                        </div>
				                      </div>
				                  </div>

				                  <div class="tab-pane" id="vehicleDetails">
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Type of Vehicle</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['vehicleType']; ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Year Model</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['yearModel']; ?>" readonly>
				                        </div>
				                      </div>
			                        <h5 class="text-center mt-5">List of Products Used To Repair Your Vehicle</h5>
			                        <hr>
			                        <table id="example111" class="table table-bordered table-hover table-sm text-sm">
							            <thead>
							                <tr>
							                    <th class="text-center">Product Name</th>
							                    <th class="text-center">Number of Stock Used</th>
							                    <th class="text-center">Date Usage</th>
							                </tr>
							            </thead>
							            <tbody>
							                <?php
							                  $client_Id = $row['client_Id'];
						                      $fetchProducts = mysqli_query($conn, "SELECT
		                                        transaction_log.product_Id,
		                                        transaction_log.date_updated,
		                                        product.prod_name,
		                                        category.cat_name,
		                                        SUM(transaction_log.quantity_used) AS total_quantity_used
		                                      FROM
		                                        transaction_log
		                                      JOIN
		                                        schedule ON transaction_log.sched_Id = schedule.sched_Id
		                                      JOIN
		                                        product ON transaction_log.product_Id = product.p_Id
		                                      JOIN
		                                        category ON product.cat_Id = category.cat_Id
		                                      WHERE transaction_log.sched_Id = '$sched_Id'
		                                        AND transaction_log.client_Id = '$client_Id'
		                                      GROUP BY
		                                        transaction_log.product_Id, transaction_log.sched_Id, transaction_log.client_Id
		                                      ORDER BY
		                                        product.prod_name ASC");


				               				  // $fetchProducts = mysqli_query($conn, "SELECT product.p_Id, product.prod_name, product.prod_stock, category.cat_name
                                              // FROM product
                                              // JOIN category ON product.cat_Id = category.cat_Id
                                              // WHERE product.prod_stock > 0
                                              // AND product.is_archived=0
                                              // ORDER BY product.p_Id ASC");

								                $products = array();
								                while ($product = mysqli_fetch_assoc($fetchProducts)) {
								                    $products[] = $product;
								                }

								                foreach ($products as $product) {
						                    ?>
							                    <tr>
							                        <td class="text-center"><?php echo $product['prod_name']; ?></td>
							                        <td class="text-center"><?php echo $product['total_quantity_used']; ?></td>
							                        <td class="text-center"><?php echo date("F d, Y h:i:s A", strtotime($product['date_updated'])); ?></td>
							                    </tr>
							                <?php } ?>
							            </tbody>
							        </table>
				                  </div>

				                </div>

				              </div>
				              <div class="card-footer">
				                <a href="schedule.php" class="btn bg-secondary btn-flat float-right"><i class="fas fa-arrow-left"></i> Back</a>
				              </div>
				            </div>
				          </div>
				        </div>

				<?php } else { ?>

					<div class="error-content m-5 p-3">
				      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
				      <p>
				        We could not find the page you were looking for.
				        Meanwhile, you may <a href="index.php">return to home page.</a>
				      </p>
				    </div>

				<?php } ?>
			<?php } else { ?>
				<?php 
					if(isset($_GET['sched_Id'])) {
						$sched_Id = $_GET['sched_Id'];
						$fetch = mysqli_query($conn, "SELECT * FROM schedule JOIN clients ON schedule.client_Id = clients.Id WHERE schedule.sched_Id='$sched_Id'");
					    $row = mysqli_fetch_array($fetch);
				?>
						<div class="row d-flex justify-content-center">
				          <div class="col-md-9">

				            <div class="card card-solid">
				              <div class="card-header p-2">
				                <ul class="nav nav-pills">
				                  <li class="nav-item"><a class="nav-link active" href="#clientProfile" data-toggle="tab">Client profile</a></li>
				                  <li class="nav-item"><a class="nav-link" href="#scheduleDetails" data-toggle="tab">Schedule details</a></li>
				                  <li class="nav-item"><a class="nav-link" href="#vehicleDetails" data-toggle="tab">Vehicle details</a></li>
				                  <li class="nav-item"><a class="nav-link" href="#usedProducts" data-toggle="tab">Products used</a></li>
				                </ul>
				              </div><!-- /.card-header -->
				              <div class="card-body">

				                <div class="tab-content" >

				                  <div class="tab-pane active" id="clientProfile">
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Full name</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?= ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Email</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['email']; ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Address</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['address']; ?>" readonly>
				                        </div>
				                      </div>
				                      
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Date registered</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo date("F d, Y h:i:s A", strtotime($row['date_registered'])); ?>" readonly>
				                        </div>
				                      </div>
				                  </div>

				                  <div class="tab-pane" id="scheduleDetails">
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Selected Date</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?= date("F d, Y",strtotime($row['selectedDate'])); ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Selected Time</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo date("h:i A", strtotime($row['selectedTime'])); ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Services</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo $row['services']; ?>" readonly>
				                        </div>
				                      </div>
				                      <?php if($row['services'] == "Others"): ?>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Other services</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo $row['otherServices']; ?>" readonly>
				                        </div>
				                      </div>
				                      <?php endif; ?>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Status</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control"
				                          value="<?php if($row['status'] == 0) { echo 'Pending'; } elseif($row['status'] == 1) { echo 'Approved'; }else { echo 'Denied'; } ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Date approved</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php if(!empty($row['date_approved'])) { echo date("F d, Y h:i:s A",strtotime($row['date_approved'])); } else { echo 'N/A'; } ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label">Date scheduled</label>
				                        <div class="col-sm-9">
				                          <input type="text" class="form-control" value="<?php echo date("F d, Y",strtotime($row['date_added'])); ?>" readonly>
				                        </div>
				                      </div>
				                  </div>

				                  <div class="tab-pane" id="vehicleDetails">
				                  	<form action="../includes/processes.php" method="POST">
				                  		<input type="hidden" class="form-control" value="<?= $row['sched_Id'] ?>" name="sched_Id">
				                  		<input type="hidden" class="form-control" value="<?= $row['client_Id'] ?>" name="client_Id">
				                  		<input type="hidden" class="form-control" value="<?= $row['mechanic_Id'] ?>" name="mechanic_Id">
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Type of Vehicle</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['vehicleType']; ?>" readonly>
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Year Model</label>
				                        <div class="col-sm-10">
				                          <input type="text" class="form-control" value="<?php echo $row['yearModel']; ?>" readonly>
				                        </div>
				                      </div>

				                      	<h5 class="text-center mt-5">List of Available Products</h5>
				                      	<p class="text-sm text-center">Fill out the number of stock of the products used to repair <b><?= ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></b>'s vehicle.</p>
				                      	<hr>
								        <table id="example1111" class="table table-bordered table-hover table-sm text-sm">
								            <thead>
								                <tr>
								                    <th>Product Name</th>
								                    <th class="text-center">Available Stock</th>
								                    <th class="text-center">Stock Used</th>
								                </tr>
								            </thead>
								            <tbody>
								                <?php
						               				  $fetchProducts = mysqli_query($conn, "SELECT product.p_Id, product.prod_name, product.prod_stock, category.cat_name
                                                      FROM product
                                                      JOIN category ON product.cat_Id = category.cat_Id
                                                      WHERE product.prod_stock > 0
                                                      AND product.is_archived=0
                                                      ORDER BY product.p_Id ASC");

									                $products = array();
									                while ($product = mysqli_fetch_assoc($fetchProducts)) {
									                    $products[] = $product;
									                }

									                foreach ($products as $product) {
							                    ?>
								                    <tr>
								                        <td>
								                        	<input type="hidden" class="form-control" name="product_ids[]" value="<?php echo $product['p_Id']; ?>">
								                        	<?php echo $product['prod_name']; ?>
								                        </td>
								                        <td class="text-center"><?php echo $product['prod_stock']; ?></td>
								                        <td>
								                            <input type="number" class="form-control form-control-sm text-center" name="stock_used[<?php echo $product['p_Id']; ?>]" placeholder="Stock Used" pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
								                        </td>
								                    </tr>
								                <?php } ?>
								            </tbody>
								        </table>
				                      <div class="form-group">
				                          <button type="submit" name="EditStockUsed" class="btn btn-primary btn-flat btn-sm float-right mt-3"><i class="fas fa-pencil-alt"></i> Update Vehicle Info</button>
				                      </div>
				                     </form>
				                  </div>

				                  <div class="tab-pane" id="usedProducts">
				                  	<p class="text-center">List of Products Used To Repair The <b><?= ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></b>'s Vehicle</p>
			                        <hr>
			                        <table id="example111" class="table table-bordered table-hover table-sm text-sm">
							            <thead>
							                <tr>
							                    <th class="text-center">Product Name</th>
							                    <th class="text-center">Number of Stock Used</th>
							                    <th class="text-center">Date Usage</th>
							                </tr>
							            </thead>
							            <tbody>
							                <?php
							                  $client_Id = $row['client_Id'];
						                      $fetchProducts = mysqli_query($conn, "SELECT
		                                        transaction_log.product_Id,
		                                        transaction_log.date_updated,
		                                        product.prod_name,
		                                        category.cat_name,
		                                        SUM(transaction_log.quantity_used) AS total_quantity_used
		                                      FROM
		                                        transaction_log
		                                      JOIN
		                                        schedule ON transaction_log.sched_Id = schedule.sched_Id
		                                      JOIN
		                                        product ON transaction_log.product_Id = product.p_Id
		                                      JOIN
		                                        category ON product.cat_Id = category.cat_Id
		                                      WHERE transaction_log.mechanic_Id = '$Id'
		                                        AND transaction_log.sched_Id = '$sched_Id'
		                                        AND transaction_log.client_Id = '$client_Id'
		                                      GROUP BY
		                                        transaction_log.product_Id, transaction_log.sched_Id, transaction_log.client_Id
		                                      ORDER BY
		                                        product.prod_name ASC");


				               				  // $fetchProducts = mysqli_query($conn, "SELECT product.p_Id, product.prod_name, product.prod_stock, category.cat_name
                                              // FROM product
                                              // JOIN category ON product.cat_Id = category.cat_Id
                                              // WHERE product.prod_stock > 0
                                              // AND product.is_archived=0
                                              // ORDER BY product.p_Id ASC");

								                $products = array();
								                while ($product = mysqli_fetch_assoc($fetchProducts)) {
								                    $products[] = $product;
								                }

								                foreach ($products as $product) {
						                    ?>
							                    <tr>
							                        <td class="text-center"><?php echo $product['prod_name']; ?></td>
							                        <td class="text-center"><?php echo $product['total_quantity_used']; ?></td>
							                        <td class="text-center"><?php echo date("F d, Y h:i:s A", strtotime($product['date_updated'])); ?></td>
							                    </tr>
							                <?php } ?>
							            </tbody>
							        </table>
				                  </div>

				                </div>

				              </div>
				              <div class="card-footer">
				                <a href="schedule.php" class="btn bg-secondary btn-flat float-right"><i class="fas fa-arrow-left"></i> Back</a>
				              </div>
				            </div>
				          </div>
				        </div>

				<?php } else { ?>

					<div class="error-content m-5 p-3">
				      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
				      <p>
				        We could not find the page you were looking for.
				        Meanwhile, you may <a href="index.php">return to home page.</a>
				      </p>
				    </div>

				<?php } ?>
			<?php } ?>
			</div>
		</div>
	</div>
	
	<?php require_once 'footer.php'; ?>
	<script>
	    function toggleOtherServices() {
	        var dropdown = document.getElementById("servicesDropdown");
	        var otherServicesGroup = document.getElementById("otherServicesGroup");
	        var otherServicesTextarea = document.getElementById("otherServices");

	        // Check if the selected value is "Others"
	        if (dropdown.value === "Others") {
	            otherServicesGroup.style.display = "block";
	            otherServicesTextarea.setAttribute("required", "required");
	        } else {
	            otherServicesGroup.style.display = "none";
	            otherServicesTextarea.removeAttribute("required");
	        }
	    }
	</script>





