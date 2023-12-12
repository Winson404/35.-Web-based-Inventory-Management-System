<title>IMS | Category records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Category</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Category records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#add"><i class="fa-sharp fa-solid fa-square-plus"></i> New Category</button>
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <table id="example11" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr>
                    <th>Category name</th>
                    <th>Category description</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM category");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['cat_description']; ?></td>
                        <td> 
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['cat_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-pencil-alt"></i> Edit</button>
                            <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['cat_Id']; ?>" <?php if($u_type == 'Staff') { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                        </td> 
                    </tr>
                    <?php include 'category_update_delete.php'; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'category_add.php'; include '../includes/footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->