var monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

(function () {
    // "use strict";

    var treeviewMenu = $('.app-menu');

    // Toggle Sidebar
    $('[data-toggle="sidebar"]').click(function(event) {
        event.preventDefault();
        $('.app').toggleClass('sidenav-toggled');
    });

    // Activate sidebar treeview toggle
    $("[data-toggle='treeview']").click(function(event) {
        event.preventDefault();
        if(!$(this).parent().hasClass('is-expanded')) {
            treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
        }
        $(this).parent().toggleClass('is-expanded');
    });

    // Set initial active toggle
    $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

    //Activate bootstrip tooltips
    $("[data-toggle='tooltip']").tooltip();

})();


$(function(){
    $( ".forselect2" ).select2({
        theme: "bootstrap4"
    });
});
$(function(){
    var url = window.location.href;
    var activePage = url;
    $('.app-menu a').each(function () {
        var linkPage = this.href;

        if (activePage == linkPage) {
            $(this).addClass("active");
            $(this).parent().parent().closest("ul").parent().addClass('is-expanded');
        }
    });
});


$(function(){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});

/*$(function(){
    $('.forselect2').select2();
});*/


function formatDate(date){
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
$(function(){
    $('.datepicker').change(function(){
        var date = $(this).val();
        $(this).val(formatDate(date));
    });
});

$(function(){
    $('#status').change(function(){
        $('#status_value').val($('#status option:selected').text());
    });
});
$(function(){
    $('.generateRent .datepicker').change(function(){
        var pickedDate = $(this).val();
        var date = new Date(pickedDate);
        var month = date.getMonth();
        var year = date.getFullYear();
        var monthYear = monthName[month]+', '+year;
        $('#rent_month').val(monthYear);
        //alert(monthYear);
    });
});

$(function(){

    /*  */
    $('.transfer #product_id').change(function(){

        if($('#product_id').val() !== 0){
            $('#shop_from_id').removeAttr('disabled', 'disabled');
        }else{
            $('#shop_from_id').attr('disabled', 'disabled');
        }
    });
    $('.transfer #shop_from_id').change(function(){

        if($('#shop_from_id').val() !== 0){
            $('#shop_to_id').removeAttr('disabled', 'disabled');
        }else{
            $('#shop_to_id').attr('disabled', 'disabled');
        }
    });

    $('.transfer #shop_from_id').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var product_id = $('#product_id').val();
        var shop_from_id = $('#shop_from_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/productsShopsPostAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'product_id' : product_id,
                'shop_from_id' : shop_from_id
            },
            success: function(data){ 
                var id = $('#product_id').val();
                var product_id = $('#product_id').val();
                var shop_from_id = $('#shop_from_id').val();
                var index = data.findIndex(x => x.product_id == product_id && x.shop_id == shop_from_id);
                var quantity = Number(data[index].quantity);
                $('#stockQuantityFrom').val(quantity);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });
    $('.transfer #shop_to_id').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var product_id = $('#product_id').val();
        var shop_to_id = $('#shop_to_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/productsShopsPostAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'product_id' : product_id,
                'shop_to_id' : shop_to_id
            },
            success: function(data){ 
                var product_id = $('#product_id').val();
                var shop_to_id = $('#shop_to_id').val();
                var index = data.findIndex(x => x.product_id == product_id && x.shop_id == shop_to_id);
                var quantity = Number(data[index].quantity);
                $('#stockQuantityTo').val(quantity);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });




    /*  */


    $('.supplierExpense #supplier_id').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var supplier_id = $('#supplier_id').val();
        if(supplier_id != 0){
            $('#amount').removeAttr('readonly', 'readonly');
        }else{
            $('#amount').attr('readonly', 'readonly');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/suppliersPostAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'supplier_id' : supplier_id
            },
            success: function(data){ 
                var id = $('#supplier_id').val();
                var index = data.findIndex(x => x.id == id);
                var previous_due = Number(data[index].previous_due);
                $('#previous_due').val(previous_due);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });

    $('.supplierExpense #amount').change(function(){
        var amount = Number($('#amount').val());
        var previous_due = Number($('#previous_due').val());
        $('#due').val(previous_due - amount);
    });


    $('#additionalCost').change(function(){
        var subTotal = Number($('#subTotal').val());
        var additionalCost = Number($('#additionalCost').val());
        var discount = Number($('#discount').val());
        // var additionalDiscount = + additionalCost - discount;
        $('#totalBill').val(subTotal + additionalCost);
        var totalBill = Number($('#totalBill').val());
        var previousDue = Number($('#previousDue').val());
        $('#grandTotal').val(totalBill + previousDue  - discount);
    });
    $('#discount').change(function(){   
        var subTotal = Number($('#subTotal').val());     
        var additionalCost = Number($('#additionalCost').val());
        var discount = Number($('#discount').val());
        // var additionalDiscount = additionalCost + discount;
        //$('#totalBill').val(subTotal + additionalCost - discount);
        var totalBill = Number($('#totalBill').val());
        var previousDue = Number($('#previousDue').val());
        $('#grandTotal').val(totalBill + previousDue - discount);
    });
    $('#totalBill').change(function(){
        var totalBill = Number($('#totalBill').val());
        var previousDue = Number($('#previousDue').val());
        $('#grandTotal').val(totalBill + previousDue - discount);
    });
    $('#paidAmount').change(function(){
        var paidAmount = Number($('#paidAmount').val());
        var grandTotal = Number($('#grandTotal').val());
        var previousDue = Number($('#previousDue').val());
        $('#totalDue').val(grandTotal - paidAmount);
    });

    // $('#productBarcode').bind('change', function() {
    //     var token = $('input[name=_token]').val(); 
    //     var productBarcode = $('#productBarcode').val();
    //     var salePrice = $('#salePrice').val();
    //     $.ajax({
    //         type: "POST",
    //         url:  '/admin/productsPostAjax',
    //         dataType: 'json',
    //         data: {
    //             '_token' : token,
    //             'productBarcode' : productBarcode,
    //         },
    //         success: function(data){ 
    //             console.log(data);
    //             var salePrice = (+data.price);
    //             $('#salePrice').val(salePrice);
    //         },
    //         error: function(data) {
    //             console.log(data.responseText);
    //         }
    //     });           
    // });

    $('#cartSubmit').on("click", function(event){
        event.preventDefault();
        //$('#noItemRow').remove();
        var token = $('input[name=_token]').val(); 
        var productBarcode = $('#productBarcode').val();
        var quantity = $('#quantity').val();
        var special_price = $('#special_price').val();
        $("#quantity_errors").hide();
        $("#quantity_errors").html("");
        $.ajax({
            type: "POST",
            url:  '/admin/cart/addToCart',
            dataType: 'json',
            data: {
                '_token' : token,
                'productBarcode' : productBarcode,
                'quantity' : quantity,
                'special_price' : special_price
            },
            success: function(data){
                if(data.total_quantity > 0 && data.proQuantity == data.total_quantity && data.price != 0){
                    if(data.past_buy === true){
                        console.log(data);
                        var productBarcode = data.productBarcode;
                        var product_id = data.product_id;
                        var name = data.name;
                        var buyPrice = (+data.buyPrice);
                        var price = data.price;
                        // var special_price = Number($('#special_price').val());
                        
                        // if(!$('#special_price').val()){
                        //   var price = (+salePrice);
                        // }else{
                        //   price = (+special_price);
                        // }
                        // var profit = price - price;
                        var qty = data.quantity;
                        var qtyId="qty"+product_id;
                        var subTotalId="subTotal"+product_id;
                        var oldQty=$("#"+qtyId).val();
                        var oldSubtotal=(+oldQty)*(+price);
                        var oldBuyPrice = (+buyPrice)*(+oldQty);
                        var subTotal = (+price)*(+qty);
                        var totalBuyPrice = (+buyPrice)*(+qty);

                        var oldProfit = oldSubtotal - oldBuyPrice;
                        var totalProfit = subTotal - totalBuyPrice;

                        var old_totalQty=Number($("#totalItems").val());
                        old_totalQty=(+old_totalQty)+(+qty);
                        old_totalQty=(+old_totalQty)-(+oldQty);
                        $("#totalItems").val(old_totalQty);
                        $("#"+qtyId).val(qty);
                        $("#"+subTotalId).html(subTotal);
                        $("#price"+product_id).html(price);
                        if(old_totalQty>0){
                          $('#noItemRow').hide();
                        }

                        var old_totalProfit=Number($("#totalProfit").val().replace(",",""));
                        old_totalProfit=(+old_totalProfit)-(+oldProfit);
                        old_totalProfit=(+old_totalProfit)+(+totalProfit);
                        $("#totalProfit").val(old_totalProfit);

                        var old_totalPrice=Number($("#subTotal").val().replace(",",""));
                        old_totalPrice=(+old_totalPrice)-(+oldSubtotal);
                        old_totalPrice=(+old_totalPrice)+(+subTotal);

                        $("#subTotal").val(old_totalPrice);
                        $("#totalBill").val(old_totalPrice);
                        $("#grandTotal").val(old_totalPrice);
                        $('#quantity').val(1);
                        $('#productBarcode').val('');
                        $('#special_price').val('');
                        $('#salePrice').val('');
                        var uniqueQuantity = Number(data.uniqueQuantity);
                        $('#uniqueItem').val(uniqueQuantity);
                        $('#productBarcode').val('');
                        $('#productBarcode').focus();
                    }else{
                        console.log(data);
                        var productBarcode = data.productBarcode;
                        var product_id = data.product_id;
                        var name = data.name;
                        var buyPrice = (+data.buyPrice);
                        var rowId = data.rowid;
                        var price = data.price;
                        // var special_price = Number($('#special_price').val());

                        // if(!$('#special_price').val()){
                        //     var price = (+salePrice);
                        // }else{
                        //     price = (+special_price);
                        // }
                        // var profit = price - buyPrice;
                        var qty = data.quantity;
                        var total_quantity = data.total_quantity;
                        var total_quantityId="qty"+product_id;
                        var subTotalId="subtotal"+product_id;
                        var oldQty=$("#"+qtyId).val();
                        var oldSubtotal=(+oldQty)*(+price);
                        var subTotal = (+price)*(+qty);
                        var totalBuyPrice = (+buyPrice)*(+qty);
                        var totalProfit = subTotal - totalBuyPrice;

                        $('#cartTable').append(`
                            <tr class="animated slideInUp" id="tableRow${product_id}">
                                <td id="name${product_id}">${name}</td>
                                <td style="width:20%;" id="quantity${product_id}">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" type="number" value="${qty}" id="qty${product_id}" style="width:50px;" onchange="chageQty('${product_id}','${qty}','${rowId}', '${total_quantity}')" name="qty${product_id}" >
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-custom" onclick="plusQuantity('${rowId}', '${total_quantity}', '${product_id}', '${price}')">
                                                <i class="fas fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-custom" onclick="minusQuantity('${rowId}', '${product_id}','${price}')">
                                                <i class="fas fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="qtyError${product_id}" class="invalid-feedback"></div>
                                </td>
                                <td id="price${product_id}">${price}</td>
                                <td id="subTotal${product_id}">${subTotal}</td>
                                <td id="removeRow${product_id}">
                                    <a onclick="delete_row('${rowId}','${product_id}','${price}','${buyPrice}')"  class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i>
                                </td>
                            </tr>
                        `);

                        var old_totalQty=Number($("#totalItems").val());
                        old_totalQty=(+old_totalQty)+(+qty);
                        $("#totalItems").val(old_totalQty);

                        if(old_totalQty>0){
                            $('#noItemRow').hide();
                        }

                        var old_totalProfit=Number($("#totalProfit").val().replace(",",""));
                        old_totalProfit=(+old_totalProfit)+(+totalProfit);
                        $("#totalProfit").val(old_totalProfit);

                        var old_totalPrice=Number($("#subTotal").val().replace(",",""));
                        old_totalPrice=(+old_totalPrice)+(+subTotal);

                        $("#subTotal").val(old_totalPrice);
                        $("#totalBill").val(old_totalPrice);
                        $("#grandTotal").val(old_totalPrice);
                        $('#quantity').val(1);
                        $('#special_price').val('');
                        $('#salePrice').val('');
                        var uniqueQuantity = Number(data.uniqueQuantity);
                        $('#uniqueItem').val(uniqueQuantity++);
                        $('#productBarcode').val('');
                        $('#productBarcode').focus();
                    }                
                }else {
                    $("#quantity_errors").show();
                    $("#quantity_errors").html(data.errors);
                }                
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
    });

    $('.invoiceDetails #client_id').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var client_id = $('#client_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/clientsPostAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'client_id' : client_id
            },
            success: function(data){ 
                var id = $('#client_id').val();
                var totalBill = Number($('#totalBill').val());
                var discount = Number($('#discount').val());
                var index = data.findIndex(x => x.id == id);
                var contact_no = data[index].contact_no;
                var address = data[index].address;
                var previousDue = Number(data[index].previous_due);
                $('#contact_no').val(contact_no);
                $('#address').val(address);
                $('#previousDue').val(previousDue);
                $('#grandTotal').val(previousDue+totalBill-discount);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });

});



