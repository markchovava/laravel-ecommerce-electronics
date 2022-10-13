$(document).ready(function(){
    
    /* INDEX PAGE Add o Cart */
    $(document).on('click', '.add__toCartBtn', function(e){  
        e.preventDefault();
        let csrf_token = $('#csrf__token').val();
        let price = $(this).parent().siblings('.prodcut-price').find('.price__cents').val();
        let cart_route = $(this).attr('href');
        let product_id = $(this).attr('id');
     
        add_to_cart(cart_route, price, product_id, csrf_token)
    });


    $(document).on('click', '.add__searchCartBtn', function(e){  
        e.preventDefault();
        let csrf_token = $('#csrf__token').val();
        let price = $(this).closest('.product-item__footer').find('.price__cents').val();
        let cart_route = $(this).attr('href');
        let product_id = $(this).closest('.product__item').find('.product__id').val();
        
        add_to_cart(cart_route, price, product_id, csrf_token)
        
    });
    

    /* Adding to Cart through Ajax */
    function add_to_cart(route, price, id, csrf){
        /* Output th new quantity */
        let cart_quantity = $('#cart__quantity');
        
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
            method: "POST",
            dataType: "json",
            data: {
                price_cents: Number(price),
                product_id: Number(id),
                _token: csrf
            },
            success: function(result){
                console.log(result.quantity);
                cart_quantity.text(result.quantity);     
            }
        });
    }


 
});