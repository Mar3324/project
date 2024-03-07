<?php include("includes/header.php") ?>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="">Customer Name</label>
            <input type="text" class="form-control" id="c_name">
        </div>
        <div class="mb-3">
            <label for="">Customer Phone No</label>
            <input type="number" class="form-control" id="c_phone">
        </div>
        <div class="mb-3">
            <label for="">Customer email(optional)</label>
            <input type="email" class="form-control" id="c_email">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add Order</h4>
            <a href="admins.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body" id="productArea">
            <form action="orders-code.php" method="POST">
            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->
           <select name="product_id" class="form-select mySelect2">
            <option value="">--Select product--</option>
            <?php 
            $products = getAll('products');
            if($products){
                if(mysqli_num_rows($products)> 0){
                    foreach($products as $prodItem){
                        ?>
                         <option value="<?=$prodItem['id']; ?>"><?=$prodItem['name'];?></option>
                        <?php
                    }
                }else{
                    echo ' <option value="">No products found</option>';
                }
            }else{
                echo '<option value="">Someting went wrong</option>';
            }
            ?>
           </select>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" required name="quantity" class="form-control">
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <button type="submit" name="addItem" class="btn btn-primary">Add item</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<?php 

?>
 <div class="card">
    <div class="card-header">
        <h4 class="mb-0">Your Products</h4>
         <div class="card-body">
            <?php 
            if(isset($_SESSION['productItems'])){
                $sessionProducts = $_SESSION['productItems'];
                if(empty($sessionProducts)){
                    unset($_SESSION['productItemIds']);
                    unset($_SESSION['productItems']);
                }
            ?>

            <div class="table-responsive mb-3" id="productContent">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i= 1; foreach($sessionProducts as $key => $item): ?>
                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$item['name'];?></td>
                                <td><?=$item['price'];?></td>
                                <td>
                                    <div class="input-group qtyBox">
                                        <input type="hidden" name="" value="<?=$item['product_id'];?>" class="prodId">
                                        <button class="input-group-text decrement">-</button>
                                        <input type="text" name="" value="<?=$item['quantity'];?>" class="qty quantityInput">
                                        <button class="input-group-text increment">+</button>
                                    </div>
                                </td>
                                <td><?=number_format($item['price']*$item['quantity'],0);?></td>
                                <td>
                                    <a href="order-item-delete.php?index=<?=$key; ?>" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <div class="row">
                    <div class="col-md-4">
                    <label for="">Select Payment mode</label>
                    <select id="payment_mode" class="form-select">
                        <option value="">--Select payment--</option>
                        <option value="Cash Payment">Cash payment</option>
                        <option value="Online Payment">Online Payment</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                            <label for="">Enter phone number</label>
                            <input type="number" name="" id="cphone">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <button type="submit" name="proceedToPlaceBtn" class="btn btn-warning w-100 proceedToPay">Proceed to Place order</button>
                    </div>
                    
                </div>
            </div>

            <?php

            }else{
                echo "<h5>No items added</h5>";
            }
            ?>
        </div>
    </div>
</div> 
<?php include("includes/footer.php") ?>