function delete_row(rowId,id,price,buyPrice){
    var token = $('input[name=_token]').val(); 
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({

        type: "POST",
        url:  '/admin/cart/removeItem/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId
        },
        success: function(data) {
            console.log(data);
            var qid = "qty"+id;
            var input_qty = $("#"+qid).val();
            var sub_total = (+input_qty)*price;
            var totalBuyPrice = (+input_qty)*buyPrice;
            var totalProfit = sub_total - totalBuyPrice;
            

            var old_totalQty=$("#totalItems").val();
            old_totalQty=(+old_totalQty)-(+input_qty);
            $("#totalItems").val(old_totalQty);

            var uniqueQuantity = $('#uniqueItem').val();
            $('#uniqueItem').val(--uniqueQuantity);

            /*if(old_totalQty<1){
                $('#noItemRow').show();
            }*/

            var old_totalProfit = $("#totalProfit").val();
            old_totalProfit=(+old_totalProfit)-(+totalProfit);
            $("#totalProfit").val(old_totalProfit);

            var old_totalPrice=$("#subTotal").val();
            old_totalPrice=(+old_totalPrice)-(+sub_total);


            $("#subTotal").val(old_totalPrice);
            $("#totalBill").val(old_totalPrice);
            $("#grandTotal").val(old_totalPrice);

            $('#tableRow'+id).remove();
            if(old_totalQty == 0){
                $('#grandTotal').val('');
                $('#additionalCost').val(0);
                $('#discount').val(0);
                $('#previousDue').val(0);
                $('#totalProfit').val(0);
                $('#uniqueItem').val(0);
                $('#client_id').val('');
                $('#noItemRow').show();
            }            
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });
}

