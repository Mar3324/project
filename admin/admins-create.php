<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add Staff</h4>
            <a href="admins.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" required name="name" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email</label>
                    <input type="email" required name="email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password</label>
                    <input type="password" required name="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Phone Number</label>
                    <input type="number" required name="phone" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="">Deactivate</label>
                    <input type="checkbox" name="is_ban" class="width:30px;height:30px;">
                </div>
                <div class="col-md-6 mb-3">
                    <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>