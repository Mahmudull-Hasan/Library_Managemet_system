<?php include "inc/header.php"; ?>

    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">

                    <h2>Member Login</h2>
                    <form action="" method="POST">

                        <div class="mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" required="required" autocomplete="off" class="form-control" placeholder="Email Address">
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" required="required" autocomplete="off" class="form-control" placeholder="Your Password">
                        </div>

                        <div class="mb-3 d-grid">
                            <input type="submit" name="login"  class="btn btn-primary" value="Login">
                        </div>
                    </form>

                    <?php 
                        if( isset($_POST['login']))
                        {
                        //Get the data from user
                        $email    = mysqli_real_escape_string($db, $_POST['email']);
                        $password = mysqli_real_escape_string($db, $_POST['password']);

                        if( !empty($password))
                        {
                            $hassedPass = sha1($password);
                        }

                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $userData = mysqli_query($db, $sql);


                        while( $row = mysqli_fetch_assoc($userData))
                        {
                            $_SESSION['user_id']    = $row['user_id'];
                            $fullname               = $row['fullname'];
                            $_SESSION['email']      = $row['email'];
                            $password               = $row['password'];
                            $phone                  = $row['phone'];
                            $address                = $row['address'];
                            $image                  = $row['image'];
                            $_SESSION['role']       = $row['role'];
                            $status                 = $row['status'];
                            $join_date              = $row['join_date'];

                            

                            if( $email == $_SESSION['email'] && $hassedPass == $password)
                            {
                                header("Location: index.php");
                            }
                            else if( $email != $_SESSION['email'] || $hassedPass != $password)
                            {
                                header("Location: index.php");
                            }
                            else {
                                header("Location: index.php"); 
                            }

                            }
                        }
                    ?>

                    <div class="login-option">
                        <ul>
                            <li> Not a Member? <a href="Register.php">Sign Up Here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include "inc/footer.php"; ?>

