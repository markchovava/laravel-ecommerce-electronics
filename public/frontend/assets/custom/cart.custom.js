$(document).ready(function(){
    /* INDEX PAGE */
    var i = 1;
    $(document).on('click', '.btn-add-cart', function(e){  
        e.preventDefault();
        var product_price = $(this).parent().siblings('.prodcut-price').find('.price__number').text();
        var price_number = parseFloat(product_price);
        //alert(price_number);
        //$('#cart__quantity').text(i);
        //var a = $('#cart__quantity').text();
        var cart_value = parseFloat($('#cart__quantity').text());
        var cart = cart_value + i;
        $('#cart__quantity').text(cart);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('cart/add') }}",
            method: "POST",
            dataType: 'json',
            data: {
                price_number: product_price,
                product_name: product_name,
                _token: '{{ csrf_token() }}'
            },
            success: function(result){
                console.log(result.product.name)
                let name = res.product.name;
                let price = res.product.price;
                let div = $('#alert');
                let y = "<div>" + name + " :::: " + price + "</div";
                //let a = $('#alert').html(name + " :::: " + price)
                 div.append(y);
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