function plusQuantity(rowId,total_qty,id,price){    
    var token = $('input[name=_token]').val();           
    var qid="qty"+id;
    var subid="subTotal"+id;
    var input_val = $("#"+qid).val();
    input_val=++input_val;
    var sub_total=input_val*price;

    if(total_qty>=input_val){
        $.ajax({
            type: "POST",
            url: '/admin/cart/increment/'+rowId,
            dataType: 'json',
            data: {
                '_token' : token,
                'rowId': rowId,
                'qty': input_val
            },
            success: function(data) {
                if (data) {
                    if (data.status === true) {
                        console.log(data);
                        $("#"+qid).val(input_val);
                        $("#"+subid).html(sub_total);

                        var old_totalQty=$("#totalItems").val();
                        old_totalQty=++old_totalQty;
                        $("#totalItems").val(old_totalQty);


                        var profit = (+data.profit);

                        var old_totalProfit=Number($("#totalProfit").val().replace(",",""));
                        old_totalProfit = (+old_totalProfit) + (+profit) ;
                        $("#totalProfit").val(+old_totalProfit);


                        var old_totalPrice=$("#subTotal").val();
                        old_totalPrice=(+old_totalPrice)+(+price);
                        $("#subTotal").val(old_totalPrice);
                        $("#totalBill").val(old_totalPrice);
                        $("#grandTotal").val(old_totalPrice);
                    }
                }
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
        
    }
}
function minusQuantity(rowId,id,price){
    var token = $('input[name=_token]').val();   
    var qid="qty"+id;
    var subid="subTotal"+id;
    var input_val = $("#"+qid).val();
    input_val=--input_val;
    var sub_total=input_val*price;
    if(input_val>0){
        $.ajax({
            type: "POST",
            url: '/admin/cart/decrement/'+rowId,
            dataType: 'json',
            data: {
                '_token' : token,
                'rowId': rowId,
                'qty': input_val
            },
            success: function(data) {
                if (data) {
                    if (data.status === true) {
                        console.log(data);
                        $("#"+qid).val(input_val);
                        $("#"+subid).html(sub_total);
                        var old_totalQty=$("#totalItems").val();
                        old_totalQty=--old_totalQty;
                        $("#totalItems").val(old_totalQty);
                        //* for total price *//


                        var profit = (+data.profit);

                        var old_totalProfit=Number($("#totalProfit").val().replace(",",""));
                        old_totalProfit = (+old_totalProfit) - (+profit) ;
                        $("#totalProfit").val(+old_totalProfit);


                        var old_totalPrice=$("#subTotal").val();
                        old_totalPrice=(+old_totalPrice)-(+price);
                        $("#subTotal").val(old_totalPrice);
                        $("#totalBill").val(old_totalPrice);
                        $("#grandTotal").val(old_totalPrice);
                    } 
                }
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
        
    }
}

function chageQty(id, oldQty, rowId, totalQuantity){ 
    var token = $('input[name=_token]').val();      
    var price = Number($("#price"+id).html());     
    var qid="qty"+id;
    var subid="subTotal"+id;
    var qty = Number($("#"+qid).val());

    $.ajax({
        type: "POST",
        url: '/admin/cart/changeQuantity/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId,
            'qty': qty,
        },
        success: function(data) {
            if (data) {
                //console.log(data);
                if(qty > totalQuantity){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else if(qty < 1){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else{
                    $("#qtyError"+id).hide();
                    var old_qty = (+data.old_qty);

                    var sub_total=qty*price;
                    var old_sub_total=old_qty*price;

                    $("#"+qid).val(qty);
                    $("#"+subid).html(sub_total);

                    var old_totalQty= Number($("#totalItems").val());
                    old_totalQty =  (+old_totalQty) + qty - (+old_qty);
                    $("#totalItems").val(old_totalQty);

                    var profit = (+data.profit);

                    var oldProfit = old_qty * profit;

                    var newProfit = qty * profit;

                    var totalProfit = (+newProfit) - (+oldProfit);

                    console.log(typeof(totalProfit));


                    var old_totalProfit=Number($("#totalProfit").val().replace(",",""));
                    old_totalProfit = (+old_totalProfit) + (+totalProfit) ;
                    $("#totalProfit").val(+old_totalProfit);


                    var old_totalPrice=$("#subTotal").val();                        
                    old_totalPrice=(+old_totalPrice)+(+sub_total)-(+old_sub_total);
                    $("#subTotal").val(old_totalPrice);
                    $("#totalBill").val(old_totalPrice);
                    $("#grandTotal").val(old_totalPrice);
                }
            }
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });    
}

$(function(){
    $('.addToStock #product_id').change(function(){
        var token = $('input[name=_token]').val(); 
        var product_id = $('#product_id').val();
        if(product_id != 0){
            $('#quantity').removeAttr('readonly', 'readonly');
        }else{
            $('#quantity').attr('readonly', 'readonly');
        }
        $.ajax({
            type: "POST",
            url:  '/admin/allProductsAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'product_id' : product_id,
            },
            success: function(data){ 
                var id = $('#product_id').val();
                var index = data.findIndex(x => x.id == id);
                var stockQuantity = Number(data[index].stockQuantity);
                var buyPrice = Math.ceil(Number(data[index].buyPrice));
                $('#previous_quantity').val(stockQuantity);
                $('#previous_buyPrice').val(buyPrice);
            }
        });        
    });
    $('.addToStock #quantity').change(function(){
        if($('#quantity').val().length !== 0){
            $('#unit_cost').removeAttr('readonly', 'readonly');
        }else{
            $('#unit_cost').attr('readonly', 'readonly');
        }

        var new_quantity =   Number($('#quantity').val()) + Number($('#previous_quantity').val());  
        $('#new_quantity').val(new_quantity);
    });
    $('.addToStock #unit_cost').change(function(){
        //var unit_cost =  Math.ceil(Number($('#unit_cost').val()) / Number($('#quantity').val()));  
        var totalBuyPrice = Math.ceil((Number($('#previous_quantity').val())*Number($('#previous_buyPrice').val())) + (Number($('#quantity').val())) * (Number($('#unit_cost').val())));
        var totalQuantity =   Math.ceil(Number($('#quantity').val()) + Number($('#previous_quantity').val()));  
        var buyPrice = Math.ceil(totalBuyPrice/totalQuantity);
        $('#total_cost').val((Number($('#quantity').val())) * (Number($('#unit_cost').val())));
        //$('#custom_unit_cost').val(unit_cost);
        $('#buyPrice').val(buyPrice);
    });
});

$(function(){
    /* Receive Payment */
    $('.receivePayment  #client_id').bind('change', function() { 
        var client_id = $('#client_id').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            type: "POST",
            url:  '/admin/clientsPostAjax',
            dataType: 'json',
            data: {
                'client_id' : client_id,
                '_token' : token
            },
            success: function(data) { 
                var id = $('#client_id').val();
                var index = data.findIndex(x => x.id == id);
                var previous_due = Number(data[index].previous_due);
                $('#previous_due').val(previous_due);
            }/*,
            error: function(res) {
                alert('wrong');
                //console.log(res.responseText);
            }*/
        });
    });
    $('#paid_amount').change(function(){
        var previous_due = $('#previous_due').val();
        var paid_amount = $('#paid_amount').val();

        $('#due').val(previous_due - paid_amount);
    });

});

$(function(){
      $('#printSubmit').on("click", function(event){
        event.preventDefault();
        //$('#noItemRow').remove();
        var token = $('input[name=_token]').val(); 
        var product_id = $('#product_id').val();
        var quantity = $('#quantity').val();
        $("#quantity_errors").hide();
        $("#quantity_errors").html("");
        $.ajax({
            type: "POST",
            url:  '/admin/barcode/store',
            dataType: 'json',
            data: {
                '_token' : token,
                'product_id' : product_id,
                'quantity' : quantity
            },
            success: function(data){
                    if(data.past_buy === true){
                        console.log(data);
                        var product_id = data.product_id;
                        var name = data.name;
                        var price = data.price;

                        var qty = +(data.quantity);
                        var qtyId = "quantity"+product_id;
                        var oldQty = +($("#"+qtyId).html());

                        $("#"+qtyId).html(qty);
                        $('#quantity').val(1);
                    }else{
                        console.log(data);
                        var product_id = data.product_id;
                        var name = data.name;
                        var rowId = data.rowid;
                        var price = data.price;


                        var qty = data.quantity;
                        var total_quantityId="quantity"+product_id;
                        var oldQty=Number($("#"+qtyId).html());


                        $('#printTable').append(`
                            <tr class="animated slideInUp" id="tableRow${product_id}">
                                <td id="name${product_id}">${name}</td>
                                <td id="quantity${product_id}">${quantity}</td>
                            </tr>
                        `);

                        // var old_totalQty=Number($("#totalItems").val());
                        // old_totalQty=(+old_totalQty)+(+qty);
                        // $("#totalItems").val(old_totalQty);

                        // if(old_totalQty>0){
                        //     $('#noItemRow').hide();
                        // }

                        $('#quantity').val(1);
                    }                
                /*else {
                    $("#quantity_errors").show();
                    $("#quantity_errors").html(data.errors);
                } */               
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
    });
});




/* Return */

$(function(){
    $('#productBarcodeReturn').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var productBarcode = $('#productBarcodeReturn').val();
        var salePrice = $('#salePriceReturn').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/allProductsAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'productBarcode' : productBarcode,
                'salePrice' : salePrice
            },
            success: function(data){ 
                console.log(data);
                var id = $('#productBarcodeReturn').val();
                var index = data.findIndex(x => x.productBarcode == id);
                var salePrice = Number(data[index].salePrice);
                $('#salePriceReturn').val(salePrice);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });
    $('#productBarcodeSale').bind('change', function() {
        var token = $('input[name=_token]').val(); 
        var productBarcode = $('#productBarcodeSale').val();
        var salePrice = $('#salePriceSale').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:  '/admin/allProductsAjax',
            dataType: 'json',
            data: {
                '_token' : token,
                'productBarcode' : productBarcode,
                'salePrice' : salePrice
            },
            success: function(data){ 
                console.log(data);
                var id = $('#productBarcodeSale').val();
                var index = data.findIndex(x => x.productBarcode == id);
                var salePrice = Number(data[index].salePrice);
                $('#salePriceSale').val(salePrice);
            },
            error: function(data) {
                alert(data.responseText);
            }
        });        
    });
    $('#returnSubmit').on("click", function(event){
        event.preventDefault();
        var token = $('input[name=_token]').val(); 
        var productBarcodeReturn = $('#productBarcodeReturn').val();
        var quantityReturn = $('#quantityReturn').val();
        $("#quantity_errors").hide();
        $("#quantity_errors").html("");
        $.ajax({
            type: "POST",
            url:  '/admin/return/addReturn',
            dataType: 'json',
            data: {
                '_token' : token,
                'productBarcodeReturn' : productBarcodeReturn,
                'quantityReturn' : quantityReturn,
            },
            success: function(data){
                if(data.total_quantity > 0 && data.proQuantity == data.total_quantity){
                    console.log(data);
                    var productBarcode = data.productBarcode;
                    var product_id = data.product_id;
                    var name = data.name;
                    var salePrice = Number($('#salePriceReturn').val());
                    var special_price = Number($('#special_price_return').val());
                    
                    if(!$('#special_price_return').val()){
                        var price = (+salePrice);
                    }else{
                        price = (+special_price);
                    }
                    var qty = data.quantity;
                    var qtyId="qty"+product_id;
                    var subTotalId="subTotal"+product_id;
                    var oldQty=$("#"+qtyId).val();
                    var oldSubtotal=(+oldQty)*(+price);
                    var subTotal = (+price)*(+qty);

                    var old_totalQty=Number($("#totalItemsReturn").val());
                    old_totalQty=(+old_totalQty)+(+qty);
                    old_totalQty=(+old_totalQty)-(+oldQty);
                    $("#totalItemsReturn").val(old_totalQty);
                    $("#"+qtyId).val(qty);
                    $("#"+subTotalId).html(subTotal);
                    $("#price"+product_id).html(price);
                    if(old_totalQty>0){
                        $('#noItemRow').hide();
                    }

                    var old_totalPrice=Number($("#subTotalReturn").val().replace(",",""));
                    old_totalPrice=(+old_totalPrice)-(+oldSubtotal);
                    old_totalPrice=(+old_totalPrice)+(+subTotal);
                    $("#subTotalReturn").val(old_totalPrice);
                    // $("#totalBill").val(old_totalPrice);
                    // $("#grandTotal").val(old_totalPrice);
                    $('#quantityReturn').val(1);
                    $('#productBarcodeReturn').val('');
                    $('#productBarcodeReturn').attr('autofocus', 'autofocus');
                    $('#special_price_return').val('');
                    $('#salePriceReturn').val('');
                    var uniqueQuantity = Number(data.uniqueQuantity);
                    $('#uniqueItemReturn').val(uniqueQuantity);
                }else{
                    console.log(data);
                    var productBarcode = data.productBarcode;
                    var product_id = data.product_id;
                    var name = data.name;
                    var rowId = data.rowid;
                    var salePrice = $('#salePriceReturn').val();
                    var special_price = Number($('#special_price_return').val());

                    if(!$('#special_price_return').val()){
                        var price = (+salePrice);
                    }else{
                        price = (+special_price);
                    }
                    var qty = data.quantity;
                    var total_quantity = data.total_quantity;
                    var total_quantityId="qty"+product_id;
                    var subTotalId="subtotal"+product_id;
                    var oldQty=$("#"+qtyId).val();
                    var oldSubtotal=(+oldQty)*(+price);
                    var subTotal = (+price)*(+qty);
                    $('#returnTable').append(`
                        <tr class="animated slideInUp" id="tableRow${product_id}">
                            <td id="name${product_id}">${name}</td>
                            <td style="width:20%;" id="quantity${product_id}">
                                <div class="input-group">
                                    <input class="form-control form-control-sm" type="number" value="${qty}" id="qty${product_id}" style="width:50px;" onchange="chageReturnProductQty('${product_id}','${qty}','${rowId}', '${total_quantity}')" name="qty${product_id}" >
                                </div>
                                <div id="qtyError${product_id}" class="invalid-feedback"></div>
                            </td>
                            <td id="price${product_id}">${price}</td>
                            <td id="subTotal${product_id}">${subTotal}</td>
                            <td id="removeRow${product_id}">
                                <a onclick="delete_returnProduct_row('${rowId}','${product_id}','${price}')"  class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    `);

                    var old_totalQty=Number($("#totalItemsReturn").val());
                    old_totalQty=(+old_totalQty)+(+qty);
                    $("#totalItemsReturn").val(old_totalQty);

                    if(old_totalQty>0){
                        $('#noItemRow').hide();
                    }
                    var old_totalPrice=Number($("#subTotalReturn").val().replace(",",""));
                    old_totalPrice=(+old_totalPrice)+(+subTotal);
                    //alert(old_totalPrice);
                    $("#subTotalReturn").val(old_totalPrice);
                    // $("#totalBill").val(old_totalPrice);
                    // $("#grandTotal").val(old_totalPrice);
                    $('#quantityReturn').val(1);
                    $('#productBarcodeReturn').val('');
                    $('#productBarcodeReturn').attr('autofocus', 'autofocus');
                    $('#special_price_return').val('');
                    $('#salePriceReturn').val('');
                    var uniqueQuantity = Number(data.uniqueQuantity);
                    $('#uniqueItemReturn').val(uniqueQuantity++);
                }                
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
    });

    $('#saleSubmit').on("click", function(event){
        event.preventDefault();
        var token = $('input[name=_token]').val(); 
        var productBarcodeSale = $('#productBarcodeSale').val();
        var quantitySale = $('#quantitySale').val();
        $("#quantity_errors").hide();
        $("#quantity_errors").html("");
        $.ajax({
            type: "POST",
            url:  '/admin/return/addSale',
            dataType: 'json',
            data: {
                '_token' : token,
                'productBarcodeSale' : productBarcodeSale,
                'quantitySale' : quantitySale,
            },
            success: function(data){
                if(data.total_quantity > 0){
                    if(data.past_buy === true){
                        console.log(data);
                        var productBarcode = data.productBarcode;
                        var product_id = data.product_id;
                        var name = data.name;
                        var salePrice = Number($('#salePriceSale').val());
                        var special_price = Number($('#special_price_sale').val());
                        
                        if(!$('#special_price_sale').val()){
                            var price = (+salePrice);
                        }else{
                            price = (+special_price);
                        }
                        var qty = data.quantity;
                        var qtyId="qty"+product_id;
                        var subTotalId="subTotal"+product_id;
                        var oldQty=$("#"+qtyId).val();
                        var oldSubtotal=(+oldQty)*(+price);
                        var subTotal = (+price)*(+qty);

                        var old_totalQty=Number($("#totalItemsSale").val());
                        old_totalQty=(+old_totalQty)+(+qty);
                        old_totalQty=(+old_totalQty)-(+oldQty);
                        $("#totalItemsSale").val(old_totalQty);
                        $("#"+qtyId).val(qty);
                        $("#"+subTotalId).html(subTotal);
                        $("#price"+product_id).html(price);
                        if(old_totalQty>0){
                            $('#noItemRow').hide();
                        }

                        var old_totalPrice=Number($("#subTotalSale").val().replace(",",""));
                        old_totalPrice=(+old_totalPrice)-(+oldSubtotal);
                        old_totalPrice=(+old_totalPrice)+(+subTotal);
                        $("#subTotalSale").val(old_totalPrice);
                        // $("#totalBill").val(old_totalPrice);
                        // $("#grandTotal").val(old_totalPrice);
                        $('#quantitySale').val(1);
                        $('#productBarcodeSale').val('');
                        $('#productBarcodeSale').attr('autofocus', 'autofocus');
                        $('#special_price_sale').val('');
                        $('#salePriceSale').val('');
                        var uniqueQuantity = Number(data.uniqueQuantity);
                        $('#uniqueItemSale').val(uniqueQuantity);
                    }else{
                        console.log(data);
                        var productBarcode = data.productBarcode;
                        var product_id = data.product_id;
                        var name = data.name;
                        var rowId = data.rowid;
                        var salePrice = $('#salePriceSale').val();
                        var special_price = Number($('#special_price_sale').val());

                        if(!$('#special_price_sale').val()){
                            var price = (+salePrice);
                        }else{
                            price = (+special_price);
                        }
                        var qty = data.quantity;
                        var total_quantity = data.total_quantity;
                        var total_quantityId="qty"+product_id;
                        var subTotalId="subtotal"+product_id;
                        var oldQty=$("#"+qtyId).val();
                        var oldSubtotal=(+oldQty)*(+price);
                        var subTotal = (+price)*(+qty);
                        $('#saleTable').append(`
                            <tr class="animated slideInUp" id="tableRow${product_id}">
                                <td id="name${product_id}">${name}</td>
                                <td style="width:20%;" id="quantity${product_id}">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" type="number" value="${qty}" id="qty${product_id}" style="width:50px;" onchange="chageSaleQty('${product_id}','${qty}','${rowId}', '${total_quantity}')" name="qty${product_id}" >
                                    </div>
                                    <div id="qtyError${product_id}" class="invalid-feedback"></div>
                                </td>
                                <td id="price${product_id}">${price}</td>
                                <td id="subTotal${product_id}">${subTotal}</td>
                                <td id="removeRow${product_id}">
                                    <a onclick="delete_sale_row('${rowId}','${product_id}','${price}')"  class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        `);

                        var old_totalQty=Number($("#totalItemsSale").val());
                        old_totalQty=(+old_totalQty)+(+qty);
                        $("#totalItemsSale").val(old_totalQty);

                        if(old_totalQty>0){
                            $('#noItemRow').hide();
                        }
                        var old_totalPrice=Number($("#subTotalSale").val().replace(",",""));
                        old_totalPrice=(+old_totalPrice)+(+subTotal);
                        //alert(old_totalPrice);
                        $("#subTotalSale").val(old_totalPrice);
                        // $("#totalBill").val(old_totalPrice);
                        // $("#grandTotal").val(old_totalPrice);
                        $('#quantitySale').val(1);
                        $('#productBarcodeSale').val('');
                        $('#productBarcodeSale').attr('autofocus', 'autofocus');
                        $('#special_price_sale').val('');
                        $('#salePriceSale').val('');
                        var uniqueQuantity = Number(data.uniqueQuantity);
                        $('#uniqueItemSale').val(uniqueQuantity++);
                    }                
                }else {
                    $("#quantity_errors").show();
                    $("#quantity_errors").html(data.errors);
                }                
            },
            error: function(data) {
                console.log(data.responseText);
            }
        });
    });
});

function delete_returnProduct_row(rowId,id,price){
    var token = $('input[name=_token]').val(); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url:  '/admin/return/removeItemReturn/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId
        },
        success: function(data) {
            console.log(data);
            var qid="qty"+id;
            var input_qty = $("#"+qid).val();
            var sub_total=(+input_qty)*price;

            var old_totalQty=$("#totalItemsReturn").val();
            old_totalQty=(+old_totalQty)-(+input_qty);
            $("#totalItemsReturn").val(old_totalQty);

            if(old_totalQty<1){
                $('#noItemRow').show();
            }
            var old_totalPrice=$("#subTotalReturn").val();
            old_totalPrice=(+old_totalPrice)-(+sub_total);
            $("#subTotalReturn").val(old_totalPrice);
            // $("#totalBill").val(old_totalPrice);
            // $("#grandTotal").val(old_totalPrice);

            $('#tableRow'+id).remove();
            if(old_totalQty == 0){
                $('#grandTotal').val('');
                $('#additionalCost').val(0);
                $('#discount').val(0);
                $('#previousDue').val(0);
                $('#client_id').val('');
            }

            var uniqueQuantity = Number(data.uniqueQuantity);
            $('#uniqueItemReturn').val(uniqueQuantity--);
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });
}
function delete_sale_row(rowId,id,price){
    var token = $('input[name=_token]').val(); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url:  '/admin/return/removeItemSale/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId
        },
        success: function(data) {
            console.log(data);
            var qid="qty"+id;
            var input_qty = $("#"+qid).val();
            var sub_total=(+input_qty)*price;

            var old_totalQty=$("#totalItemsSale").val();
            old_totalQty=(+old_totalQty)-(+input_qty);
            $("#totalItemsSale").val(old_totalQty);

            if(old_totalQty<1){
                $('#noItemRow').show();
            }
            var old_totalPrice=$("#subTotalSale").val();
            old_totalPrice=(+old_totalPrice)-(+sub_total);
            $("#subTotalSale").val(old_totalPrice);
            // $("#totalBill").val(old_totalPrice);
            // $("#grandTotal").val(old_totalPrice);

            $('#tableRow'+id).remove();
            if(old_totalQty == 0){
                $('#grandTotal').val('');
                $('#additionalCost').val(0);
                $('#discount').val(0);
                $('#previousDue').val(0);
                $('#client_id').val('');
            }

            var uniqueQuantity = Number(data.uniqueQuantity);
            $('#uniqueItemSale').val(uniqueQuantity--);
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });
}

function chageReturnProductQty(id, oldQty, rowId, totalQuantity){ 
    var token = $('input[name=_token]').val();      
    var price = Number($("#price"+id).html());     
    var qid="qty"+id;
    var subid="subTotal"+id;
    var qty = Number($("#"+qid).val());

    $.ajax({
        type: "POST",
        url: '/admin/return/changeReturnProductQuantity/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId,
            'qty': qty,
        },
        success: function(data) {
            if (data) {
                /*var qid="qty"+id;
                var qty = Number($("#"+qid).val());*/
                /*console.log(data);
                console.log(qty);*/
                if(qty > totalQuantity){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else if(qty < 1){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else{
                    $("#qtyError"+id).hide();
                    var old_qty = data.old_qty;

                    var sub_total=qty*price;
                    var old_sub_total=old_qty*price;

                    $("#"+qid).val(qty);
                    $("#"+subid).html(sub_total);

                    var old_totalQty= Number($("#totalItemsReturn").val());
                    old_totalQty =  (+old_totalQty) + qty - (+old_qty);
                    $("#totalItemsReturn").val(old_totalQty);

                    var old_totalPrice=$("#subTotalReturn").val();                        
                    old_totalPrice=(+old_totalPrice)+(+sub_total)-(+old_sub_total);
                    $("#subTotalReturn").val(old_totalPrice);
                }
            }
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });    
}
function chageSaleQty(id, oldQty, rowId, totalQuantity){ 
    var token = $('input[name=_token]').val();      
    var price = Number($("#price"+id).html());     
    var qid="qty"+id;
    var subid="subTotal"+id;
    var qty = Number($("#"+qid).val());

    $.ajax({
        type: "POST",
        url: '/admin/return/changeSaleQuantity/'+rowId,
        dataType: 'json',
        data: {
            '_token' : token,
            'rowId': rowId,
            'qty': qty,
        },
        success: function(data) {
            if (data) {
                /*var qid="qty"+id;
                var qty = Number($("#"+qid).val());*/
                /*console.log(data);
                console.log(qty);*/
                if(qty > totalQuantity){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else if(qty < 1){
                    var old_qty = data.old_qty;
                    $("#qtyError"+id).show();
                    $("#qtyError"+id).html(data.errors);
                    Number($("#"+qid).val(old_qty));
                }else{
                    $("#qtyError"+id).hide();
                    var old_qty = data.old_qty;

                    var sub_total=qty*price;
                    var old_sub_total=old_qty*price;

                    $("#"+qid).val(qty);
                    $("#"+subid).html(sub_total);

                    var old_totalQty= Number($("#totalItemsSale").val());
                    old_totalQty =  (+old_totalQty) + qty - (+old_qty);
                    $("#totalItemsSale").val(old_totalQty);

                    var old_totalPrice=$("#subTotalSale").val();                        
                    old_totalPrice=(+old_totalPrice)+(+sub_total)-(+old_sub_total);
                    $("#subTotalSale").val(old_totalPrice);
                }
            }
        },
        error: function(data) {
            console.log(data.responseText);
        }
    });    
}