<?php

require "../config/function.php";

$paraResult = checkParamId('id');
if(is_numeric($paraResult)){
    $adminId = validate($paraResult);
    $admin = getById('admins',$adminId);
    if($admin['status'] == 200){
        $adminDeleteRes = delete('admins',$adminId);
        if($adminDeleteRes){
            redirect('admins.php',"User deleted successfully");
        }else{
            redirect("admins.php","Something went wrong");
        }

    }
     redirect('admins.php','Something is wrong.');
   
}
