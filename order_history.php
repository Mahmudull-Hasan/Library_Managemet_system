<?php include "inc/header.php"; ?>

    <section class="booking-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <h2>Booking History</h2>

                    <?php 
                        if ( !empty($_SESSION['msg'])) { ?>
                            <span class="alert alert-info"> <?php echo $_SESSION['msg']; ?> </span>
                       <?php }
                    ?>

                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Book Name</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Receive Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 
                                if ( $_SESSION['user_id'])
                                {
                                    $user_id      =  $_SESSION['user_id'];

                                    $sql                = "SELECT * FROM booking_list WHERE user_id= '$user_id' ORDER BY id ASC";
                                    $allBookingList     = mysqli_query($db, $sql);

                                    $numberCount = mysqli_num_rows($allBookingList);
                                    $i = 0;
                                    if ( $numberCount <= 0 )
                                    { ?>
                                        <span class="alert alert-info">No booking list found yet...</span>
                                    <?php }
                                    else {
                                        while ( $row = mysqli_fetch_assoc($allBookingList))
                                        {
                                            $id             = $row['id'];
                                            $book_id        = $row['book_id'];
                                            $user_id        = $row['user_id'];
                                            $rcv_date       = $row['rcv_date'];
                                            $rtn_date       = $row['rtn_date'];
                                            $booking_date   = $row['booking_date'];
                                            $status         = $row['status'];
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i ;?></td>
                                                <td>
                                                    <?php 
                                                        $sql = "SELECT * FROM books WHERE id='$book_id'";
                                                        $theBook = mysqli_query($db, $sql);

                                                        while ( $row = mysqli_fetch_assoc($theBook))
                                                        {
                                                            $title = $row['title'];
                                                            echo $title;
                                                        }
                                                    ;?>
                                                </td>
                                                <td><?php echo $booking_date ;?></td>
                                                <td><?php echo $rcv_date ;?></td>
                                                <td><?php echo $rtn_date ;?></td>
                                                <td>
                                                    <?php 
                                                        if( $status == 1){ ?>
                                                            <span class="badge bg-success">Book Activated</span>
                                                        <?php }
                                                        else if ($status == 2) { ?>
                                                            <span class="badge bg-info">Book Returned</span>
                                                        <?php }
                                                        else if ($status == 3 ) { ?>
                                                            <span class="badge bg-danger">Book Canceled</span>
                                                        <?php }
                                                        else if ($status == 4 ) { ?>
                                                            <span class="badge bg-warning">Book Pending</span>
                                                        <?php }
                                                
                                                    ?>
                                                </td>
                                                <td>
                                                    Edit
                                                </td>
                                            </tr>  
                                        <?php }
                                    }
                                }
                            ?>
                                                                  
                        </tbody>
                    </table>

                </div>


                <!-- Sidebar Start -->
                <?php include "inc/sidebar.php" ?>
                <!-- Sidebar end  -->
            </div>
        </div>
    </section>

    <?php unset($_SESSION['msg'])?>


<?php include "inc/footer.php"; ?>