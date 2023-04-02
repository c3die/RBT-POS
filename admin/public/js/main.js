var $el = $("body");
(function($) {

    $(document).ready(function(){
        $("#code_product").on("keyup",function(e){
            e.preventDefault();
            var code = $(this).val();
            var code = code.toUpperCase();
            $(this).val(code);
            $.ajax({
                url: $("base").attr("url") + 'product/check_id',
                data: {
                    'id' : code
                },
                type: 'POST',
                success: function(data){
                    if(data == 'unavailable'){
                        $("#code_product").addClass("status-error");
                        $("#status_code").text('ID Code Not Available, Please Try Another!!');
                    }else{
                        $("#code_product").removeClass("status-error");
                        $("#status_code").text('');
                    }
                },
                error: function(){
                    alert('Something Error');
                }
            });
        });
       $("#code_category").on("keyup",function(e){
           e.preventDefault();
           var code = $(this).val();
           var code = code.toUpperCase();
           $(this).val(code);
           $.ajax({
               url: $("base").attr("url") + 'category/check_id',
               data: {
                   'id' : code
               },
               type: 'POST',
               success: function(data){
                   if(data == 'unavailable'){
                       $("#code_category").addClass("status-error");
                       $("#status_code").text('ID Code Not Available, Please Try Another!!');
                   }else{
                       $("#code_category").removeClass("status-error");
                       $("#status_code").text('');
                   }
               },
               error: function(){
                   alert('Something Error');
               }
           });
       });
       $("#submit-transaction").on('click',function(e){
            e.preventDefault();
    var form = document.getElementById("transaction-form");

    form.action = "add_process";
    form.submit();

    form.action = "insert_log";
    form.submit();


  }); $("#submit-transaction1").on('click',function(e){
            e.preventDefault();
    var form = document.getElementById("transaction-form");

    form.action = "Transaction/add_process";
    form.submit();

    form.action = "insert_log";
    form.submit();


  });
        $("#code_transaction").on("keyup",function(e){
            e.preventDefault();
            var code = $(this).val();
            var code = code.toUpperCase();
            var origin = $(this).attr('data-origin');
            $(this).val(code);
            if(origin !== code) {
                $.ajax({
                    url: $("base").attr("url") + 'transaction/check_id',
                    data: {
                        'id': code
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data == 'unavailable') {
                            $("#code_transaction").addClass("status-error");
                            $("#code_transaction").attr("data-attr", "false");
                            $("#status_code").text('ID Code Not Available, Please Try Another!!');
                        } else {
                            $("#code_transaction").removeClass("status-error");
                            $("#code_transaction").attr("data-attr", "true");
                            $("#status_code").text('');
                        }
                    },
                    error: function () {
                        alert('Something Error');
                    }
                });
            }
        });
        $("#transaction_category_id").on("change",function(e){
            e.preventDefault();
            var url =  $("base").attr("url") + 'transaction/check_category_id/' + this.value;
            $.get(url, function(data, status){
                if(status == 'success'){
                    var arr = $.parseJSON(data);
                    $("#transaction_product_id").text("");
                    $("#sale_price").text("");
                    $("#buying_price").text("");
                  
                    $.each(arr, function(key,value){
                        var default_value = '';
                        if(key == 0){
                            var default_value = '<option value="0">Please Select a Product</option>';
                        }
                        var opt_value = '<option value="'+value.id+'">'+value.product_name+','+value.product_desc+','+value.product_qty+','+value.sale_price+'</option>';
                        $('#transaction_product_id').append(default_value+opt_value);
                    });
                }
            });
        });
       
        $("#transaction_product_id").on("change",function(e){
            e.preventDefault();
            var url =  $("base").attr("url") + 'transaction/check_product_id/' + this.value;
            $("#sale_price").text(""); 
            $("#net_unit_price1").text(""); 
            $("#buying_price").text(""); 
           
            $.get(url, function(data, status) {
                if(status == 'success' && data != 'false') {
                    var value = $.parseJSON(data);
                    
                    var val = value[0];
                    var sale_value = '<option >' + (parseFloat(val.sale_price)) + ' </option>';
                  
                    var buyingp_value = '<option >' + (val.buying_price) + '</option >';
                    $('#sale_price').append(sale_value);
                    $('#buying_price').append(buyingp_value);
                    $('#net_unit_price1').append(net_unit_price1_value);
                    
                }
                var input = document.getElementById('disc_1');
                input.focus();
                input.select();
               
            });
        });
    });
   
    $("#sale_price").change(function() {
        var textval = $(":selected",this).val();
        $('input[name=net_unit_price1]').val(textval);
    
        // if value is selected, text field is readonly
        net_unit_price1.disabled=(!textval) ? false : true;
    });

    $("#add-item").on("click",function(e){
        e.preventDefault();

        var product_id = $("#transaction_product_id").val();
        var quantity = $("#sum").val();
       
        var selling_price = $("#selling_price").val();
        var sale_price = $("#sale_price").val();
       
        
        if($('#net_unit_price').length){
            sale_price = $('#net_unit_price').unmask();
        }
        if(product_id !== null && sale_price !== null){ 
            $.ajax({
                url: $("base").attr("url") + 'transaction/add_item',
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                    
                    'selling_price' : selling_price,
                    'sale_price' : sale_price
                },
                type: 'POST',
                beforeSend : function(){
                    $el.faLoading();
                },
                success: function(data){
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";
                        if($('#net_unit_price').length){
                            //row_2 = "colspan='2'";
                        }
                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.category_name +'</td>' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.qty +'</td>' +
                                   
                                    '<td>'+ value.selling_price +'</td>' +
                                    '<th '+row_2+'>₱'+ price(value.subtotal) +'</th>'+
                                    '<td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="'+ key +'">x</span></td>'+
                                    '</tr>';
                        $("#transaction-item tr:last").after(display);
                        
                    });
                    $("#total-purchase").text('₱'+price(res.total_price));
                    
                    $el.faLoading(false);
                    console.log(res);
                    
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });
     $("#add-item").on("click",function(e){
        e.preventDefault();

        var product_id = $("#transaction_product_id").val();
        var quantity = $("#sum").val();
       
        var selling_price = $("#selling_price").val();
        var sale_price = $("#sale_price").val();
       
        
        if($('#net_unit_price').length){
            sale_price = $('#net_unit_price').unmask();
        }
        if(product_id !== null && sale_price !== null){ 
            $.ajax({
                url: $("base").attr("url") + 'transaction/add_item',
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                    
                    'selling_price' : selling_price,
                    'sale_price' : sale_price
                },
                type: 'POST',
                beforeSend : function(){
                    $el.faLoading();
                },
                success: function(data){
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";
                        if($('#net_unit_price').length){
                            //row_2 = "colspan='2'";
                        }
                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.category_name +'</td>' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.qty +'</td>' +
                                   
                                    '<td>'+ value.selling_price +'</td>' +
                                    '<th '+row_2+'>₱'+ price(value.subtotal) +'</th>'+
                                    '<td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="'+ key +'">x</span></td>'+
                                    '</tr>';
                        $("#transaction-item tr:last").after(display);
                        
                    });
                    $("#total-purchase").text('₱'+price(res.total_price));
                    
                    $el.faLoading(false);
                    console.log(res);
                    
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });
    $("#add-item1").on("click",function(e){
        e.preventDefault();

        var product_id = $("#transaction_product_id").val();
        var quantity = $("#sum").val();
        var buying_price = $("#buying_price").val();
        var selling_price = $("#selling_price").val();
        var sale_price = $("#sale_price").val();
       
        
        if($('#net_unit_price1').length){
            sale_price = $('#net_unit_price1').unmask();
        }
        if(product_id !== null && sale_price !== null){ 
            $.ajax({
                url: $("base").attr("url") + 'sales/add_item',
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                    'buying_price' : buying_price,
                    'selling_price' : selling_price,
                    'sale_price' : sale_price
                },
                type: 'POST',
                beforeSend : function(){
                    $el.faLoading();
                },
                success: function(data){
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";
                        if($('#net_unit_price1').length){
                            //row_2 = "colspan='2'";
                        }
                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.category_name +'</td>' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.qty +'</td>' +
                                    '<td>'+ value.price +'</td>' +
                                    '<td>'+ value.buying_price +'</td>' +
                                    '<th '+row_2+'>₱'+ (value.subtotal) +'</th>'+
                                    '<td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="'+ key +'">x</span></td>'+
                                    '</tr>';
                        $("#transaction-item tr:last").after(display);
                        
                    });
                    $("#total-purchase").text('₱'+price(res.total_price));
                    
                    $el.faLoading(false);
                    console.log(res);
                    
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });
    $("#add-item").on("click",function(e){
        e.preventDefault();

        var product_id = $("#transaction_product_id").val();
        var quantity = $("#sum").val();
       
        var selling_price = $("#selling_price").val();
        var sale_price = $("#sale_price").val();
       
        
        if($('#net_unit_price').length){
            sale_price = $('#net_unit_price').unmask();
        }
        if(product_id !== null && sale_price !== null){ 
            $.ajax({
                url: $("base").attr("url") + 'transaction/add_item',
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                    
                    'selling_price' : selling_price,
                    'sale_price' : sale_price
                },
                type: 'POST',
                beforeSend : function(){
                    $el.faLoading();
                },
                success: function(data){
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";
                        if($('#net_unit_price').length){
                            //row_2 = "colspan='2'";
                        }
                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.category_name +'</td>' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.qty +'</td>' +
                                   
                                    '<td>'+ value.selling_price +'</td>' +
                                    '<th '+row_2+'>₱'+ price(value.subtotal) +'</th>'+
                                    '<td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="'+ key +'">x</span></td>'+
                                    '</tr>';
                        $("#transaction-item tr:last").after(display);
                        
                    });
                    $("#total-purchase").text('₱'+price(res.total_price));
                    
                    $el.faLoading(false);
                    console.log(res);
                    
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });

    $(document).on("click",".transaction-delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        $el.faLoading();
        $.get($("base").attr("url") + 'transaction/delete_item/'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    $("#"+rowid).remove();
                    console.log(data);
                    $("#total-purchase").text('₱'+data);
                    $el.faLoading(false);
                }                
            }
        );
    });
    $("#submit-transaction").on('click',function(e){
        e.preventDefault();
        var status = false;
        var method = null;
        var arr = null;

        var transaction_id = $("#code_transaction").val();
        var supplier_id = $("#supplier_id").val();
        var status_id = $("#code_transaction").attr("data-attr");
        if(typeof transaction_id !== "undefined" && transaction_id != ""){
            status = true;
            method = "transaction";
            arr = {
                'transaction_id': transaction_id,
                'supplier_id': supplier_id
            };
            console.log(arr);
        }

        // Sales
        var sales = sales_status();
        if(sales[0] == true){
            status = sales[0];
            method = sales[1];
            arr = sales[2];
        }

        // Return Sales
        var return_sales = return_sales_status();
        if(return_sales[0] == true){
            status = return_sales[0];
            method = return_sales[1];
            arr = return_sales[2];
        }

        if(status == true) {
            $.ajax({
                url: $("#transaction-form").attr("action"),
                data: arr,
                type: 'POST',
                beforeSend: function () {
                    $el.faLoading();
                },
                success: function (data) {
                    var response = $.parseJSON(data);
                    $el.faLoading(false);
                    if(response.status == "ok"){
                        alert("Success!!");
                        window.location.href = $("base").attr("url") + method;
                    }else if(response.status == "limit"){
                        alert("The number of products you have selected is out of stock");
                    }else{
                        alert("An error occurred on the server, please try again");
                    }
                }
            });
        }else{
            alert("Please check your transaction code or supplier!");
        }
    });

      $("#submit-transaction1").on('click',function(e){
        e.preventDefault();
        var status = false;
        var method = null;
        var arr = null;

        var transaction_id = $("#code_transaction").val();
        var supplier_id = $("#supplier_id").val();
        var status_id = $("#code_transaction").attr("data-attr");
        if(typeof transaction_id !== "undefined" && transaction_id != ""){
            status = true;
            method = "Transaction";
            arr = {
                'transaction_id': transaction_id,
                'supplier_id': supplier_id
            };
            console.log(arr);
        }

        // Sales
        var sales = sales_status();
        if(sales[0] == true){
            status = sales[0];
            method = sales[1];
            arr = sales[2];
        }

        // Return Sales
        var return_sales = return_sales_status();
        if(return_sales[0] == true){
            status = return_sales[0];
            method = return_sales[1];
            arr = return_sales[2];
        }

        if(status == true) {
            $.ajax({
                url: $("#transaction-form").attr("action"),
                data: arr,
                type: 'POST',
                beforeSend: function () {
                    $el.faLoading();
                },
                success: function (data) {
                    var response = $.parseJSON(data);
                    $el.faLoading(false);
                    if(response.status == "ok"){
                        alert("Success!!");
                        window.location.href = $("base").attr("url") + method;
                    }else if(response.status == "limit"){
                        alert("The number of products you have selected is out of stock");
                    }else{
                        alert("An error occurred on the server, please try again");
                    }
                }
            });
        }else{
            alert("Please check your transaction code or supplier!");
        }
    });
    $('.datepicker-transaction').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    $("#dues-reset").on("click",function(e){
        e.preventDefault();
        $(this).closest('form').find("input[type=text], textarea").val("");
        $('#dues-date-range option:eq(0)').prop('selected', true);
    });
    /*
    ** Return Sales
     */
    $(".return_sales_qty").on("keyup change",function(e){
        var id = $(this).attr("row-id");
        var qty = $(this).val();
        $.post(
             $("base").attr("url") + 'return_sales/update_cart/'+id,
            {
                qty:qty
            },
            function(data,status){
                var res = $.parseJSON(data);
                $("#total-purchase").text("₱"+price(res.total));
            }
        );
    });


    /*
     ** Return Purchase
     */
    $(".return_purchase_qty").on("keyup change",function(e){
        var id = $(this).attr("row-id");
        var qty = $(this).val();
        $.post(
            $("base").attr("url") + 'Return_purchase/update_cart/'+id,
            {
                qty:qty
            },
            function(data,status){
                var res = $.parseJSON(data);
                $("#total-purchase").text("₱"+price(res.total));
            }
        );
    });

    function sales_status(){
        var data = false;
        var sales_id = $("#sales_id").val();
        var customer_id = $("#customer_id").val();
        var is_cash = $("#is_cash").val();
        if(typeof sales_id !== "undefined" && sales_id != ""){
            var status = true;
            var method = "sales";
            var arr = {
                'sales_id': sales_id,
                'customer_id': customer_id,
                'is_cash' : is_cash
            };
            data = [status,method,arr];
        }
        return data;
    }



    function return_sales_status(){
        var data = false;
        var return_id = $("#return_id").val();
        var return_code = $("#return_code").val();
        var return_date = $("#return_date").val();
        var is_return = $("#is_return").val();
        var return_by = $("#return_by").val();
        if(typeof return_id !== "undefined" && return_code != ""){
            var status = true;
            var method = $("base").attr("class-attr");
            var arr = {
                'return_id': return_id,
                'return_code': return_code,
                'return_date' : return_date,
                'is_return' : is_return,
                'return_by' : return_by
            };
            data = [status,method,arr];
        }
        return data;
    }
    $(document).ready(function() {
        $(".btnPrint").printPage();
        $('.form-price-format').priceFormat({
            prefix: '₱',
            centsSeparator: ',',
            thousandsSeparator: '.',
            centsLimit: 0
        });
        $('.discount-trx').bind("keyup change", function(e){
            //e.preventDefault();
            var next = parseInt($(this).attr('data-attr')) + 1;
            var disc = parseInt($(this).val());
            var disc_unmask = $(this).unmask();

           
            var sale_price = $("#sale_price").unmask();
            var disc1 = $("#disc_1").val();
           
            var final_price = count_discount(sale_price,disc1,);
            $("#net_unit_price").val("₱"+price(final_price));
            $("#selling_price").val(final_price+(final_price * .12));
            $("#net_unit_price").val("₱"+price(final_price));
        });
        $('.discount-trx1').bind("click", function(e){
            //e.preventDefault();
            var next = parseInt($(this).attr('data-attr')) + 1;
            var disc = parseInt($(this).val());
            var disc_unmask = $(this).unmask();

           
            var sale_price = $("#sale_price").unmask();
            var disc1 = $("#disc_1").val();
           
            var final_price = count_discount(sale_price,disc1);
            $("#net_unit_price1").val(price(final_price));
           
            
        });
          $('.discount-trx1').bind("keyup", function(e){
            //e.preventDefault();
            var next = parseInt($(this).attr('data-attr')) + 1;
            var disc = parseInt($(this).val());
            var disc_unmask = $(this).unmask();

           
            var sale_price = $("#sale_price").unmask();
            var disc1 = $("#disc_1").val();
           
            var final_price = count_discount((sale_price,disc1));
            $("#net_unit_price1").val(price(final_price));
           
            
        });


        
    });
})(this.jQuery);

function count_discount(val,disc1){
    var disc_one = val * (disc1/100);
    disc_one = val - disc_one;

  

    return disc_one;
}





function price(input){
    return (input).formatMoney(0,'.',',');
}
Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "₱1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
  function maxLengthCheck(object) {
    if (object.value.length > object.max.length)
      object.value = object.value.slice(0, object.max.length)
  }
    
  function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]|\./;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
  

 
