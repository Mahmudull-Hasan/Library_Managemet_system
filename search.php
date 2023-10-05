<?php include "inc/header.php"; ?>

        <!-- book details section start -->
        <section class="all-books">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-9">
                            <h2>Search Result-</h2>
                            <div class="row">
                                <?php 
                                    if( $_POST['searchBtn']){

                                        $sContent = $_POST['search'];

                                        $sql = "SELECT * FROM  books WHERE title LIKE '%$sContent%' OR description LIKE '%$sContent%' OR author_name LIKE '%$sContent%' ORDER BY title ASC";
                                        
                                        $readData = mysqli_query($db, $sql);
                                        $foundTotal = mysqli_num_rows($readData);

                                        if ( $foundTotal == 0 ){ ?>
                                            <div class="alert alert-info">
                                                Sorry!!! No Book Found In Our Library. Reading Your Search Topic:- <strong><?php echo $sContent; ?></strong>
                                            </div>
                                        <?php }
                                        else{
                                            while ( $row = mysqli_fetch_assoc($readData)){

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
                                                                <img src="admin/dist/img/books/avatar5.png" class="img-fluid">
                                                            <?php }
                                                        ?>
                                                        <div class="author-info">
                                                            <?php echo $author_name;?>
                                                        </div>
                                                    </div>
                                                    <div class="book-info">
                                                        <h3><?php echo $title; ?></h3>
                                                        <p class="quantity" > Quantity: <span><?php echo $quantity; ?> PCs</span></p>
                                                        
                                                        <p><?php echo substr($description, 0, 60) ?>.... <a href="book_details.php?b=<?php echo $id; ?>">Read More</a></p>

                                                        <a href="#" class="book-btn">Book Now</a>
                                                    </div>
                                                </div>
                                        <?php }
                                        }
                                    }
                                ?>

                            </div>
                        </div>

                        <!-- Sidebar Start -->
                        <?php include "inc/sidebar.php" ?>
                        <!-- Sidebar end  -->

                    </div>
                </div>
        </section>

<?php include "inc/footer.php"; ?>