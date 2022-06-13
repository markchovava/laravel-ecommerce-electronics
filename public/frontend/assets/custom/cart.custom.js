$(document).ready(function(){
    /* INDEX PAGE */
    $(document).on('click', '.add__toCartBtn', function(e){  
        e.preventDefault();
        let csrf_token = $('#csrf__token').val();
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
                console.log(result)
                
            }
        });
    });

/* SINGLE PRODUCT PAGE */
    var i = 1;
    $(document).on('click', '.add__toCartBtn', function(e){ 
        e.preventDefault();
        var single_price = $(this).closest('#lower__bodyArea').siblings('.pricing').find('.price__number').text();
        var price_number = parseFloat(single_price);
        var cart_value = parseFloat($('#cart__quantity').text());
        var cart = cart_value + i;
        $('#cart__quantity').text(cart);
    })

   
});