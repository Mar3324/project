<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add Customer</h4>
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
                <div class="col-md-12 mb-3">
                    <label for="">email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Phone</label>
                    <input type="number" name="phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Status(unChecked=Visible, Checked=Hidden)</label><br>
                    <input type="checkbox" name="status" class="btn btn-primary" style="width:30px;height:30px;">
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <button type="submit" name="saveCustomer" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>