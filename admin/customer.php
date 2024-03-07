<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Customers</h4>
            <a href="customers-create.php" class="btn btn-primary float-end">Add Customer</a>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?><!-- displays a success message -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $customers = getAll('customers');//function found in config/function.php and is used for retrieving all data in a database
                        if(!$customers){
                            echo'<h3>Something is wrong!!Tell the devs to Check connection to database or check logic code</h3>';
                        }
                        if(mysqli_num_rows($customers) > 0){
                            ?>
                            <?php foreach($customers as $item) : ?> <!--loops through all of items in admins and stores them an array in adminitem -->
                        <tr>
                            <td><?=$item['id'] ?></td>
                            <td><?=$item['name'] ?></td>
                            <td><?=$item['email'] ?></td>
                            <td><?=$item['phone'] ?></td>
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
                                <a href="customer-edit.php?id=<?=$item['id']?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="customers-delete.php?id=<?=$item['id']?>"
                                 onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
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