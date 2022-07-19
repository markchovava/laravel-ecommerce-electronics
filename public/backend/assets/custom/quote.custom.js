
$('.calculate__grandtotal').click(function(e){
    e.preventDefault();
    let product__sum = $(this).closest('tfoot').siblings('tbody').find('.product__sum');
    let product__insertSum_cents = $(this).closest('tfoot').siblings('tbody').find('.product__insertSum_cents');
    let sub__total = $(this).closest('tfoot').find('.sub__total');
    let sub__total_cents = $(this).closest('tfoot').find('.sub__totalCents');
    let quote__tax = $(this).closest('tfoot').find('.quote__tax').val();
    let quote__discount = $(this).closest('tfoot').find('.quote__discount').val();
    let grand__total = $(this).closest('tfoot').find('.grand__total');
    let grand__totalCents = $(this).closest('tfoot').find('.grand__totalCents');

    let product__sumTotal = new Array();
    $('.product__sum').each((i, item) => {
        product__sumTotal.push(item.value);
    }); 
    
    // Sub Total Calculation
    if(product__sumTotal.length == 1){
        var product_singleTotal_cents = Number(product__sumTotal[0]);
        var product_singleTotal = product_singleTotal_cents / 100;
        var subtotal = product_singleTotal.toFixed(2); // For Display
        var subtotal_cents = product_singleTotal_cents; // For calculations
        if( quote__tax != '' || quote__discount != ''){
            if(isNaN(quote__tax) && isNaN(quote__discount)){
                var tax = Number(quote__tax);
                var discount = Number(quote__discount);
            }else{
                var tax = quote__tax;
                var discount = quote__discount;
            }
            var calculate__tax = (tax / 100) * subtotal_cents;
            var calculate__discount = (discount / 100) * subtotal_cents;
            var total__calculator = (subtotal_cents  + calculate__tax) - calculate__discount;
            var grandtotal_cents = total__calculator;
            var grandtotal_calculate = grandtotal_cents / 100;
            var grandtotal = grandtotal_calculate.toFixed(2);
            sub__total.val( subtotal );
            sub__total_cents.val(subtotal_cents);
            grand__total.val( grandtotal );
            grand__totalCents.val(grandtotal_cents); 
            //alert(grand__totalCents.val())       
        } else{
            sub__total.val( subtotal );
            sub__total_cents.val(subtotal_cents);
            grand__total.val( subtotal );
            grand__totalCents.val( subtotal_cents );
            //alert(grand__totalCents.val()) 
        }
    }  
    else
    {
        var product__listTotal_cents = product__sumTotal.reduce((a, b) => Number(a) + Number(b));
        var product__listTotal = product__listTotal_cents / 100;
        var subtotal = product__listTotal.toFixed(2);
        var subtotal_cents = product__listTotal_cents;
        if( quote__tax != '' || quote__discount != ''){
            if(isNaN(quote__tax) && isNaN(quote__discount)){
                var tax = Number(quote__tax);
                var discount = Number(quote__discount);
            }else{
                var tax = quote__tax;
                var discount = quote__discount;
            }
            var calculate__tax = (tax / 100) * subtotal_cents;
            var calculate__discount = (discount / 100) * subtotal_cents;
            var total__calculator = (subtotal_cents  + calculate__tax) - calculate__discount;
            var grandtotal_cents = total__calculator;
            var grandtotal_calculate = grandtotal_cents / 100;
            var grandtotal = grandtotal_calculate.toFixed(2);
            /* Display calculation answers */
            sub__total.val( subtotal );
            sub__total_cents.val(subtotal_cents);
            grand__total.val( grandtotal );
            grand__totalCents.val(grandtotal_cents); 
            //alert(grand__totalCents.html()) 
        } else{
            sub__total.val( subtotal );
            sub__total_cents.val(subtotal_cents);
            grand__total.val( subtotal );
            grand__totalCents.val( subtotal_cents ); 
            //alert(grand__totalCents.html())  
        }
    } 
});

