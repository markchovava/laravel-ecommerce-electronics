/**
 * Written By: Mark Chovava
 **/
$(document).on('click', '.add__toQuoteBtn', function(e){
    e.preventDefault();
    let price = $(this).closest('.product__item').find('.price__cents').val();
    let quote_route = $(this).attr('href');
    let product_id = $(this).attr('id');
    let quantity = 1;

    add_to_quote(quote_route, price, product_id, quantity);
});


$(document).on('click', '.add__pageQuoteBtn', function(e){
    e.preventDefault();      
    let quantity = $('.product__quantity').val();
    let price = $('.product__price').val();
    let product_id = $('.product__id').val();
    let quote_route = $(this).attr('href');
    
    add_to_quote(quote_route, price, product_id, quantity);
});

$(document).on('click', '.add__searchQuoteBtn', function(e){
    e.preventDefault();
    let price = $(this).closest('.product-item__footer').find('.price__cents').val();
    let quote_route = $(this).attr('href');
    let product_id = $(this).closest('.product__item').find('.product__id').val();
    let quantity = 1;

    add_to_quote(quote_route, price, product_id, quantity);

});


function add_to_quote(route, price, id, quantity){
    /* Display Qunatity in Quote. */
    let quote_quantity = $('#quote__quantity');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        method: "GET",
        dataType: "json",
        data: {
            price: Number(price),
            product_id: Number(id),
            quantity: Number(quantity)
        },
        success: function(result){
            console.log(result.quantity);
            quote_quantity.text(result.quantity);     
        }
    });
}
