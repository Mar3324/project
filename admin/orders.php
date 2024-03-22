<?php include("includes/header.php"); ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <!-- for filtering orders based on date and payment type given -->
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="col-md-8">
                    <form action="">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" name="date"
                                value="<?= isset($_GET['date']) == true ? $_GET['date']:"";?>">
                            </div>
                            <div class="col-md-4">
                                <select name="payment_status" class="form-select" id="">
                                    <option value="">--Select Payment Status--</option>
                                    <option value="Cash payment"
                                    <?=isset($_GET['payment_status']) == true ? ($_GET['payment_status'] == 'Cash payment'?'selected':'') :'';
                                    ?>
                                    >Cash Payment</option>
                                    <option value="Online payment"
                                    <?=isset($_GET['payment_status']) == true ? ($_GET['payment_status'] == 'Online payment'?'selected':'') :''; ?>
                                    >Online Payment</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="orders.php" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <h4 class="mb-0">Orders</h4> -->
        </div>
        <div class="card-body">
            <?php 
            $user_id = $_SESSION['loggedInUser']['user_id'];
            if(isset($_GET['date']) || isset($_GET['$payment_status'])) {
                $orderDate = validate($_GET['date']);
                $payment_status = validate($_GET['payment_status']);
                if($orderDate !="" && $payment_status == ""){
                    $query = "SELECT o.*, c.*  FROM orders o, customers c 
                            WHERE c.id = o.customer_id AND o.order_date='$orderDate' AND o.order_placed_by_id='$user_id'
                            ORDER BY o.id DESC";

                }else if($orderDate == "" && $payment_status != ""){
                    $query = "SELECT o.*, c.*  FROM orders o, customers c 
                            WHERE c.id = o.customer_id AND o.payment_mode='$payment_status' AND o.order_placed_by_id='$user_id'
                            ORDER BY o.id DESC";

                }else if($orderDate != "" && $payment_status != ""){
                    $query = "SELECT o.*, c.*  FROM orders o, customers c 
                            WHERE c.id = o.customer_id AND o.payment_mode='$payment_status' AND o.order_date='$orderDate' AND o.order_placed_by_id='$user_id'
                            ORDER BY o.id DESC";
                }else{
                    $query = "SELECT o.*, c.*  FROM orders o, customers c WHERE c.id = o.customer_id AND o.order_placed_by_id='$user_id' ORDER BY o.id DESC";
                }
            }else{
                 $query = "SELECT o.*, c.*  FROM orders o, customers c WHERE c.id = o.customer_id  AND o.order_placed_by_id='$user_id' ORDER BY o.id DESC";

            }
            $orders = mysqli_query($conn, $query);
            if($orders){
                if(mysqli_num_rows($orders) > 0){
                    ?>
                    <table class="table table-striped table-bordered align-items-center justify-content-center">
                        <thead>
                    <tr>
                        <th>Tracking no</th>
                        <th>Customer name</th>
                        <th>Customer phone</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $orderItem) : ?>
                                <tr>
                                <td><?=$orderItem['tracking_no']?></td>
                                <td><?=$orderItem['name']?></td>
                                <td><?=$orderItem['phone']?></td>
                                <td><?=date('d M Y', strtotime($orderItem['order_date']))?></td>
                                <td><?=$orderItem['order_status']?></td>
                                <td><?=$orderItem['payment_mode']?></td>
                                <td>
                                    <a href="orders-view.php?track=<?=$orderItem['tracking_no'];?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                    <a href="orders-view-print.php?track=<?=$orderItem['tracking_no'];?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                </td>
                                </tr>
                             <?php endforeach;?>
                        </tbody>
                    </table>
                    <?php
                }else{
                    echo "<h5>No record found</h5>";
                }

            }else{
                echo "<h5>Something went wrong</h5>";
            }
            ?>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>