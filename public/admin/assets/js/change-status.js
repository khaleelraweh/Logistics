$(document).ready(function(){

    //  updateMerchantStatus Status
    $(document).on("click",".updateMerchantStatus",function(){
        var status = $(this).children("i").attr("status");
        var merchant_id = $(this).attr("merchant_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/merchants/update-merchants-status',
            data:{status:status,merchant_id:merchant_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#merchant-"+merchant_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#merchant-"+merchant_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updateProductStatus Status
    $(document).on("click",".updateProductStatus",function(){
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/products/update-products-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updateWarehouseStatus Status
    $(document).on("click",".updateWarehouseStatus",function(){
        var status = $(this).children("i").attr("status");
        var warehouse_id = $(this).attr("warehouse_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/warehouses/update-warehouses-status',
            data:{status:status,warehouse_id:warehouse_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#warehouse-"+warehouse_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#warehouse-"+warehouse_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updateShelveStatus Status
    // $(document).on("click",".updateShelveStatus",function(){
    //     var status = $(this).children("i").attr("status");
    //     var shelf_id = $(this).attr("shelf_id");

    //     $.ajax({
    //         headers:{
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type:'post',
    //         url:'/admin/shelves/update-shelves-status',
    //         data:{status:status,shelf_id:shelf_id},
    //         success:function(resp){
    //             if(resp['status']==0){
    //                 $("#shelf-"+shelf_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
    //             }else if (resp['status'] ==1 ){
    //                 $("#shelf-"+shelf_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
    //             }
    //         },error:function(){
    //             alert("Error");
    //         }
    //     });
    // });



    $(document).on("click",".updateShelveStatus",function(){
        var shelf_id = $(this).attr("shelf_id");
        var status = $(this).children("i").attr("status");
        var activeText = $(this).data('active-text');
        var inactiveText = $(this).data('inactive-text');

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/shelves/update-shelves-status',
            data:{status:status,shelf_id:shelf_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $("#shelf-"+shelf_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em'></i><span class='ms-1 text-warning fw-bold'>" + inactiveText + "</span>");
                } else if (resp['status'] == 1){
                    $("#shelf-"+shelf_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em'></i><span class='ms-1 text-success fw-bold'>" + activeText + "</span>");
                }
            },
            error:function(){
                alert("Error updating status");
            }
        });
    });



    //  updateStockItemStatus Status
    $(document).on("click",".updateStockItemStatus",function(){
        var status = $(this).children("i").attr("status");
        var stock_item_id = $(this).attr("stock_item_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/stock-items/update-stock-items-status',
            data:{status:status,stock_item_id:stock_item_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#stock-item-"+stock_item_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#stock-item-"+stock_item_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });


    //  updateShippingPartnerStatus Status
    $(document).on("click",".updateShippingPartnerStatus",function(){
        var status = $(this).children("i").attr("status");
        var shipping_partner_id = $(this).attr("shipping_partner_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/shipping-partners/update-shipping-partners-status',
            data:{status:status,shipping_partner_id:shipping_partner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#shipping-partner-"+shipping_partner_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#shipping-partner-"+shipping_partner_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });




});
