
    /* Data Insert */

    /* let currency = $('.currency__value').val();
    var total_usdInsert = $('.total__usd');
    var total_usdCentsInsert = $('.total__usdCents');
    var total_zwlInsert = $('.total__zwl');
    var total_zwlCentsInsert = $('.total__zwlCents');
    let usd_centsValue = new Array();
    $('.product__usdCentsValue').each((i, item) => {
        usd_centsValue.push(item.value);
    });  */
    /**
     *  Calculations and display 
     *  Diplay Usd
    **/
    /*let subtotal_usdCents = usd_centsValue.reduce((a, b) => Number(a) + Number(b));
    total_usdCentsInsert.val(subtotal_usdCents);
    let subtotal_usdCalculate = subtotal_usdCents / 100;
    let subtotal_usdDecimal = subtotal_usdCalculate.toFixed(2);
    total_usdInsert.text(subtotal_usdDecimal) */
    /* Calculate and display ZWL */
    /* let subtotal_zwl = subtotal_usdCents * Number(currency);
    let subtotal_zwlCalculate = subtotal_zwl / 100;
    let subtotal_zwlDecimal = subtotal_zwlCalculate.toFixed(2);
    total_zwlInsert.text(subtotal_zwlDecimal);
    total_zwlCentsInsert.val(subtotal_zwl); */


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


    $(document).on('click', '.product__results li', function(e){
        let currency = $('.currency__value').val();
        let currency_number = Number(currency);
        let search_insert = $(this).closest('.product__search').find('.product__name');
        let product_name = $(this).text();
        let product_id = $(this).attr('id');
        let product_discount = $(this).attr('discount');
        let product_priceUsd = $(this).attr('price');
        let product_quantity = $(this).attr('quantity'); 
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
        let product_quantityInsert = item_clone.find('.product__quantity');
        let product_quantityValueInsert = item_clone.find('.product__quantityValue');

        let no_result = "No Results.";
        if(product_name.toString() !== no_result){
            search_insert.val(product_name)
            // Insert Product Name to list 
            product_nameInsert.text(product_name);
            product_nameValueInsert.val(product_name);
             //Insert Add Product Id 
            product_idInsert.val(product_id);
            // Insert Product Price to list 
            product_usdInsert.text(price_decimal);
            product_usdCentsInsert.val(price_numberCents);
            // Insert ZWL 
            product_zwlInsert.text(price_zwlDecimal);
            product_zwlCentsInsert.val(price_zwlCents);
            // Insert Product Quantity to list 
            product_quantityInsert.text(product_quantity);
            product_quantityValueInsert.val(product_quantity);
            /* Append */
            product_itemInsert.append(item_clone); 
        } else{
            return false;
            product_list.empty().removeClass('display__block');
        }
        product_list.empty().removeClass('display__block');
       
    });

    $(document).on('change', 'input[name="product_quantity"]', function(e){
        //e.preventDefault();
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
   

    /*$('input[name="product_quantity"]').change(function(e){
        e.preventDefault();
        let currency = $('.currency__value').val();
        let currency_number = Number(currency);
        let quantity_counter = $(this).val();
        let quantity = Number(quantity_counter);
        let usd_centsValue = $(this).closest('.product__item').find('.product__usdCentsValue').val();
        let product_priceUsdTotalInsert = $(this).closest('.product__item').find('.product__priceUsdTotal');
        let product_priceZwlTotalInsert = $(this).closest('.product__item').find('.product__priceZwlTotal');
        let usd_centsNumber = Number(usd_centsValue);
        let product_usdTotal = quantity * usd_centsNumber;
        let zwl_centsCalculate = product_usdTotal * currency_number;
        let zwl_centsDecimal = zwl_centsCalculate.toFixed(2);
        product_priceUsdTotalInsert.val(product_usdTotal);
        product_priceZwlTotalInsert.val(zwl_centsCalculate);
        //alert(product_usdTotal)
        //console.log(product_usdTotal)

    }); */

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

    /* $('.calculate__total').click((e) => {
        e.preventDefault();
        let product_priceUsdTotal = $('.product__priceUsdTotal').val();
        let product_priceZwlTotal = $('.product__priceZwlTotal').val();
        let currency = $('.currency__value').val();
        var total_usdCentsInsert = $('.total__usdCents');
        let usd_centsValue = new Array();
        $('.product__priceUsdTotal').each((i, item) => {
            usd_centsValue.push(item.value);
        }); 
        /**
         *  Calculations and display 
         *  Display Usd
        **/
        /* let subtotal_usdCents = usd_centsValue.reduce((a, b) => Number(a) + Number(b));
        let subtotal_usdCalculate = subtotal_usdCents / 100;
        let subtotal_usdDecimal = subtotal_usdCalculate.toFixed(2);
        total_usdInsert.text(subtotal_usdDecimal)
        total_usdCentsInsert.val(subtotal_usdCents); */
        /* Calculate and display ZWL */
        /*let subtotal_zwl = subtotal_usdCents * Number(currency);
        let subtotal_zwlCalculate = subtotal_zwl / 100;
        let subtotal_zwlDecimal = subtotal_zwlCalculate.toFixed(2);
        total_zwlInsert.text(subtotal_zwlDecimal);
        total_zwlCentsInsert.val(subtotal_zwl);
    }); */
    /**
     *  Add Product Item
     * To be send and saved in DB
     */
    /* $('.add__productItem').click((e) => {
        e.preventDefault();
        var product_item = $(".product__item:first");
        var item_clone = product_item.clone(true);
        item_clone.removeClass('display__none');

        let product_itemInsert = $(".product__itemInsert");
        product_itemInsert.append(item_clone);
    }); */

    /**
    *  Search the DB for product 
    **/
   

    /* $(document).on('click', '.product__results li', function(e){
        /* Data Collection */
        /* let currency = $('.currency__value').val();
        let search_insert = $(this).closest('.product__search').find('.product__name');
        let product_name = $(this).text();
        let product_id = $(this).attr('id');
        let product_discount = $(this).attr('discount');
        let product_priceUsd = $(this).attr('price');
        let product_quantity = $(this).attr('quantity');
        let product_list = $(this).closest('.product__results'); */
        /* Data Insert Area */
        /* let product_item = $(".product__item:first");
        let product_nameInsert = product_item.find('.product__name');
        let product_nameValueInsert = product_item.find('.product__nameValue');
        let product_idInsert = product_item.find('.product__idValue');
        let product_usdInsert = product_item.find('.product__usd');
        let product_usdCentsInsert = product_item.find('.product__usdCentsValue');
        let product_zwlInsert = product_item.find('.product__zwl');
        let product_zwlCentsInsert = product_item.find('.product__zwlCentsValue');
        let product_quantityInsert = product_item.find('.product__quantity');
        let product_quantityValueInsert = product_item.find('.product__quantityValue'); */
        /** 
         * Calculations 
         * USD
         **/
        /* let product_discountNumber = Number(product_discount);
        let product_usdNumber = Number(product_priceUsd);
        let discount = (product_discountNumber / 100) * product_usdNumber;
        let price_usdCents = product_usdNumber - discount;
        let price_usdCalculate = (product_usdNumber - discount) / 100;
        let price_usdDecimal = price_usdCalculate.toFixed(2); */
        /* ZWL */
        /* let product_zwlCents = price_usdCents * Number(currency);
        let product_zwlCalculate = product_zwlCents / 100;
        let product_zwlDecimal = product_zwlCalculate.toFixed(2); */
        
       /*  if(product_item != "No Results."){
            search_insert.val(product_name) */
            /* Insert Product Name to list 
            product_nameInsert.text(product_name);
            product_nameValueInsert.val(product_name);
            /* Insert Add Product Id 
            product_idInsert.val(product_id);
            /* Insert Product Price to list 
            product_usdInsert.text(price_usdDecimal);
            product_usdCentsInsert.val(price_usdCents);
            /* Insert ZWL 
            product_zwlInsert.text(product_zwlDecimal);
            product_zwlCentsInsert.val(product_zwlCents);
            /* Insert Product Quantity to list 
            product_quantityInsert.text(product_quantity);
            product_quantityValueInsert.val(product_quantity);
        }else{
            product_list.empty().removeClass('display__block');
        }
        product_list.empty().removeClass('display__block');
    }); */

    /**
     *  Remove product Item
     * To be removed in Db first.
     */
    $(document).on('click', '.remove__productItem', function(e){
        e.preventDefault();
        let item__remove = $(this).closest('.product__item').remove();
    });




