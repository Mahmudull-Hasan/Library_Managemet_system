<?php include "inc/header.php";?>

    <!-- Content Wrapper start -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Book's management</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Book's Management</li>
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

                                // All users Manage page
                                if($do == 'Manage')
                                {
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
                                                        <th scope="col">Thumbnail</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Sub Title</th>
                                                        <th scope="col">Author Name</th>
                                                        <th scope="col">Category Name</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    <?php 
                                                        $sql = "SELECT * FROM books ORDER BY title ASC";
                                                        $allData = mysqli_query( $db, $sql);

                                                        $numOfBooks = mysqli_num_rows($allData);

                                                        if( $numOfBooks == 0 )
                                                        { ?>
                                                            <div class="alert alert-info">
                                                                Opps!!! NO Book Found in our Library. Please Add a Book First
                                                            </div>
                                                        <?php }
                                                        else{

                                                            $i =0;
                                                            while( $row = mysqli_fetch_assoc($allData))
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
                                                                $i++;
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>
                                                                    <td>
                                                                        <?php 
                                                                            if(!empty($image)) {?>
                                                                                <img src="dist/img/books/<?php echo $image; ?>" width="35">
                                                                           <?php }
                                                                           else
                                                                           {?>
                                                                                <img src="dist/img/books/avatar5.png" width="35">
                                                                           <?php }
                                                                        ?>
                                                                    </td>
                                                                    
                                                                    <td><?php echo $title; ?></td>
                                                                    <td><?php echo $sub_title; ?></td>
                                                                    <td><?php echo $author_name; ?></td>
                                                                    <td>
                                                                        <?php 
                                                                            $sql = "SELECT * FROM category WHERE cat_id = '$cat_id'";
                                                                            $categoryName = mysqli_query($db, $sql);
                                                                            while( $row = mysqli_fetch_assoc($categoryName))
                                                                            {
                                                                                $cat_id = $row['cat_id'];
                                                                                $cat_name = $row['cat_name'];
                                                                                ?>
                                                                                <span class="badge badge-info"><?php echo $cat_name; ?></span>
                                                                            <?php }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $quantity; ?> Pcs </td>
                                                                    
                                                                    <td>
                                                                        <?php
                                                                            if( $status == 1 )
                                                                            {?>
                                                                                <span class= "badge badge-success">Active</span>
                                                                            <?php 
                                                                            }
                                                                            else if($status == 2 )
                                                                            {?>
                                                                                <span class=" badge badge-danger">Inactive</span>
                                                                            <?php 
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-action">
                                                                            <ul>
                                                                                <li><a href="books.php?do=Edit&uid=<?php echo $id;?>" ><i class="fa fa-edit"></i></a></li>
        
                                                                                <li><a href="" data-toggle="modal" data-target="#delUser<?php echo $user_id; ?>"><i class="fa fa-trash"></i></a></li>
                                                                            </ul>
                                                                            <!-- Modar Start -->
                                                                                <div class="modal fade" id="delUser<?php echo $user_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        }


                                                    ?>                                                
                                                    
                                                </tbody>
                                            </table>
    
                                        </div>
                                      
                                        <!-- card-end -->
                                    </div>
    
                                <?php
                                }


                                else if($do == 'Add')
                                {   
                                ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Register A New Book</h3>
                                        </div>
                                    
                                        <div class="card-body">
                                            <form action="books.php?do=Store"  method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input class="form-control" type="text" name="title"  required="required" placeholder="Title of the Book" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Sub Title</label>
                                                            <input class="form-control" type="text" name="sub_title" placeholder="Sub Title" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Author Name</label>
                                                            <input class="form-control" type="text" name="author" placeholder="Author Name" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input class="form-control" type="text" name="quantity" placeholder="Quantity" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select class="form-control" name="cat_id">
                                                                
                                                                <?php 
                                                                    $sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
                                                                    $parentCat = mysqli_query($db, $sql);
                                                                    while ( $row = mysqli_fetch_assoc($parentCat))
                                                                    {
                                                                        $p_cat_id          = $row['cat_id'];
                                                                        $p_cat_name        = $row['cat_name'];
                                                                        ?>
                                                                            <option value="<?php echo $p_cat_id; ?>"><?php echo $p_cat_name; ?></option>
                                                                        <?php

                                                                        $query = "SELECT * FROM category WHERE is_parent = '$p_cat_id' ORDER BY cat_name ASC";
                                                                        $childCat = mysqli_query($db, $query);
                                                                        while( $row = mysqli_fetch_assoc($childCat)){
                                                                            $c_cat_id          = $row['cat_id'];
                                                                            $c_cat_name        = $row['cat_name'];

                                                                            ?>
                                                                            <option value="<?php echo $c_cat_id; ?>"> __ <?php echo $c_cat_name; ?></option>
                                                                      <?php  }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="status">
                                                                <option value="0">Please Select User Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="2">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" id="description" name="description" rows="30"></textarea>
                                                        </div>

                                                        

                                                        <div class="form-group">
                                                            <label for="">Book Thumbnail</label>
                                                            <input type="file" name="image" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-success" name="addBook" value="Register the book">
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                                }


                                else if ( $do == 'Store'){
                                    if ( isset ( $_POST['addBook']))
                                    {
                                        $title          = $_POST['title'];
                                        $sub_title      = $_POST['sub_title'];
                                        $author         = $_POST['author'];
                                        $quantity       = $_POST['quantity'];
                                        $cat_id         = $_POST['cat_id'];
                                        $description    = $_POST['description'];
                                        $status         = $_POST['status'];

                                        $image              = $_FILES['image']['name'];
                                        $image_temp         = $_FILES['image']['tmp_name'];

                                        if(!empty($image))
                                        {
                                                
                                            $image_name = rand(1, 999999) . '_' . $image;
                                            move_uploaded_file($image_temp, "dist/img/books/$image_name");

                                            $sql ="INSERT INTO books (title,	sub_title, description, cat_id, author_name, quantity, 	image, status ) VALUES ('$title', '$sub_title', '$description ', '$cat_id', '$author', '$quantity', '$image_name', '$status')";

                                            $registerBook = mysqli_query($db, $sql);

                                            if($registerBook){
                                                header("Location: books.php?do=Manage");
                                            }
                                            else {
                                                die("MYSQLi Error." . mysqli_error($db));
                                            }
                                        }
                                        else 
                                        {

                                            $sql ="INSERT INTO book (title,	sub_title, description, cat_id, author_name, quantity, status ) VALUES ('$title', '$sub_title', '$description ', '$cat_id', '$author', '$quantity', '$status')";

                                            $registerBook = mysqli_query($db, $sql);
                                            if($registerBook){
                                                header("Location: books.php?do=Manage");
                                            }
                                            else {
                                                die("MYSQLi Error." . mysqli_error($db));
                                            }
                                        }
                                    }
                                }


                                elseif($do == 'Edit') {


                                }
                                            

                                else if($do == 'Update')
                                {

                                }

                                else if($do == 'Delete')
                                {
                                    
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    <!-- Content Wrapper end -->
<?php include "inc/footer.php";?>

