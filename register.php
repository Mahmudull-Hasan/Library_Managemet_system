<?php include "inc/header.php"; ?>

    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">

                    <h2>Member Registration</h2>
                    <form action="" method="POST">

                        <div class="mb-3">
                            <label for="">Full Name</label>
                            <input type="text" name="fullname" required="required" autocomplete="off" class="form-control" placeholder="Your Full Name">
                        </div>

                        <div class="mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" required="required" autocomplete="off" class="form-control" placeholder="Email Address">
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" required="required" autocomplete="off" class="form-control" placeholder="Your Password">
                        </div>

                        <div class="mb-3">
                            <label for="">Re-type Password</label>
                            <input type="password" name="repassword" required="required" autocomplete="off" class="form-control" placeholder="Re-type Password">
                        </div>

                        <div class="mb-3 d-grid">
                            <input type="submit" name="register"  class="btn btn-primary" value="Register Now">
                        </div>
                    </form>

                    <div class="login-option">
                        <ul>
                            <li> Allready Register? <a href="login.php">Sign In Here</a></li>
                        </ul>
                    </div>

                    <?php 
                        if ( isset($_POST['register']))
                        {
                            $fullname       = $_POST['fullname'];
                            $email          = $_POST['email'];
                            $password       = $_POST['password'];
                            $repassword     = $_POST['repassword'];

                            if ($password  == $repassword)
                            {
                                $hassedpass = sha1($password);

                                $sql = "INSERT INTO users (fullname, email, password, join_date) VALUES ('$fullname', '$email', '$hassedpass', now() )";

                                $registerUser = mysqli_query($db, $sql);

                                if ( $registerUser)
                                {
                                    header("Location: login.php");
                                }
                                else {
                                    die("MYSQLi Error. " . mysqli_errno($db));
                                }
                            }

                            
                        }
                    ?>

                </div>
            </div>
        </div>
    </section>

<?php include "inc/footer.php"; ?>

