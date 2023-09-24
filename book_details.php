<?php include "inc/header.php"; ?>

    <!-- book details section start -->
        <section class="all-books">
                <div class="container">
                    <div class="row">

                    <!-- Book details start -->
                        <div class="col-lg-4">
                            <?php
                                if ( isset($_GET['b'])){
                                    $book_id = $_GET['b'];
                                    $sql = "SELECT * FROM books WHERE id='$book_id'";
                                    $b_details = mysqli_query($db, $sql);

                                    while( $row = mysqli_fetch_assoc($b_details)){
                                        $id             = $row['id'];
                                        $title          = $row['title'];
                                        $sub_title      = $row['sub_title'];
                                        $description    = $row['description'];
                                        $cat_id         = $row['cat_id'];
                                        $author_name    = $row['author_name'];
                                        $quantity       = $row['quantity'];
                                        $image          = $row['image'];
                                        $status         = $row['status'];
                                        ?>

                                        <div class="book-thumbnail">
                                            <?php
                                                if (!empty($image)) { ?>
                                                    <img src="admin/dist/img/books/<?php echo $image; ?>" class="img-fluid">
                                                <?php } else { ?>
                                                    <img src="admin/dist/img/books/book-one.png" class="img-fluid">
                                                <?php }
                                            ?>
                                        </div>

                                   <?php }
                                }
                            ?>
                        </div>

                        <div class="col-lg-5 book-details" >
                            <h4><?php echo $title; ?></h4>
                            <p class="sub_title"><?php echo $sub_title;?></p>
                            <p class="quantity" > Quantity: <span><?php echo $quantity; ?> PCs</span></p>
                            <h6 style="font-weight: 600;">Written By:- <?php echo $author_name;?></h6>
                            <p> <?php echo $description;?></p>
                            <?php 
                                if ( empty($_SESSION['email']))
                                { ?>
                                    <a href="#" class="book-btn"> Login to Reserve Your Book</a>
                               <?php }
                               else{ ?>
                                    <a href="#" class="book-btn"> Book Now </a>
                              <?php }
                            
                            ?>
                        </div>
                    <!-- Book details end -->


                    <!-- Sidebar Start -->
                    <?php include "inc/sidebar.php" ?>
                    <!-- Sidebar end  -->

                    </div>                    
                </div>
        </section>
    <!-- book details section start -->

<?php include "inc/footer.php"; ?>

