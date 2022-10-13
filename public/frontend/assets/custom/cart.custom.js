$(document).ready(function(){
    /* INDEX PAGE Add o Cart */
    $(document).on('click', '.add__toCartBtn', function(e){  
        e.preventDefault();
        let csrf_token = $('#csrf__token').val();
        let cart_quantity = $('#cart__quantity');
        let price = $(this).parent().siblings('.prodcut-price').find('.price__cents').val();
        let cart_add = $(this).attr('href');
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
            url: cart_add,
            method: "POST",
            dataType: "json",
            data: {
                price_cents: Number(price),
                product_id: Number(product_id),
                _token: csrf_token
            },
            success: function(result){
                console.log(result.quantity);
                cart_quantity.text(result.quantity);     
            }
        });
    });


 
});