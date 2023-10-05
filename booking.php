<?php include "inc/header.php"; ?>

    <section class="booking-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <?php 

                        if ( isset($_GET['id'])){

                            $theBookId  = $_GET['id'];
                            $sql        = "SELECT * FROM books WHERE id ='$theBookId'";
                            $BookData   = mysqli_query($db, $sql);
                            while( $row = mysqli_fetch_assoc($BookData)){
                                 
                                $id         = $row['id'];
                                $title      = $row['title'];
                                $quantity   = $row['quantity'];
                            }
                            if ( $quantity <= 0 ){ ?>
                                <span class="alert alert-info text-center">Sorry!!! This Book is not available now for booking purpose. Please check back Later Thank You</span>
                            <?php }

                            else { ?>
                                <h2>Please Fillup Information for the Booking confirmation</h2>

                            <?php 
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT * FROM users WHERE user_id='$user_id'";
                                $userData = mysqli_query($db, $query);

                                while( $row = mysqli_fetch_array($userData)){

                                    $fullname   = $row['fullname'];
                                    $email      = $row['email'];
                                    $phone      = $row['phone'];
                                    $address    = $row['address'];
                                 ?>
                                    <div class="user-info">
                                        <table class="table table-hover table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Phone No.</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                </tr>                                        
                                            </tbody>
                                        </table>
                                    </div>

                                    <form action="" method="POST" class="booking-form">
                                        <div class="row">

                                            <div class="col-lg-6 offset-lg-3">

                                                <div class="mb-3">
                                                    <label for=""> Receive Date : </label>
                                                    <input type="text" id="datepicker" name="rcv_date" class="form-control" placeholder="Please Input the date for Receive the Book" autocomplete="off" required="required">
                                                </div>
                                                <div class="mb-3">
                                                    <label for=""> Return Date :</label>
                                                    <input type="text" id="rtndatepicker"  name="rtn_date" class="form-control" placeholder="Please Input the date for Return the Book" autocomplete="off" required="required">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="hidden" name="book_id" value="<?php echo $theBookId; ?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                    <input type="submit" name="placeOrder" value="Procced The Book" class="book-btn">
                                                </div>

                                            </div>
                                        </div>
                                    </form>

                            <?php 

                                if ( isset($_POST['placeOrder']))
                                {
                                    $book_id        = $_POST['book_id'];
                                    $user_id        = $_POST['user_id'];
                                    $rcv_date       = date('Y-m-d', strtotime($_POST['rcv_date']) );
                                    $rtn_date       = date('Y-m-d', strtotime($_POST['rtn_date']) );

                                    if ( !empty( $rcv_date) && !empty( $rtn_date))
                                    {
                                        $sql = "INSERT INTO booking_list (book_id, user_id,	rcv_date, rtn_date,	booking_date) VALUES ('$book_id', '$user_id', '$rcv_date', '$rtn_date', now())";

                                        $booking_confirmation = mysqli_query($db, $sql);

                                        $_SESSION['msg'] = 'Your booking is pending for admin approval. Please contact with the library admin physically receive the book';

                                        if ($booking_confirmation)
                                        {
                                            header("Location: order_history.php ");
                                        }
                                        else {
                                            die("MYSQLi Error." . mysqli_error($db));
                                        }
                                    }
                                }
                        
                        
                                }
                            }
                        }
                                           
                    ?>



                </div>

                <!-- Sidebar Start -->
                 <?php include "inc/sidebar.php" ?>
                <!-- Sidebar end  -->
            </div>
        </div>
    </section>


<?php include "inc/footer.php"; ?>