<?php

require "../config/function.php";

$paraResult = checkParamId('id');
if(is_numeric($paraResult)){
    $customerId = validate($paraResult);
    $customer = getById('customers',$customerId);
    if($customer['status'] == 200){
        $response = delete('customers',$customerId);
        if($response){
            redirect('customer.php',"customer deleted succesfully");
        }else{
            redirect("customer.php","Something went wrong");
        }
    }else{
        redirect('customer.php',$customer['message']);
    }   
   
}else{
    redirect('customer.php','Something has gone wrong');
}
