<?php 
  session_start();
  ob_start();
  include"inc/db.php";

  if( !empty( $_SESSION['user_id']) || !empty($_SESSION['email']) )
  {
    header("Location: dashboard.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Admintrator Log in </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email"class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password"class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" name="login" value="Sing In">
          </div>
        </div>
      </form>

      <?php 
        if( isset($_POST['login']))
        {
          //Get the data from user
          $email = $_POST['email'];
          $password = $_POST['password'];

          if( !empty($password))
          {
            $hassedPass = sha1($password);
          }

          $sql = "SELECT * FROM users WHERE email = '$email'";
          $userData = mysqli_query($db, $sql);


          while( $row = mysqli_fetch_assoc($userData))
          {
            $_SESSION['user_id']    = $row['user_id'];
            $fullname               = $row['fullname'];
            $_SESSION['email']      = $row['email'];
            $password               = $row['password'];
            $phone                  = $row['phone'];
            $address                = $row['address'];
            $image                  = $row['image'];
            $_SESSION['role']       = $row['role'];
            $status                 = $row['status'];
            $join_date              = $row['join_date'];

            if( $email == $_SESSION['email'] && $hassedPass == $password && $_SESSION['role'] == 1)
            {
              header("Location: dashboard.php");
            }
            else if( $email != $_SESSION['email'] || $hassedPass != $password || $_SESSION['role'] != 1 )
            {
              header("Location: index.php");
            }
            else{
              header("Location: index.php"); 
            }

          }
        }
      ?>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
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

<?php 
  ob_end_flush();
?>
</body>
</html>
