<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Edit Staff</h4>
            <a href="admins.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->

            <?php
            if(isset($_GET['id'])){
                if($_GET['id'] != ''){
                    $adminId = $_GET['id'];
                }else{
                    echo '<h4>NO id found</h4>';
                    return false;
                }
            }else{
                echo "<h3>NO id given in params</h3>";
                return false;
            }
            $adminData= getById('admins', $adminId);
            if($adminData){
                if($adminData['status'] == 200){
                    ?>
                    <input type="hidden" name="adminId" value="<?=$adminData['data']['id'];?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" required name="name" value="<?=$adminData['data']['name']; ?>" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email</label>
                    <input type="email" required name="email" value="<?=$adminData['data']['email'];?>" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Phone Number</label>
                    <input type="number" required name="phone" value="<?=$adminData['data']['phone'];?>" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="">Deactivate</label>
                    <input type="checkbox" name="is_ban" value="<?=$adminData['data']['is_ban'] == true ?'checked':'';?>" class="width:30px;height:30px;">
                </div>
                <div class="col-md-6 mb-3">
                    <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                </div>
            </div>
                    <?php

                }else{
                    echo "<h5>".$adminData['message']."</h5>";
                }

            }else{
                echo "Something went wrong";
                return false;
            }
            ?>
            </form>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>