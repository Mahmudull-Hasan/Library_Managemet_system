<?php
  session_start();
  ob_start();
  include "inc/db.php";

  if( empty( $_SESSION['user_id']) || empty($_SESSION['email']))
  {
    header("Location: index.php");
  }
  else if ( $_SESSION['role'] == 2) {
    header("Location: logout.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <?php include "inc/css.php";?>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php include "inc/topbar.php" ;?>
  <?php include "inc/leftmenu.php";?>
