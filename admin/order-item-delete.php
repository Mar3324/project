<?php
require "../config/function.php";
$paramResult = checkParamId('index');
if(is_numeric($paramResult)){
    $indexValue = validate($paramResult);
    if(isset($_SESSION['productItems']) && $_SESSION['productItemIds']){
        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);
        redirect('order-create.php','Item deleted');
    }else{
        redirect('order-create.php','There is no item');
    }

}else{
    unset($_SESSION['productItems'][$indexValue]);
    unset($_SESSION['productItemIds'][$indexValue]);
    redirect('order-create.php','param not numeric');
    
}