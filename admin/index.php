<?php include("includes/header.php")?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">
                <?php alertMessage()?>

            </h1>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Categories</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('categories')?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Products</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('products')?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-info text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Admins</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('admins')?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-dark text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Customers</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('customers')?>
                </h5>
            </div>
        </div>
    </div>
            <!-- SECOND ROW -->
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h5>Orders</h5>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-body bg-danger text-white p-3">
                    <p class="text-sm mb-0 text-capitalize">Today's Orders</p>
                    <h5 class="fw-bold md-0">
                        <?php 
                        $todayDate = date('Y-m-d');
                        $todayOrder = mysqli_query($conn,"SELECT * FROM orders WHERE order_date = '$todayDate'");
                        if($todayOrder){
                            if(mysqli_num_rows($todayOrder) > 0){
                                $totalCountOrders = mysqli_num_rows($todayOrder);
                                echo $totalCountOrders;
                            }else{
                                echo "0";
                            }

                        }else{
                            echo "something went wrong";
                        }
                        ?>
                    </h5>

                </div>
            </div>

            <div class="col-md-3 mb-3">
            <div class="card card-body bg-secondary text-white p-3">
                <p class="text-sm mb-0 text-capitalize">Total Orders</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('orders')?>
                </h5>
            </div>
        </div>
        </div>
</div>
<?php include("includes/footer.php") ?>