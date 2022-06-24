
    /* Search Product in the database. */
    $('#search__btn').click(function(e){
        e.preventDefault();
        let product__name = $(this).closest('.product__search').find('.product__name').val();
        let product__searchResults = $(this).closest('.product__search').find('.product__results');
        // alert(product_searchResults.text());
        if(this.id == "search__btn"){
            if( product__name != "" ){
                product__searchResults.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
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
                        product_name: product__name,
                    },
                    success: function(res){
                        //console.log(res.product);
                        if(res.product.length > 0){
                            product__searchResults.empty();
                            for(var i = 0; i < res.product.length; i++){
                                $.each(res, function () {
                                    product__searchResults
                                    .append('<li id="' + res.product[i].id + '">' + res.product[i].name + '</li>');
                                });
                            }
                        } else{
                            product__searchResults.empty();
                            product__searchResults.append('<li class="text-danger">No Results.</li>');
                        }
                    }
                });
            }
        }
    });

    //Removes product_id if empty product name value is empty
    /* $(document).on('change', '.product__name', function(e){
        if($(this).val() == ''){
            $('input[name="product_id"').val('');
        }
    }); */

    /* Add Product to th input box. */
    $(document).on('click', '.product__results li', function(e){
        var product__item = $(this).text();
        var product__id = $(this).attr('id');
        let product__idInsert = $(this).closest('.product__search').find('input[name="product_id"');
        var product__list = $(this).closest('.product__results');
        var product__value = $(this).closest('.product__search').find('.product__name');
        if(product__item != "No Results."){
            product__value.val(product__item);
            product__idInsert.val(product__id);
        }else{
            product__list.empty().removeClass('display__block');
        }
        product__list.empty().removeClass('display__block');
    });

    /* Search User in the database. */
    $('#search__supplierBtn').click(function(e){
        e.preventDefault();
        let supplier__name = $(this).closest('.supplier__search').find('.supplier__name').val();
        let supplier__searchResults = $(this).closest('.supplier__search').find('.supplier__results');
        if(this.id == "search__supplierBtn"){
            if( supplier__name != "" ){
                supplier__searchResults.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
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
                        supplier_name: supplier__name,
                    },
                    success: function(res){
                        //console.log(res.supplier);
                        if(res.supplier.length > 0){
                            supplier__searchResults.empty();
                            for(var i = 0; i < res.supplier.length; i++){
                                $.each(res, function () {
                                    supplier__searchResults
                                    .append('<li id="' + res.supplier[i].id + '">' + res.supplier[i].company_name + '</li>');
                                });
                            }
                        } else{
                            supplier__searchResults.empty();
                            supplier__searchResults.append('<li class="text-danger">No Results.</li>');
                        }
                    }
                });
            }
        }
    }); 
    /* Add Supplier to th input box. */
    $(document).on('click', '.supplier__results li', function(e){
        var supplier__item = $(this).text();
        var supplier__id = $(this).attr('id');
        let supplier__idInsert = $(this).closest('.supplier__search').find('input[name="supplier_id"');
        var supplier__list = $(this).closest('.supplier__results');
        var supplier__value = $(this).closest('.supplier__search').find('.supplier__name');
        if(supplier__item != "No Results."){
            supplier__value.val(supplier__item);
            supplier__idInsert.val(supplier__id);
        }else{
            supplier__list.empty().removeClass('display__block');
        }
        supplier__list.empty().removeClass('display__block');
    });
    //Removes supplier_id if empty supplier name value is empty
    $(document).on('change', '.supplier__name', function(){
        if($(this).val() == ''){
            $('input[name="supplier_id"').val('');
        }
    });
