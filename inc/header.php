<?php 
    ob_start();
    session_start();
    include "admin/inc/db.php" 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bootstrap demo</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Custom Css code -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">


</head>

<body>

    <!-- Header section start -->
    <header class="header-section bg-body-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Nav Menu Start -->
                    <nav class="navbar navbar-expand-lg ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">Online Library </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Menu Item Start -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <?php 

                                        //Parent Category Menu
                                        $sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                                        $parentMenu = mysqli_query($db, $sql);

                                        while ( $row = mysqli_fetch_assoc($parentMenu)){
                                            extract($row);

                                            $subCat = "SELECT cat_id AS 'sCatID', cat_name AS 'sCatName' FROM category WHERE is_parent = '$pCatID' AND status= 1 ORDER BY cat_name ASC";

                                            $subMenu = mysqli_query($db, $subCat);
                                            $countSubMenu = mysqli_num_rows($subMenu);

                                            if( $countSubMenu == 0 ){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="category.php?category=<?php echo $pCatName; ?>"><?php echo $pCatName; ?></a>
                                                </li>
                                            <?php }

                                            else{ ?>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <?php echo $pCatName; ?>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <?php 
                                                            while( $row = mysqli_fetch_assoc($subMenu)){
                                                                extract($row);
                                                                ?>
                                                                <li><a class="dropdown-item" href="category.php?category=<?php echo $sCatName; ?>"><?php echo $sCatName; ?></a></li>
                                                            <?php }
                                                        ?>
                                                    </ul>
                                                </li>
                                            <?php }
                                        }                                    
                                    ?>

                                    <?php 
                                        if ( empty( $_SESSION['user_id']) || empty($_SESSION['email']) ){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="login.php">SignIn</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="register.php">SignUp</a>
                                            </li>
                                        <?php }
                                        else if ( $_SESSION['role'] == 2 ) { ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                <?php 
                                                    $user_id = $_SESSION['user_id'];
                                                    $query = "SELECT * FROM users WHERE user_id='$user_id'";
                                                    $userData = mysqli_query($db, $query);

                                                    while( $row = mysqli_fetch_assoc($userData)){

                                                        $fullname = $row['fullname'];
                                                        $image = $row['image'];

                                                        if ( !empty( $image)) { ?>
                                                            <img src="admin/dist/img/users/<?php echo $image;?>" class="img-circle elevation-2" alt="User Image">
                                                        <?php echo $fullname ; }
                                                        else{ ?>
                                                            <img src="admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                                       <?php echo $fullname ; }                                                   
                                                    
                                                    }            
                                                ?>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="order_history.php" class="dropdown-item"> Booking List </a></li>
                                                    <li><a href="" class="dropdown-item"> Manage Profile </a></li>
                                                    <li><a href="logout.php" class="dropdown-item"> Log Out </a></li>
                                                </ul>
                                            </li>
                                        <?php }
                                        else if( $_SESSION['role'] == 1) { ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                <?php 
                                                    $user_id = $_SESSION['user_id'];
                                                    $query = "SELECT * FROM users WHERE user_id='$user_id'";
                                                    $userData = mysqli_query($db, $query);

                                                    while( $row = mysqli_fetch_assoc($userData)){

                                                        $fullname = $row['fullname'];
                                                        $image = $row['image'];

                                                        if ( !empty( $image)) { ?>
                                                            <img src="admin/dist/img/users/<?php echo $image;?>" class="img-circle elevation-2" alt="User Image">
                                                        <?php echo $fullname ; }
                                                        else{ ?>
                                                            <img src="admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                                       <?php echo $fullname ; }                                                   
                                                    
                                                    }            
                                                ?>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="admin/dashboard.php" class="dropdown-item"> Dashboard </a></li>
                                                    <li><a href="" class="dropdown-item"> Manage Profile </a></li>
                                                    <li><a href="logout.php" class="dropdown-item"> Log Out </a></li>
                                                </ul>
                                            </li>
                                        <?php }
                                    ?>

                                    
                                </ul>
                            </div>
                            <!-- Menu Item end -->

                        </div>
                    </nav>
                    <!-- Nav Menu end -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header section end -->