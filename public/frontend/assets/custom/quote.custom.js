$(document).on('click', '.add__toQuoteBtn', function(e){
    e.preventDefault();
    let csrf_token = $('#csrf__token').val();
    let quote_quantity = $('#quote__quantity');
    let price_cents = $(this).closest('.product__item').find('.price__cents').val();
    let quote_route = $(this).attr('href');
    let product_id = $(this).attr('id');
    let price_centsNumber = Number(price_cents);
    let product_idNumber = Number(product_id);
    //alert(csrf_token)
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
        method: "POST",
        dataType: "json",
        data: {
            price_cents: price_centsNumber,
            product_id: product_idNumber,
            _token: csrf_token
        },
        success: function(result){
            console.log(result.quantity);
            quote_quantity.text(result.quantity);     
        }
    });
})