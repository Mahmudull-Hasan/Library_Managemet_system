<?php include "inc/header.php"; ?>

<!-- Content Wrapper start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Order List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mange All order list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <!-- card-start -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mange All order list</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <!-- card body start -->
                        <div class="card-body">
                            <?php 
                                $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

                                if ( $do == 'Manage') { ?>
                                    <table id="datasearch" class="table table-hover table-bordered table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sl No.</th>
                                                <th scope="col">Book Name</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Receive Date</th>
                                                <th scope="col">Return Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            
                                            <?php 
                                                $sql                = "SELECT * FROM booking_list ORDER BY id DESC";
                                                $allBookingList     = mysqli_query($db, $sql);
                                                $i = 0;

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
                                                        <td><?php echo $i;?></td>
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
                                                        <td>
                                                            <?php 
                                                                $sql = "SELECT * FROM users WHERE user_id='$user_id'";
                                                                $theUser = mysqli_query($db, $sql);

                                                                while ( $row = mysqli_fetch_assoc($theUser))
                                                                {
                                                                    $fullname = $row['fullname'];
                                                                    echo $fullname;
                                                                }
                                                            ;?>
                                                        </td>
                                                        <td><?php echo $booking_date;?></td>
                                                        <td>
                                                            <span class="badge bg-success"><?php echo $rcv_date;?> </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info"><?php echo $rtn_date;?> </span>
                                                        </td>
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
                                                            <div class="table-action">
                                                                <ul>
                                                                    <li><a href="order-details.php?do=Edit&o_id=<?php echo $id; ?>"><i class="fa fa-edit"></i></a></li>

                                                                    <li><a href="" data-toggle="modal" data-target="#orderID<?php echo $cat_id; ?>"><i class="fa fa-trash"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php  }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php }
                                else if( $do == 'Edit')
                                {
                                    if ( isset($_GET['o_id']) ){

                                        $order_id = $_GET['o_id'];

                                        $sql            = "SELECT * FROM booking_list WHERE id='$order_id'";
                                        $orderData      = mysqli_query($db, $sql);
                                        while( $row = mysqli_fetch_assoc($orderData)){
                                            $id             = $row['id'];
                                            $book_id        = $row['book_id'];
                                            $user_id        = $row['user_id'];
                                            $rcv_date       = $row['rcv_date'];
                                            $rtn_date       = $row['rtn_date'];
                                            $booking_date   = $row['booking_date'];
                                            $status         = $row['status'];
                                            ?>
                                            <form action="order-details.php?do=Update" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="">Book Name</label>
                                                                <?php 
                                                                    $sql = "SELECT * FROM books WHERE id='$book_id'";
                                                                    $theBook = mysqli_query($db, $sql);

                                                                    while ( $row = mysqli_fetch_assoc($theBook))
                                                                    {
                                                                        $title = $row['title'];
                                                                        echo $title;
                                                                    }
                                                                ;?>
                                                            <input type="text" name="book_title" class="form-control" autocomplete="off" required="required" value="<?php echo $title; ?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">User Name</label>
                                                            <?php 
                                                                $sql = "SELECT * FROM users WHERE user_id='$user_id'";
                                                                $theUser = mysqli_query($db, $sql);

                                                                while ( $row = mysqli_fetch_assoc($theUser))
                                                                {
                                                                    $fullname = $row['fullname'];
                                                                    echo $fullname;
                                                                }
                                                            ;?>
                                                            <input type="text" name="user_name" class="form-control" autocomplete="off" required="required" value="<?php echo $fullname; ?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Booking Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="4">Please select booking status</option>
                                                                <option value="1" <?php if ($status == 1) {echo "selected";} ?> >Active</option>
                                                                <option value="2" <?php if ($status == 2) {echo "selected";} ?> >Returned</option>
                                                                <option value="3" <?php if ($status == 3) {echo "selected";} ?> >Cancel</option>
                                                                <option value="4" <?php if ($status == 4) {echo "selected";} ?> >Pending</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="">Receive Date</label>
                                                            <input id="datepicker" type="text" name="rcv_date" class="form-control" autocomplete="off" required="required" value="<?php echo $rcv_date; ?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Return Date</label>
                                                            <input id="rtndatepicker" type="text" name="rtn_date" class="form-control" autocomplete="off" required="required" value="<?php echo $rtn_date; ?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="order_id" value="<?php echo $id; ?> ">
                                                            <input type="hidden" name="book_id" value="<?php echo $book_id; ?> ">
                                                            <input class="btn btn-success" type="submit" name="UpdateOrder" value="Save Changes">
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        <?php }
                                    }
                                }
                                else if ( $do == 'Update'){
                                    
                                    if ( isset($_POST['UpdateOrder']))
                                    {
                                        $order_id       = $_POST['order_id'];
                                        $book_id        = $_POST['book_id'];
                                        $rcv_date       = date('Y-m-d', strtotime($_POST['rcv_date']) );
                                        $rtn_date       = date('Y-m-d', strtotime($_POST['rtn_date']) );
                                        $status         = $_POST['status'];

                                        if ($status == 1)
                                        {
                                            $sql = "UPDATE booking_list SET rcv_date='$rcv_date', rtn_date='$rtn_date', status='$status' WHERE id = $order_id";

                                            $update_order_details = mysqli_query($db, $sql);
    
                                            //Update the quantity of the Order book
                                            $query = "SELECT * FROM books WHERE id = '$book_id'";
                                            $book_data = mysqli_query($db, $query);
                                            while ( $row = mysqli_fetch_assoc($book_data))
                                            {
                                                $quantity = $row['quantity'];
                                                $quantity--;
                                            }
                                            $query2 = "UPDATE books SET quantity='$quantity' WHERE id='$book_id'";
    
                                            $update_book_data = mysqli_query($db, $query2);
                                            if ($update_book_data)
                                            {
                                                header("Location: order-details.php?do=Manage");
                                            } 
                                            else {
                                                die("MYSQLi Error." . mysqli_error($db));
                                            }
                                        }
                                        else if ($status == 2)
                                        {
                                            $sql = "UPDATE booking_list SET rcv_date='$rcv_date', rtn_date='$rtn_date', status='$status' WHERE id = $order_id";

                                            $update_order_details = mysqli_query($db, $sql);
    
                                            //Update the quantity of the Order book
                                            $query = "SELECT * FROM books WHERE id = '$book_id'";
                                            $book_data = mysqli_query($db, $query);
                                            while ( $row = mysqli_fetch_assoc($book_data))
                                            {
                                                $quantity = $row['quantity'];
                                                $quantity++;
                                            }
                                            $query2 = "UPDATE books SET quantity='$quantity' WHERE id='$book_id'";
    
                                            $update_book_data = mysqli_query($db, $query2);
                                            if ($update_book_data)
                                            {
                                                header("Location: order-details.php?do=Manage");
                                            } 
                                            else {
                                                die("MYSQLi Error." . mysqli_error($db));
                                            }
                                        }
                                    }
                                }
                            ?>


                        </div>
                        <!-- card body end -->
                    </div>  
                    <!-- card-end -->

                </div>
            </div>
        </div>
    </section>

</div>
<!-- Content Wrapper end -->
<?php include "inc/footer.php"; ?>