<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Edit Product</h4>
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
            
            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->
           
            <?php
            $paramValue = checkParamId('id');
            if(!is_numeric($paramValue)) {
                echo '<h5>Id is not an integer</h5>';
                return false;
            }
            $product = getById('products',$paramValue);
            if($product){
                if($product['status'] == 200){
                    ?>
                    <input type="hidden" name="product_id" value="<?=$product['data']['id'];?>">
                     <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Select Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select category</option>
                        <?php 
                        $categories = getAll('categories');
                        if($categories){
                            if(mysqli_num_rows(($categories)) > 0){
                                foreach($categories as $cateItem){
                                    ?>
                                    <option value="<?=$cateItem['id']; ?>">
                                    <?= $product['data']['category_id'] ==$cateItem['id']? 'selected':'';?>
                                    <?=$cateItem['name']; ?>
                                    </option>
                                    <?php
                                }
                            }else{
                                echo '<option>No Category found</option>';
                            }
                        }else{
                            echo '<option value="">Something went wrong</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" required name="name" value="<?=$product['data']['name']?>" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="2"><?=$product['data']['description']?></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Price</label>
                    <input type="text" required name="price" value="<?=$product['data']['price']?>" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Quantity</label>
                    <input type="text" required name="quantity" value="<?=$product['data']['quantity']?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Status(unChecked=Visible, Checked=Hidden)</label><br>
                    <input type="checkbox" name="status" class="btn btn-primary" <?=$product['data']['status'] == true ? 'checked':""; ?> style="width:30px;height:30px;">
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                </div>
            </div>
                    <?php
            }else{
                echo '<h5>'.$product['message'].'</h5>';
            }
        }
            ?>

            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->
           
            </form>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>