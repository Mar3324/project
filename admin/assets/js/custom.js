$(document).ready(function(){
    alertify.set('notifier','position', 'top-right');
    // code to increment the value of quantity at order
    $(document).on('click', '.increment', function(){
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());
        if(!isNaN(currentValue)){
            var qtyVal = currentValue +1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId,qtyVal)
        }
        
    });
    // code to decrement value at quantity
    $(document).on('click', '.decrement', function(){
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();

        var currentValue = parseInt($quantityInput.val());
        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId,qtyVal)
        }
        
    });
    //function code for passing the increment and decrement value from js to php
    function quantityIncDec(prodId,qty){
        $.ajax({
            type:"POST",
            url:"orders-code.php",
            data:{
                'productIncDec':true,
                'product_id':prodId,
                'quantity':qty
            },
            success:function (response){
                var res = JSON.parse(response);
                if(res.status == 200){
                    //window.location.reload();
                    //console.log(res);
                     $('#productArea').load(' #productContent');
                    alertify.success(res.message);
                }else{
                    alertify.error(res.message);
                }
            }
        });
        
    }

    //proceed to pay part in the system
    $(document).on('click','.proceedToPay', function(){
        console.log("proceeed to pay");
        var payment_mode = $('#payment_mode').val();
        var cphone = $('#cphone').val();
        if(payment_mode ==""){
            swal("Select Payment Mode","Select Your payment mode","warning");
            return false;
        }

        if(cphone =="" && !$.isNumeric(cphone)){
            swal("Enter phone number","Enter Valid phone number","warning");
            return false;
        }

        var data = {
            'proceedToPlaceBtn':true,
            'cphone':cphone,
            'payment_mode':payment_mode,
        }

        $.ajax({
            type:"POST",
            url:"orders-code.php",
            data:data,
            success:function(response){
                var res = JSON.parse(response);
                if(res.status == 200){
                    window.location.href="order-summary.php";
                }else if(res.status == 404){
                    swal(res.message, res.message, res.status_type,{
                        buttons:{
                            catch:{
                                text:"Add Customer",
                                value:"catch"
                            },
                            cancel:"Cancel"
                        }
                    })
                    .then((value) => {
                        switch(value){
                            case "catch":
                                $('#c_phone').val(c_phone);
                                $('#addCustomerModal').modal('show');
                                //console.log("Pop the customer model");
                                break;
                            default:
                        }
                    });

                }else{
                    swal(res.message, res.message, res.status_type)
                }
            }
        });
    });

     //add customers to customer table
 $(document).on('click','.saveCustomer', function(){
    var c_name = $('#c_name').val();
    var c_phone = $('#c_phone').val();
    var c_email = $('#c_email').val();

    if(c_name!="" && c_phone!=""){

        if($.isNumeric(c_phone)){
            var data={
                'saveCustomerBtn':true,
                'name':c_name,
                'phone':c_phone,
                'email':c_email,

            };
            $.ajax({
                type:"POST",
                url:"orders-code.php",
                data:data,
                success:function (response){
                    var res = JSON.parse(response);
                    if(res.status == 200){
                        swal(res.message,res.message,res.status_type);
                        $('#addCustomerModal').modal('hide');
                    }else if(res.status == 422){
                        swal(res.message,res.message,res.status_type);
                    }else{
                        swal(res.message,res.message,res.status_type);
                    }
                }
            });

        }else{
            swal("Please enter valid phone number","","warning");
        }
    }else{
        swal("Please fill all required fields","","warning");
    }

 });
 //code to save orders to the database.
 $(document).on('click','#saveOrder', function(){
    $.ajax({
        type:"POST",
        url:"orders-code.php",
        data:{
            'saveOrder':true,
        },
        success:function (response){
            var res = JSON.parse(response);
            if(res.status == 200){
                swal(res.message,res.message,res.status_type);
                $('#orderPlaceSuccessMessage').text(res.message);
                $('#orderSuccessModal').modal('show');
            }else{
                swal(res.message,res.message,res.status_type);
            }
        }
    });

 });

});
 //function for printing the id="myBillingArea" found in order-view-print.php 
 function printMyBillingArea(){
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open("","");
    a.document.write('<html><title>POS system in PHP</title>');
    a.document.write('<body style="font-family:fangsong">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print()
 }

 //function for downloading PDF in the id="myBillingArea" found in order-view-print.php
 window.jsPDF = window.jspdf.jsPDF;
 var docPDF = new jsPDF;
 function downloadPDF(invoiceNo){
    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html(elementHTML,{
        callback:function(){
            docPDF.save(invoiceNo+'.pdf')
        },
        x:15,
        y:15,
        width:170,
        windowWidth:650
    });
 }
