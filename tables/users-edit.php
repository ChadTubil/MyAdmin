<?php
  include '../db-controller.php';
  date_default_timezone_set("Asia/Manila");
  session_start();

  if(!(isset($_SESSION["users_id"]))) {
    header("location: ../index.php");
  }

  $id = $_GET['id'];
  $sqlUser = "SELECT * FROM users_tbl WHERE users_id=$id";
  $queryUser = mysqli_query($dbConString, $sqlUser);
  $fetchUser = mysqli_fetch_assoc($queryUser);

  if(isset($_POST['btnUpdate'])) {
    $txtFirstName = $_POST['Firstname'];
    $txtLastName = $_POST['Lastname'];
    $txtMiddleName = $_POST['Middlename'];
    $txtEmail = $_POST['Email'];
    $txtAddress = $_POST['Address'];
    $txtContact = $_POST['Contact'];
    $txtPassword = $_POST['Password'];
    $txtRPassword = $_POST['RPassword'];

    $sqlUpdate = "UPDATE users_tbl SET users_lastname='$txtLastName', users_firstname='$txtFirstName', 
    users_middlename='$txtMiddleName', users_email='$txtEmail', users_address='$txtAddress', users_Contact='$txtContact', 
    users_password='$txtPassword', users_rpassword='$txtRPassword' WHERE users_id=$id";
    mysqli_query($dbConString, $sqlUpdate);
    

    header("location: users.php");
    
  }

  if(isset($_POST['btnImageUpdate'])){
    // echo "Di ko pa alam pano mag update ng picture!!!!!";
    $edit_image = $_FILES["fileUpload"]['name'];

    $queryImageUpdate = "UPDATE users_tbl SET users_image = '$edit_image' WHERE users_id=$id";
    $queryRun = mysqli_query($dbConString, $queryImageUpdate);

    if($queryRun){
      move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "upload/".$_FILES["fileUpload"]["name"]);
      $_SESSION['success'] = "Image Updated";
      header('Location: users.php');
    }else{
      $_SESSION['status'] = "Image not Updated";
      header('Location: users.php');
    }

  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="../dist/img/AdminLTELogo.ico" type="image/x-icon" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../dashboard.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../idashboard" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          <img src="upload/<?php print $fetchUser["users_image"]?>" class="img-circle elevation-2" style="width: 40px; height: 40px;">
        </div>
        <div class="info">
          <a href="../profile.php" class="d-block"><?php print $fetchUser["users_firstname"]?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Inventory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/employees.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employees</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/categories.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/suppliers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suppliers|Brand Partners</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/products.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="positions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Positions</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Management</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Update</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="users.php">Users</a></li>
              <li class="breadcrumb-item active">User Update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update the following</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                  <label for="exampleInputLastname1">Last Name</label>
                    <input type="text" class="form-control"  name="Lastname" value="<?php print $fetchUser['users_lastname']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputFirstname1">First Name</label>
                    <input type="text" class="form-control" name="Firstname" value="<?php print $fetchUser['users_firstname']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputMiddlename1">Middle Name</label>
                    <input type="text" class="form-control"  name="Middlename" value="<?php print $fetchUser['users_middlename']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="Email" value="<?php print $fetchUser['users_email']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputAddress1">Address</label>
                    <input type="text" class="form-control" name="Address" value="<?php print $fetchUser['users_address']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputContact1">Contact</label>
                    <input type="text" class="form-control" name="Contact" value="<?php print $fetchUser['users_contact']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="Password" value="<?php print $fetchUser['users_password']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputRPassword1">Retype Password</label>
                    <input type="password" class="form-control"  name="RPassword" value="<?php print $fetchUser['users_rpassword']; ?>">
                  </div>
                  
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Image</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <br>
                    <div class="text-center">
                      <img src="upload/<?php print $fetchUser["users_image"]?>" class="img-circle elevation-2" style="width: 150px; height: 150px;">
                    </div>
                    <br>
                    <br>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="fileUpload" value="<?php print $fetchUser['users_image']; ?>">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button type="reset" class="input-group-text">Clear</button>
                        <button type="submit" name="btnImageUpdate" class="btn btn-primary">Update</button>
                        <!-- <span class="input-group-text">Clear</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>    
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
