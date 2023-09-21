<?php 
    ob_start();
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
                            <a class="navbar-brand" href="#">Online Library </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Menu Item Start -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">About</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    </li>
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