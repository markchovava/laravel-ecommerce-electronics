$(document).ready(function(){
    /* INDEX PAGE Add o Cart */
    $(document).on('click', '.add__toCartBtn', function(e){  
        e.preventDefault();
        let csrf_token = $('#csrf__token').val();
        let cart_quantity = $('#cart__quantity');
        let product_price = $(this).parent().siblings('.prodcut-price').find('.price__number').text();
        let price_cents = $(this).parent().siblings('.prodcut-price').find('.price__cents').val();
        let cart_add = $(this).attr('href');
        let product_id = $(this).attr('id');
        let price_centsNumber = Number(price_cents);
        let product_idNumber = Number(product_id);
     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: cart_add,
            method: "POST",
            dataType: "json",
            data: {
                price_cents: price_centsNumber,
                product_id: product_idNumber,
                _token: csrf_token
            },
            success: function(result){
                console.log(result.quantity);
                cart_quantity.text(result.quantity);     
            }
        });
    });


 
});