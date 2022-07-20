/**
 *  By Mark Chovava
 */
 $(document).on('click', '.product__results li', function(e){
    let currency = $('.currency__value').val();
    let currency_number = Number(currency);
    let search_insert = $(this).closest('.product__search').find('.product__name');
    let product_name = $(this).text();
    let product_id = $(this).attr('id');
    let product_discount = $(this).attr('discount');
    let product_priceUsd = $(this).attr('price');
    let product_totalQuantity = $(this).attr('quantity'); 
    let product_list = $(this).closest('.product__results');
    /* Calculate */
    let price_number = Number(product_priceUsd);
    let discount_number = Number(product_discount);
    let discount_Calculate = (discount_number / 100) * price_number;
    let price_numberCents = price_number - discount_Calculate; // Final Price
    let price_usdValue = price_numberCents / 100;
    let price_decimal = price_usdValue.toFixed(2); // Final price divided by 100 with decimals
    /* ZWL */
    let price_zwlCents = price_numberCents * currency_number;
    let price_zwlValue = price_zwlCents / 100;
    let price_zwlDecimal = price_zwlValue.toFixed(2);
    /* Duplicate */
    var product_item = $(".product__item:first");
    let product_itemInsert = $(".product__itemInsert")
    let item_clone = product_item.clone();
    item_clone.removeClass('display__none');
    let product_nameInsert = item_clone.find('.product__name');
    let product_nameValueInsert = item_clone.find('.product__nameValue');
    let product_idInsert = item_clone.find('.product__idValue');
    let product_usdInsert = item_clone.find('.product__usd');
    let product_usdCentsInsert = item_clone.find('.product__usdCentsValue');
    let product_zwlInsert = item_clone.find('.product__zwl');
    let product_zwlCentsInsert = item_clone.find('.product__zwlCentsValue');
    let product_totalQuantityInsert = item_clone.find('.product__totalQuantity');
    let product_totalQuantityValueInsert = item_clone.find('.product__totalQuantityValue');
    let product_quantityInsert = item_clone.find('.product__quantity');
    let product_usdTotalInsert = item_clone.find('.product__priceUsdTotal');
    let product_zwlTotalInsert = item_clone.find('.product__priceZwlTotal');

    let no_result = "No Results.";
    if(product_name.toString() !== no_result){
        
        // Search insert
        search_insert.val(product_name)
        // Insert Product Name to list 
        product_nameInsert.text(product_name);
        product_nameValueInsert.attr('name', 'product_name[]').val(product_name);
         //Insert Add Product Id 
        product_idInsert.attr('name', 'product_id[]').val(product_id);
        // Insert Product Price to list 
        product_usdInsert.text(price_decimal);
        product_usdCentsInsert.attr('name', 'product_unit_price[]').val(price_numberCents);
        // Insert ZWL 
        product_zwlInsert.text(price_zwlDecimal);
        product_zwlCentsInsert.attr('name', 'product_zwl_unit_price[]').val(price_zwlCents);
        // Insert Product Quantity to list 
        product_totalQuantityInsert.text(product_totalQuantity);
        product_totalQuantityValueInsert.attr('name', 'product_totalQuantity[]').val(product_totalQuantity);
        // Single Product
        product_quantityInsert.attr('name', 'product_quantity[]');
        // Product Total 
        product_usdTotalInsert.attr('name', 'product_total[]');
        product_zwlTotalInsert.attr('name', 'product_zwl_total[]');
        
        /* Append */
        $(".product__itemInsert").append(item_clone); 
    } else{
        return false;
        product_list.empty().removeClass('display__block');
    }
    product_list.empty().removeClass('display__block');
   
});
$('.search__btn').click(function(e){
    e.preventDefault();
    if(this.id == "search__btn"){
        var product_name = $(this).closest('.product__search').find('.product__name').val();
        var product_results = $(this).closest('.product__search').find('.product__results');       
        let product_search = $(this).attr('href');
        if( product_name != "" ){
            product_results.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                url: product_search,
                method: "GET",
                dataType: "json",
                data: { name: product_name },
                success: function(res){
                    console.log(res.product);
                    if(res.product.length > 0){
                        product_results.empty();
                        for(var i = 0; i < res.product.length; i++){
                            $.each(res, function () {
                                product_results.append(
                                    '<li price="' + (res.product[i].price) + 
                                    '" quantity="' + res.product[i].inventories.in_store_quantity + 
                                    '" id="' + res.product[i].id + '" ' +
                                    'discount="' + res.product[i].discounts.discount_percent +
                                    '">' + res.product[i].name + 
                                    ' </li>'
                                );
                            });
                        }
                    } else{
                        product_results.empty();
                        product_results.append('<li class="text-danger">No Results.</li>');
                    }
                }
            }); 
        }
    }
});

$(document).on('change', '.product__quantity', function(e){
    //e.preventDefault();
    //alert('Hre')
    let currency = $('.currency__value').val();
    let currency_number = Number(currency);
    let quantity_counter = $(this).val();
    let quantity = Number(quantity_counter);
    let usd_centsValue = $(this).closest('.product__item, .product__row').find('.product__usdCentsValue').val();
    let usd_centsNumber = Number(usd_centsValue);
    let product_priceUsdTotalInsert = $(this).closest('.product__item, .product__row').find('.product__priceUsdTotal');
    let product_priceZwlTotalInsert = $(this).closest('.product__item, .product__row').find('.product__priceZwlTotal');
    let product_totalUsdCents = Number(quantity) * Number(usd_centsNumber);
    let product_totalZwlCents = Number(product_totalUsdCents) * Number(currency_number);
    product_priceUsdTotalInsert.val(product_totalUsdCents);
    product_priceZwlTotalInsert.val(product_totalZwlCents);
});
   

$('.calculate__total').click((e) => {
    let currency = $('.currency__value').val();
    var total_usdInsert = $('.total__usd');
    var total_usdCentsInsert = $('.total__usdCents');
    var total_zwlInsert = $('.total__zwl');
    var total_zwlCentsInsert = $('.total__zwlCents');
    let usd_centsValue = new Array();
    $('.product__priceUsdTotal').each((i, item) => {
        usd_centsValue.push(item.value);
    }); 
    let subtotal_usdCents = usd_centsValue.reduce((a, b) => Number(a) + Number(b));
    let subtotal_usd = Number(subtotal_usdCents) / 100;
    let subtotal_usdDecimal = subtotal_usd.toFixed(2);
    let subtotal_zwlCents = Number(subtotal_usdCents) * Number(currency);
    let subtotal_zwl = Number(subtotal_zwlCents) / 100;
    let subtotal_zwlDecimal = subtotal_zwl.toFixed(2);
    total_usdInsert.text(subtotal_usdDecimal);
    total_usdCentsInsert.val(subtotal_usdCents);
    total_zwlInsert.text(subtotal_zwlDecimal);
    total_zwlCentsInsert.val(subtotal_zwlCents);
});

/**
 *  Remove product Item
 * To be removed in Db first.
 */
$(document).on('click', '.remove__productItem', function(e){
    e.preventDefault();
    let item__remove = $(this).closest('.product__row').remove();
});




