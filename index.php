<?php include "inc/header.php"; ?>

    <!-- All book section start -->
    <section class="all-books">
        <div class="container">
            <div class="row">
                <!-- Books content Start -->
                <div class="col-lg-9">
                    <h2 class="books-heading"> Our All Books Collection</h2>
                    <div class="row">
                        <?php 
                            $sql = "SELECT * FROM books WHERE status = 1 ORDER BY title ASC";
                            $allBooks = mysqli_query($db, $sql);
                            $totalBooks = mysqli_num_rows($allBooks);

                            if ( $totalBooks <= 0){ ?>
                                <div class="alert alert-info ">
                                    Opps No Books Found Yet!!!!
                                </div>
                            <?php }
                            else {
                                while( $row = mysqli_fetch_assoc( $allBooks ))
                                {
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

                                    <div class="col-lg-4 book-item">
                                        <div class="book-thumbnail">
                                            <?php
                                                if (!empty($image)) { ?>
                                                    <img src="admin/dist/img/books/<?php echo $image; ?>" class="img-fluid">
                                                <?php } else { ?>
                                                    <img src="dist/img/books/avatar5.png" class="img-fluid">
                                                <?php }
                                            ?>
                                            <div class="author-info">
                                                <?php echo $author_name;?>
                                            </div>
                                        </div>
                                        <div class="book-info">
                                            <h3><?php echo $title; ?></h3>
                                            <p class="quantity" > Quantity: <span><?php echo $quantity; ?> PCs</span></p>
                                            
                                            <p><?php echo substr($description, 0, 60) ?>.... <a href="#">Read More</a></p>

                                            <a href="#" class="book-btn">Book Now</a>
                                        </div>
                                    </div>

                                <?php }
                            }
                        
                        ?>
                        
                    </div>
                </div>
                <!-- Books content end -->

                <!-- Sidebar Start -->
                <?php include "inc/sidebar.php" ?>
                <!-- Sidebar end  -->
            </div>
        </div>
    </section>
    <!-- All book section end -->



<?php include "inc/footer.php"; ?>