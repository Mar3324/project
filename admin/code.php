<?php
include("../config/function.php");

//this block contains code for handling the admins-create.php form used for creating admins
if(isset($_POST["saveAdmin"])){ //if the 'Save' button in admins-create.php is clicked
    $name = validate($_POST["name"]); //validate is a function in config/functions.php used for data validation
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);
    $phone = validate($_POST["phone"]);
    $is_ban = isset($_POST["is_ban"]) == true ?1:0;

    if($name != "" && $email != "" && $password!=""){
        $emailCheck = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email'" );
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect("admins-create.php", "Email is taken by another user");//redirect is a function found in config/function.php
        }
    }
    $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

    $data = [
        'name' => $name,
        'email'=> $email,
        'password' => $bcrypt_password,
        'phone' => $phone,
        'is_ban' => $is_ban,
        ];
        $result = insert('admins', $data);//inserts data using the insert function defined in config/function.php
        if($result){
            redirect("admins.php", "Staff created successfully");
        }else{
            redirect("admins-create.php", "Oops Something went wrong.");
        }

    }else{
        redirect("admins-create.php", "Please fill all the required fields");
    }
}

//This block contains code for handling the admins-edit.php for editing the form
if(isset($_POST["updateAdmin"])){ //if the 'update' button in admins-edit.php is clicked
    $adminId = validate($_POST["adminId"]); //validate is a function in config/functions.php used for data validation
    $adminData = getById('admins', $adminId);
    if($adminData['status'] !=200){
        redirect('admins-edit.php?id='.$adminId, 'Please fill all values');
    }
    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);
    $phone = validate($_POST["phone"]);
    $is_ban = isset($_POST["is_ban"]) == true ?1:0;

    $emailCheckQuery = "SELECT * FROM admins WHERE email='$email' and id!='$adminId'";
    $checkResult = mysqli_query($conn,$emailCheckQuery);
    if($checkResult){
        if(mysqli_num_rows($checkResult) > 0){
            redirect("admins-edit.php?id=".$adminId, "Email is already taken by another user");
        }
    }

    if($password!=""){
        $hashedPassword=password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData['data']['password'];
    }
    if($name !="" && $email !=""){
        $data = [
            'name' => $name,
            'email'=> $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban,
            ];
            $result = update('admins',$adminId ,$data);
            if($result){
                redirect("admins.php?id=".$adminId, "Staff Updated successfully");
            }else{
                redirect("admins-edit.php?id=".$adminId, "Oops Something went wrong.");
            }
    }
}

//This block contains code for handling the categories-create.php for adding a category
if(isset($_POST["saveCategory"])){
    $name = validate($_POST["name"]);
    $description= validate($_POST["description"]);
    $user_placed_id = $_SESSION['loggedInUser']['user_id'];
    $status= isset($_POST["status"]) == true ?1:0;


        $data = [
            'name' => $name,
            'description'=> $description,
            'status' => $status,
            'user_id' => $user_placed_id,
            ];
            $result = insert('categories',$data);
            if($result){
                redirect("categories.php", "Category Created Successfully");
            }else{
                redirect("categories-create.php", "Oops Something went wrong.");
            }
}

// code for handling update category
if(isset($_POST["updateCategory"])){
    $categoryId = validate($_POST["categoryId"]);
    $name = validate($_POST["name"]);
    $description= validate($_POST["description"]);
    $status= isset($_POST["status"]) == true ?1:0;


        $data = [
            'name' => $name,
            'description'=> $description,
            'status' => $status,
            ];
            $result = update('categories',$categoryId,$data);
            if($result){
                redirect("categories-edit.php?id=".$categoryId, "Category Updated Successfully");
            }else{
                redirect("categories-edit.php?id=".$categoryId, "Oops Something went wrong.");
            }
}
 
// code for adding product to database
if(isset( $_POST["saveProduct"])){
    $category_id = validate($_POST["category_id"]);
    $name = validate($_POST["name"]);
    $price = validate($_POST["price"]);
    $quantity = validate($_POST["quantity"]);
    $user_placed_id = $_SESSION['loggedInUser']['user_id'];
    $description= validate($_POST["description"]);
    $status= isset($_POST["status"]) == true ?1:0;



        $data = [
            'category_id'=> $category_id,
            'name' => $name,
            'description'=> $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'status' => $status,
            'user_id' => $user_placed_id,
            
            ];
            $result = insert('products',$data);
            if($result){
                redirect("products.php", "Category Created Successfully");
            }else{
                redirect("products.php", "Oops Something went wrong.");
            }
}
 // code for updating the product in the database
if(isset( $_POST["updateProduct"])){
    $product_id = validate($_POST["product_id"]);
    $productData = getById('products', $product_id);
    if(!$productData){
        redirect('products.php', 'No such product');
    }
    $category_id = validate($_POST["category_id"]);
    $name = validate($_POST["name"]);
    $price = validate($_POST["price"]);
    $quantity = validate($_POST["quantity"]);
    $description= validate($_POST["description"]);
    $status= isset($_POST["status"]) == true ?1:0;



        $data = [
            'category_id'=> $category_id,
            'name' => $name,
            'description'=> $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'status' => $status,
            ];
            $result = update('products',$product_id,$data);
            if($result){
                redirect("products-edit.php?id=".$product_id, "Product updated Successfully");
            }else{
                redirect("products.php", "Oops Something went wrong.");
            }
}

if(isset( $_POST["saveCustomer"])){
    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $phone = validate($_POST["phone"]);
    $status = isset($_POST["status"]) == true ?1:0;
    $user_placed_id = $_SESSION['loggedInUser']['user_id'];


    if($name!=""){
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)> 0){
                redirect("customer.php","email already taken");
        }

        $data = [
            'name' => $name,
            'email'=> $email,
            'phone'=> $phone,
            'status'=> $status,
            'created_at' => date('Y-m-d'),
            'user_id' => $user_placed_id,
        ];
        $result = insert('customers',$data);
        if($result){
            redirect('customer.php','Customer Created successfully');
        }else{
            redirect('customer.php','Oops something went wrong');
        }

    }else{
        redirect('customer.php', 'Please fill all required fields');
    }
}
}
// code for updating the customer field
if(isset( $_POST['updateCustomer'])){
    $name = validate($_POST["name"]);
    $customerId = validate($_POST["customerId"]);
    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $phone = validate($_POST["phone"]);
    $status = isset($_POST["status"]) == true ?1:0;

    if($name!=""){
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email' AND id!='$customerId'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)> 0){
                redirect("customer-edit.php?id=".$customerId,"email already taken");
        }

        $data = [
            'name' => $name,
            'email'=> $email,
            'phone'=> $phone,
            'status'=> $status,
        ];
        $result = update('customer',$customerId,$data);
        if($result){
            redirect("customer-edit.php?id=".$customerId,'Customer Updated successfully');
        }else{
            redirect("customer-edit.php?id=".$customerId,'Oops something went wrong');
        }

    }else{
        redirect("customer-edit.php?id=".$customerId, 'Please fill all required fields');
    }
}
}