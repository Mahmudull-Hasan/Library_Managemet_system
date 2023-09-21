<?php include "inc/header.php"; ?>

<!-- Content Wrapper start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">All User Management</li>
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

                    <?php
                    // Ternary condition
                    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

                    if ($do == 'Manage') {
                    ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Users</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <!-- card body start -->
                            <div class="card-body">
                                <table class="table table-striped table-dark table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#Sl</th>
                                            <th scope="col">Picture</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email address</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">User Role</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM users ORDER BY fullname ASC";
                                        $data = mysqli_query($db, $sql);
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $user_id    = $row['user_id'];
                                            $fullname   = $row['fullname'];
                                            $email      = $row['email'];
                                            $password   = $row['password'];
                                            $phone      = $row['phone'];
                                            $address    = $row['address'];
                                            $image      = $row['image'];
                                            $role       = $row['role'];
                                            $status     = $row['status'];
                                            $join_date  = $row['join_date'];
                                            $i++;
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td>
                                                    <?php
                                                    if (!empty($image)) { ?>
                                                        <img src="dist/img/users/<?php echo $image; ?>" width="35">
                                                    <?php } else { ?>
                                                        <img src="dist/img/avatar5.png" width="35">
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td><?php echo $fullname; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $phone; ?></td>
                                                <td>
                                                    <?php
                                                    if ($role == 1) { ?>
                                                        <span class="badge badge-success">Admin</span>
                                                    <?php
                                                    } else if ($role == 2) { ?>
                                                        <span class=" badge badge-primary">User</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($status == 1) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php
                                                    } else if ($status == 0) { ?>
                                                        <span class=" badge badge-danger">Inactive</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="table-action">
                                                        <ul>
                                                            <li><a href="users.php?do=Edit&uid=<?php echo $user_id; ?>"><i class="fa fa-edit"></i></a></li>

                                                            <li><a href="" data-toggle="modal" data-target="#delUser<?php echo $user_id; ?>"><i class="fa fa-trash"></i></a></li>
                                                        </ul>
                                                        <!-- Modar Start -->
                                                        <div class="modal fade" id="delUser<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete Your Account</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="modal-buttons">
                                                                            <ul>
                                                                                <li>
                                                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="users.php?do=Delete&did=<?php echo $user_id; ?>" class="btn btn-danger">Confirm</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal end -->
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>

                            </div>

                            <!-- card-end -->
                        </div>

                    <?php
                    } else if ($do == 'Add') {
                    ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New user</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" name="fullname" required="required" placeholder="Your Full Name" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="email" name="email" placeholder="Your Email" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="Your Password" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label>Re Type Password</label>
                                                <input class="form-control" type="password" name="repassword" placeholder="Your Re-Type Password" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input class="form-control" type="text" name="phone" placeholder="Your Phone Number">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="form-control" type="text" name="address" placeholder="Your Address">
                                            </div>

                                            <div class="form-group">
                                                <label>User Role</label>
                                                <select class="form-control" name="role">
                                                    <option value="2">Please Select User Role</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">User</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="0">Please Select User Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Profile Picture</label>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success" name="AddUser" value="Save Changes">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                    } else if ($do == 'Store') {

                        if (isset($_POST['AddUser'])) {

                            $fullname           = $_POST['fullname'];
                            $email              = $_POST['email'];
                            $password           = $_POST['password'];
                            $repassword         = $_POST['repassword'];
                            $phone              = $_POST['phone'];
                            $address            = $_POST['address'];
                            $role               = $_POST['role'];
                            $status             = $_POST['status'];

                            $image              = $_FILES['image']['name'];
                            $image_temp         = $_FILES['image']['tmp_name'];

                            if ($password == $repassword) {
                                $hassedPass = sha1($password);

                                if (!empty($image)) {

                                    $image_name = rand(1, 999999) . '_' . $image;
                                    move_uploaded_file($image_temp, "dist/img/users/$image_name");

                                    $sql = "INSERT INTO users (fullname, email,	password, phone, address, image, role, status, join_date ) VALUES('$fullname', '$email', '$hassedPass', '$phone', '$address', '$image_name', '$role', '$status', now() )";



                                    $addUser = mysqli_query($db, $sql);
                                    if ($addUser) {
                                        header("Location: users.php?do=Manage");
                                    } else {
                                    }
                                } else {

                                    $sql = "INSERT INTO users (fullname, email,	password, phone, address, role, status, join_date ) VALUES('$fullname', '$email', '$hassedPass', '$phone', '$address', '$role', '$status', now() )";

                                    $addUser = mysqli_query($db, $sql);

                                    if ($addUser) {
                                        header("Location: users.php?do=Manage");
                                    } else {
                                        die("MYSQLi Error. " . mysqli_error($db));
                                    }
                                }

                                echo "password Doesn't Match";
                            }
                        }
                    } else if ($do == 'Edit') {

                        if (isset($_GET['uid'])) {
                            $updateID = $_GET['uid'];
                            $sql = "SELECT * FROM users WHERE user_id ='$updateID'";

                            $userData = mysqli_query($db, $sql);

                            while ($row = mysqli_fetch_assoc($userData)) {

                                $user_id    = $row['user_id'];
                                $fullname   = $row['fullname'];
                                $email      = $row['email'];
                                $password   = $row['password'];
                                $phone      = $row['phone'];
                                $address    = $row['address'];
                                $image      = $row['image'];
                                $role       = $row['role'];
                                $status     = $row['status'];
                                $join_date  = $row['join_date'];
                        ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Update user Information</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input class="form-control" type="text" name="fullname" required="required" placeholder="Your Full Name" value="<?php echo $fullname; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" type="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" type="password" name="password" placeholder="xxxxxx">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Re Type Password</label>
                                                        <input class="form-control" type="password" name="repassword" placeholder="xxxxxx">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input class="form-control" type="text" name="phone" placeholder="Your Phone Number" value="<?php echo $phone; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input class="form-control" type="text" name="address" placeholder="Your Address" value="<?php echo $address; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>User Role</label>
                                                        <select class="form-control" name="role">
                                                            <option value="2">Please Select User Role</option>
                                                            <option value="1" <?php if ($role  == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Admin</option>
                                                            <option value="2" <?php if ($role  == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>User</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="0">Please Select User Status</option>
                                                            <option value="0" <?php if ($status == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Inactive</option>
                                                            <option value="1" <?php if ($status == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Active</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Profile Picture</label>
                                                        <br>
                                                        <?php
                                                        if (!empty($image)) { ?>
                                                            <img src="dist/img/users/<?php echo $image; ?>" width="35">
                                                        <?php } else { ?>
                                                            <h6>No Picture Uploaded!</h6>
                                                        <?php }
                                                        ?>
                                                        <br>
                                                        <br>
                                                        <input type="file" name="image" class="form-control-file">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                        <input type="submit" class="btn btn-success" name="updateUser" value="Save Changes">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } else if ($do == 'Update') {
                        if (isset($_POST['updateUser'])) {
                            $user_id            = $_POST['user_id'];
                            $fullname           = $_POST['fullname'];
                            $email              = $_POST['email'];
                            $password           = $_POST['password'];
                            $repassword         = $_POST['repassword'];
                            $phone              = $_POST['phone'];
                            $address            = $_POST['address'];
                            $role               = $_POST['role'];
                            $status             = $_POST['status'];

                            $image              = $_FILES['image']['name'];
                            $image_temp         = $_FILES['image']['tmp_name'];

                            //Both for password and picture with all data change 
                            if (!empty($password) && !empty($image)) {

                                //New Password encrypted
                                if ($password == $repassword) {
                                    $hassedPass = sha1($password);
                                }

                                //Delete exists image for users
                                $query = "SELECT * FROM users WHERE user_id='$user_id'";
                                $old_image = mysqli_query($db, $query);

                                while ($row = mysqli_fetch_assoc($old_image)) {

                                    $exists_image = $row['image'];
                                    unlink("dist/img/users/" . $exists_image);
                                }

                                //New Uploaded Image
                                $image_name = rand(1, 999999) . '_' . $image;
                                move_uploaded_file($image_temp, "dist/img/users/$image_name");

                                $sql = "UPDATE users SET fullname='$fullname', email='$email', password='$hassedPass', phone='$phone', address='$address', image='$image_name', role='$role', status='$status' WHERE user_id='$user_id'";

                                $updateUser = mysqli_query($db, $sql);
                                if ($updateUser) {
                                    header("Location: users.php?do=Manage");
                                } else {
                                    die("MYSQLi Error. " . mysqli_error($db));
                                }
                            }

                            //Only Password with all data change 
                            else if (!empty($password) && empty($image)) {

                                //New Password encrypted
                                if ($password == $repassword) {
                                    $hassedPass = sha1($password);
                                }


                                $sql = "UPDATE users SET fullname='$fullname', email='$email', password='$hassedPass', phone='$phone', address='$address', role='$role', status='$status' WHERE user_id='$user_id'";

                                $updateUser = mysqli_query($db, $sql);
                                if ($updateUser) {
                                    header("Location: users.php?do=Manage");
                                } else {
                                    die("MYSQLi Error. " . mysqli_error($db));
                                }
                            }

                            //Only Picture with all data change 
                            else if (empty($password) && !empty($image)) {


                                //Delete exists image for users
                                $query = "SELECT * FROM users WHERE user_id='$user_id'";
                                $old_image = mysqli_query($db, $query);

                                while ($row = mysqli_fetch_assoc($old_image)) {

                                    $exists_image = $row['image'];
                                    unlink("dist/img/users/" . $exists_image);
                                }

                                //New Uploaded Image
                                $image_name = rand(1, 999999) . '_' . $image;
                                move_uploaded_file($image_temp, "dist/img/users/$image_name");

                                $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', address='$address', image='$image_name', role='$role', status='$status' WHERE user_id='$user_id'";

                                $updateUser = mysqli_query($db, $sql);
                                if ($updateUser) {
                                    header("Location: users.php?do=Manage");
                                } else {
                                    die("MYSQLi Error. " . mysqli_error($db));
                                }
                            }


                            //Only change for data
                            else if (empty($password) && empty($image)) {

                                $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', address='$address', role='$role', status='$status' WHERE user_id='$user_id'";

                                $updateUser = mysqli_query($db, $sql);
                                if ($updateUser) {
                                    header("Location: users.php?do=Manage");
                                } else {
                                    die("MYSQLi Error. " . mysqli_error($db));
                                }
                            }
                        }
                    } else if ($do == 'Delete') {
                        if (isset($_GET['did'])) {
                            $deleteID = $_GET['did'];

                            $query = "DELETE FROM users WHERE user_id ='$deleteID'";
                            $deleteUser   = mysqli_query($db, $query);

                            if ($deleteUser) {
                                header("Location: users.php?do=Manage");
                            } else {
                                die("MYSQLi Error. " . mysqli_error($db));
                            }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

</div>
<!-- Content Wrapper end -->
<?php include "inc/footer.php"; ?>