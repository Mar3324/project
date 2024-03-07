<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admins</h4>
            <a href="admins-create.php" class="btn btn-primary float-end">Create Staff</a>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $admins = getAll('admins');//function found in config/function.php and is used for retrieving all data in a database
                        if(!$admins){
                            echo'<h3>Something is wrong!!Tell the devs to Check connection to database or check logic code</h3>';
                        }
                        if(mysqli_num_rows($admins) > 0){
                            ?>
                            <?php foreach($admins as $adminItem) : ?> <!--loops through all of items in admins and stores them an array in adminitem -->
                        <tr>
                            <td><?=$adminItem['id'] ?></td>
                            <td><?=$adminItem['name'] ?></td>
                            <td><?=$adminItem['email'] ?></td>
                            <td>
                                <?php 
                                if($adminItem['is_ban']){
                                    echo "<span class='badge bg-danger'>Deactivated</span>";
                                }else{
                                    echo "<span class='badge bg-success'>Active</span>";
                                }
                                 ?>
                            </td>
                            <td>
                                <a href="admins-edit.php?id=<?=$adminItem['id']?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="admins-delete.php?id=<?=$adminItem['id']?>" class="btn btn-danger btn-sm">Delete</a>
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