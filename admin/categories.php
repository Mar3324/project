<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Categories</h4>
            <a href="categories-create.php" class="btn btn-primary float-end">Create Categories</a>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?><!-- displays a success message -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //$categories = getAll('categories');//function found in config/function.php and is used for retrieving all data in a database
                          $user_id = $_SESSION['loggedInUser']['user_id'];
                            $query = "SELECT * FROM categories WHERE status='0' AND user_id='$user_id'";
                            $categories = mysqli_query($conn, $query);
                        if(!$categories){
                            echo'<h3>Something is wrong!!Tell the devs to Check connection to database or check logic code</h3>';
                        }
                        if(mysqli_num_rows($categories) > 0){
                            ?>
                            <?php foreach($categories as $item) : ?> <!--loops through all of items in admins and stores them an array in adminitem -->
                        <tr>
                            <td><?=$item['id'] ?></td>
                            <td><?=$item['name'] ?></td>
                            <td>
                                <?php 
                                if($item['status'] == 1){
                                    echo "<span class='badge bg-danger'>Hidden</span>";
                                }else{
                                    echo "<span class='badge bg-success'>Visible</span>";
                                }
                                 ?>
                            </td>
                            <td>
                                <a href="categories-edit.php?id=<?=$item['id']?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="categories-delete.php?id=<?=$item['id']?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <?php
                        }else{ //if no records are found the else block runs
                            ?>
                            <tr>
                            <th colspan="4">No records found</th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>