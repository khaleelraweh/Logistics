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



    //updateShelveStatus
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

    //updateWarehouseRentalStatus
    $(document).on("click",".updateWarehouseRentalStatus",function(){
        var warehouse_rental_id = $(this).attr("warehouse_rental_id");
        var status = $(this).children("i").attr("status");
        var activeText = $(this).data('active-text');
        var inactiveText = $(this).data('inactive-text');

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/warehouse-rentals/update-warehouse-rentals-status',
            data:{status:status,warehouse_rental_id:warehouse_rental_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $("#warehouse-rental-"+warehouse_rental_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em'></i><span class='ms-1 text-warning fw-bold'>" + inactiveText + "</span>");
                } else if (resp['status'] == 1){
                    $("#warehouse-rental-"+warehouse_rental_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em'></i><span class='ms-1 text-success fw-bold'>" + activeText + "</span>");
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


    // ================================ related to  fronend dashbloard change status =============================

    //  updateMainMenuStatus Status
    $(document).on("click",".updateMainMenuStatus",function(){
        var status = $(this).children("i").attr("status");
        var main_menu_id = $(this).attr("main_menu_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/main_menus/update-main-menu-status',
            data:{status:status,main_menu_id:main_menu_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#main-menu-"+main_menu_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#main-menu-"+main_menu_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updateImportantLinkMenuStatus Status
    $(document).on("click",".updateImportantLinkMenuStatus",function(){
        var status = $(this).children("i").attr("status");
        var important_link_menu_id = $(this).attr("important_link_menu_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/important_link_menus/update-important-link-menu-status',
            data:{status:status,important_link_menu_id:important_link_menu_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#important-link-menu-"+important_link_menu_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#important-link-menu-"+important_link_menu_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

});

 //  updateMainSliderStatus Status
    $(document).on("click",".updateMainSliderStatus",function(){
        var status = $(this).children("i").attr("status");
        var main_slider_id = $(this).attr("main_slider_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/main_sliders/update-main-slider-status',
            data:{status:status,main_slider_id:main_slider_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#main-slider-"+main_slider_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#main-slider-"+main_slider_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updateAdvertisorSliderStatus Status
    $(document).on("click",".updateAdvertisorSliderStatus",function(){
        var status = $(this).children("i").attr("status");
        var advertisor_slider_id = $(this).attr("advertisor_slider_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/advertisor_sliders/update-advertisor-slider-status',
            data:{status:status,advertisor_slider_id:advertisor_slider_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#advertisor-slider-"+advertisor_slider_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#advertisor-slider-"+advertisor_slider_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

     //  updatePartnerStatus Status
    $(document).on("click",".updatePartnerStatus",function(){
        var status = $(this).children("i").attr("status");
        var partner_id = $(this).attr("partner_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/partners/update-partner-status',
            data:{status:status,partner_id:partner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#partner-"+partner_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#partner-"+partner_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });


    //  updatePageCategoryStatus Status
    $(document).on("click",".updatePageCategoryStatus",function(){
        var status = $(this).children("i").attr("status");
        var page_category_id = $(this).attr("page_category_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/page-categories/update-page-category-status',
            data:{status:status,page_category_id:page_category_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#page-category-"+page_category_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#page-category-"+page_category_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    //  updatePageStatus Status
    $(document).on("click",".updatePageStatus",function(){
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/frontend_dashboard/pages/update-page-status',
            data:{status:status,page_id:page_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' style='font-size:1.6em' />");
                }else if (resp['status'] ==1 ){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on fa-lg text-success' aria-hidden='true' status='Active' style='font-size:1.6em' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
