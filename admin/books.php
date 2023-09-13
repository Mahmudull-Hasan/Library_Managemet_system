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
                                                                    <td><?php echo $cat_id; ?></td>
                                                                    <td><?php echo $quantity; ?></td>
                                                                    
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
                               
                                }


                                else if ( $do == 'Store'){


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