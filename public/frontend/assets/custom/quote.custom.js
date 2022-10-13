
$(document).on('click', '.add__toQuoteBtn', function(e){
    e.preventDefault();
    let quote_quantity = $('#quote__quantity');
    let price = $(this).closest('.product__item').find('.price__cents').val();
    let quote_route = $(this).attr('href');
    let product_id = $(this).attr('id');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: quote_route,
        method: "GET",
        dataType: "json",
        data: {
            price: Number(price),
            product_id: Number(product_id),
        },
        success: function(result){
            console.log(result.quantity);
            quote_quantity.text(result.quantity);     
        }
    });

});


$(document).on('click', '.add__pageQuoteBtn', function(e){
    e.preventDefault();
    let quote_quantity = $('#quote__quantity');
    let quantity = $('.product__quantity').val();
    let price = $('.product__price').val();
    let product_id = $('.product__id').val();
    let quote_route = $(this).attr('href');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: quote_route,
        method: "GET",
        dataType: "json",
        data: {
            price: Number(price),
            product_id: Number(product_id),
            quantity: Number(quantity)
        },
        success: function(result){
            console.log(result.quantity);
            quote_quantity.text(result.quantity);     
        }
    });

});