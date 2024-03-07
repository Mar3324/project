<?php
 include "includes/header.php"; 

if(!isset($_SESSION["productItems"])){
    echo "<script>window.location.href='order-create.php';</script>";
}
?>

<div class="modal fade" id="orderSuccessModal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5> -->
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3 p-4">
            <h5 id="orderPlaceSuccessMessage"></h5>
        </div>
        <a href="orders.php" class="btn btn-secondary">Close</aon>
        <button class="btn btn-info px-4 mx-1" onclick="printMyBillingArea()">Print</button>
        <button type="button" onclick="downloadPDF('<?= $_SESSION['invoice_no']?>')" class="btn btn-warning saveCustomer">Download PDF</button>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<div class="container-fluid px-4">
 <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Order Summary
                    <a class="btn btn-info float-end" href="order-create.php">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <div id="myBillingArea">
                    <?php 
                    if(isset($_SESSION["cphone"])) {
                        $phone = validate($_SESSION["cphone"]);
                        $invoiceNo = validate($_SESSION["invoice_no"]);

                        $customerQuery = mysqli_query($conn,"SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
                        if($customerQuery){
                            if(mysqli_num_rows($customerQuery) > 0){
                                $cRowData = mysqli_fetch_assoc($customerQuery);
                                ?> 
                            <table style="width:100%;">
                                <tbody>
                                 <tr>
                                    <td style="text-align:center;" colspan='2'>
                                        <h4 style="font-size:23px; line-height:30px; margin:2px; padding:0;">Company XYZ</h4>
                                        <p  style="font-size:16px; line-height:24px; margin:2px; padding:0;">#555 Moi avenue</p>
                                        <p  style="font-size:16px; line-height:24px; margin:2px; padding:0;">company xyz pvt</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 style="font-size:20px; line-height:30px; margin:0px; padding:0;">Customer details</h4>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0;">Customer name:<?= $cRowData['name']?></p>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0;">Customer phone no:<?= $cRowData['phone']?> </p>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0;">Customer Email id:<?= $cRowData['email']?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:end;">
                                        <h4 style="font-size:23px; line-height:30px; margin:0px; padding:0;">Invoice details</h4>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0;">Invoice no: <?= $invoiceNo?></p>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0;">Inovice date: <?= date('d M Y');?></p>
                                        <p style="font-size:14px; line-height:20px; margin:0px; padding:0px;">Address 1st main road</p>
                                    </td>
                                </tr>
                                   
                                </tbody>
                            </table>
                            <?php
                            }else{
                                echo "<h5>No such customer found</h5>";
                                return;
                            }
                        }
                    }
                    ?>
                    <?php 
                    if(isset($_SESSION["productItems"])) {
                        $sessionProducts = $_SESSION["productItems"];
                    ?>
                    <div class="table-responsive">
                        <table style="width:100%;" cellpadding="5">
                        <thead>
                            <th style="border-bottom: 1px solid #ccc;">ID</th>
                            <th style="border-bottom: 1px solid #ccc;">Product name</th>
                            <th style="border-bottom: 1px solid #ccc;">Price</th>
                            <th style="border-bottom: 1px solid #ccc;">Quantity</th>
                            <th style="border-bottom: 1px solid #ccc;">Total price</th>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        $totalAmount = 0;
                        foreach($sessionProducts as $key => $row) :
                            $totalAmount += $row['price'] * $row['quantity'];
                        ?>
                        <tr>
                             <td style="border-bottom: 1px solid #ccc;"><?=$i++?></td>
                            <td style="border-bottom: 1px solid #ccc;" ><?=$row['name']?></td>
                            <td style="border-bottom: 1px solid #ccc;"><?=number_format($row['price'],0)?></td>
                            <td style="border-bottom: 1px solid #ccc;"><?=$row['quantity']?></td>
                            <td style="border-bottom: 1px solid #ccc;">
                                <?=number_format($row['price'] * $row["quantity"],0)?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td style="font-weight:bold;">Grand Total</td>
                            <td style="font-weight:bold;"><?=number_format($totalAmount,0)?></td>
                        </tr>
                        <tr colspan="5">Payment mode: <?=$_SESSION['payment_mode']?></tr>
                        </tbody>

                        </table>
                    </div>
                    <?php
                    }else{
                        echo "<h5>No items added</h5>";
                    }
                    ?>
                </div>

                <?php if(isset($_SESSION["productItems"])): ?>
                    <div class="mt-4 text-end">
                    <button type="button" class="btn btn-primary px-4 mx-3" name="saveOrder" id="saveOrder">Save</button>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
 </div>
</div>

<?php include "includes/footer.php"; ?>