// Clone and Add Product Item
 $(document).on('click', '.add__productItem', function(e){
     e.preventDefault();
     var product__searchItem = $(".product__searchItem");
     var product_searchInput = product__searchItem.find('.product__name').val();
     var product__searchPrice = product__searchItem.find('.product__priceInsert').val();
     
     var product__first = $(".product__item:first");
     var product__firstInput = product__first.find('.product__name');
     var product__firstPrice = product__first.find('.product__priceInsert');
     let product__searchPriceCents = Number(product__searchPrice) * 100;
     product__firstInput.val(product_searchInput);
     product__firstPrice.val(product__searchPrice);
     //Cloning the first tr
     var item__clone = $(".product__item:first").clone();
     item__clone.removeClass('display__none');
     // Adding attributes
     item__clone.find('.product__name').attr('name','product_name[]');
     item__clone.find('.product__descriptionInsert').attr('name','description[]');
     item__clone.find('.product__quantityInsert').attr('name','quantity[]');
     let price__centsName = item__clone.find('.product__priceInsert_cents').attr('name','price_cents[]');
     let price__centsValue = item__clone.find('.product__priceInsert_cents').val(product__searchPriceCents);
     item__clone.find('.product__insertSum + input[type="hidden"]').attr('name','product_total_cents[]').addClass('product__sum');
     $(".product__insertArea").append(item__clone);  
     //alert(price__centsValue.val())   
 });

$(document).on('click', '.remove__productItem', function(e){
    e.preventDefault();
    var item__remove = $(this).closest('.product__item').remove();
});

 $('#search__btn').click(function(e){
    if(this.id == "search__btn"){
        var product_name = $(this).closest('.product__search').find('.product__name').val();
        var product__results = $(this).closest('.product__search').find('.product__results')
        //product__results.addClass('display__block');
        e.preventDefault();
        if( product_name != "" ){
            product__results.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('href'),
                method: "GET",
                dataType: 'json',
                data: {
                    name: product_name,
                },
                success: function(res){
                    console.log(res.product);
                    if(res.product.length > 0){
                        product__results.empty();
                        for(var i = 0; i< res.product.length; i++){
                            $.each(res, function () {
                                product__results
                                .append('<li price="' + (res.product[i].price / 100) + '" id="' + res.product[i].id + '">' + res.product[i].name + '</li>');
                            });
                        }
                    } else{
                        product__results.empty();
                        product__results.append('<li class="text-danger">No Results.</li>');
                    }
                }
            });
        }
    }
    
 });

$(document).on('click', '.product__results li', function(e){
    var product__item = $(this).text();
    var product__id = $(this).attr('id');
    var product__price = $(this).attr('price');
    var product__priceNumber = Number(product__price);
    //alert(product__item);
    var product__list = $(this).closest('.product__results');
    var product__value = $(this).closest('.product__search').find('.product__name');
    var product__priceInsert = $(this).closest('.product__searchItem').find('.product__priceInsert');
    if(product__item != "No Results."){
        product__value.val(product__item);
        product__priceInsert.val(product__price);
    }else{
        product__list.empty().removeClass('display__block');;
    }
    product__list.empty().removeClass('display__block');;
});

 // Calculate on change of quantity Product Item
$(document).on('change', '.product__quantityInsert', function(e){
    let product__quantityInsert = $(this).val();
    let product__quantityNumber = Number(product__quantityInsert);
    let product__priceInsert_cents = $(this).closest('.product__item').find('.product__priceInsert_cents').val();
    let product__priceInsert = $(this).closest('.product__item').find('.product__priceInsert');
    let product__price_centsNumber = Number(product__priceInsert_cents);
    //alert(product__priceInsert_cents)
    let product__priceNumber_calculate = product__price_centsNumber / 100;  
    product__priceInsert.val(product__priceNumber_calculate);
    let product__sum = $(this).closest('.product__item').find('.product__sum');
    let product__insertSum = $(this).closest('.product__item').find('.product__insertSum');
    let product__total_cents = product__price_centsNumber * product__quantityNumber;
    let product__total = product__total_cents / 100;
    product__insertSum.text(product__total);
    product__sum.val(product__total_cents);
});
// Calculate on change of price on Product Item
$(document).on('change', '.product__priceInsert', function(e){
    let product__priceInsert = $(this).val();
    let product__priceNumber = Number(product__priceInsert);
    let product__priceInsert_cents = $(this).closest('.product__item').find('.product__priceInsert_cents');
    let product__priceNumber_cents = product__priceNumber * 100;
    product__priceInsert_cents.val(product__priceNumber_cents);
    /*  Quantity */
    let product__quantityInsert = $(this).closest('.product__item').find('.product__quantityInsert').val();
    let product__quantityNumber = Number(product__quantityInsert);
    /* Product Sum area */
    let product__sum = $(this).closest('.product__item').find('.product__sum');
    let product__insertSum = $(this).closest('.product__item').find('.product__insertSum');
    /* Product Total */
    let product__total_cents = product__priceNumber_cents * product__quantityNumber;
    let product__total = product__priceNumber * product__quantityNumber;
    /* Product Total Insert */
    product__insertSum.text(product__total);
    product__sum.val(product__total_cents);
   
});