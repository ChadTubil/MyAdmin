<?php
  include 'db-controller.php';
  session_start();
  /* if(isset($_POST['btnLogin'])){
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];

    $sqlLogin = "SELECT * FROM users_tbl WHERE users_email = '$txtEmail' AND users_password = '$txtPassword' AND users_isdel = 0";
    $queryLogin = mysqli_query($dbConString, $sqlLogin);
    $numRowsLogin = mysqli_num_rows($queryLogin);

    if($numRowsLogin != 0){
      header("location: dashboard.php");
    }
  } */

  if(isset($_POST["btnLogin"])){
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];
    // $txtPassword = md5($txtPassword);

    $sqlLogin = "SELECT * FROM users_tbl WHERE users_email = '$txtEmail' AND users_password = '$txtPassword' AND users_isdel = 0";
    $queryLogin = mysqli_query($dbConString, $sqlLogin);
    $numRowsLogin = mysqli_num_rows($queryLogin);


    if($numRowsLogin != 0){
        $fetchLogin = mysqli_fetch_assoc($queryLogin);
        $_SESSION["users_id"] = $fetchLogin["users_id"];
        $_SESSION["users_firstname"] = $fetchLogin["users_firstname"];
        $_SESSION["users_lastname"] = $fetchLogin["users_lastname"];
        $_SESSION["users_middlename"] = $fetchLogin["users_middlename"];
        header("location:dashboard.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" onload="return usernameSetFocus();">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form role="form" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="txtEmail" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" placeholder="Password" name="txtPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btnLogin" 
            onclick="window.location.href='dashboard.php?=<?php print $fetchLogin['users_id'];?>'">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
