<?php include("includes/header.php") ?>
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add Product</h4>
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
            <?php alertMessage()?><!-- alertMessage is a function found in config/function.php for displaying messages-->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Select Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select category</option>
                        <?php 
                        $categories = getAll('categories');
                        if($categories){
                            if(mysqli_num_rows(($categories))){
                                foreach($categories as $cateItem){
                                    echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                }
                            }else{

                            }
                        }else{
                            echo '<option value="">Something went wrong</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" required name="name" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Price</label>
                    <input type="text" required name="price" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Quantity</label>
                    <input type="text" required name="quantity" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Status(unChecked=Visible, Checked=Hidden)</label><br>
                    <input type="checkbox" name="status" class="btn btn-primary" style="width:30px;height:30px;">
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<?php include("includes/footer.php") ?>