<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\BrandController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function(){ 

    /* :::::: Products ::::: */
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    
     /* :::::: Category ::::: */
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');

     /* :::::: Brands ::::: */
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brand');
    Route::get('/brands/add', [BrandController::class, 'add'])->name('admin.brand.add');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::get('/brands/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::get('/brands/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
});






Route::get('/add', function(){

    $product = \App\Models\Product\Product::find(1);
    $product->discounts()->create([
        'discount_percent' => 10,
    ]);

    $product = \App\Models\Product\Product::find(2);
    $product->discounts()->create([
        'discount_percent' => 25,
    ]);
    $product = \App\Models\Product\Product::find(3);
    $product->discounts()->create([
        'discount_percent' => 33,
    ]);
      
});


Route::get('/show', function(){

    $data['products']= \App\Models\Product\Product::with('discounts')->get();

    return view('frontend.test', $data);
});





Route::get('/signin', function () {
    return view('auth.login1');
});

Route::get('/signup', function () {
    return view('auth.register1');
});


/* 
::::::::::::::::::::::::::::::::::::::
        START OF FRONTEND
::::::::::::::::::::::::::::::::::::::
*/
Route::get('/', function () {
    return view('frontend.pages.index');
});

Route::get('/single', function () {
    return view('frontend.pages.single');
});

Route::get('/shop', function () {
    return view('frontend.pages.shop');
});

Route::get('/list', function () {
    return view('frontend.pages.list');
});

Route::get('/search', function () {
    return view('frontend.pages.search_results');
});

Route::get('/cart', function () {
    return view('frontend.pages.cart');
});

Route::get('/checkout', function () {
    return view('frontend.pages.checkout');
});

Route::get('/contact', function () {
    return view('frontend.pages.contact');
});

Route::get('/about', function () {
    return view('frontend.pages.about');
});

Route::get('/terms', function () {
    return view('frontend.pages.terms');
});


/* 
::::::::::::::::::::::::::::::::::::::
        END OF FRONTEND
::::::::::::::::::::::::::::::::::::::
*/

/* 
::::::::::::::::::::::::::::::::::::::
        START OF BACKEND
::::::::::::::::::::::::::::::::::::::
*/
Route::prefix('/backend')->group(function(){
    Route::get('/', function () {
        return view('backend.index');
    });

    Route::get('/users', function () {
        return view('backend.users.index');
    });
    Route::get('/users/view', function () {
        return view('backend.users.view');
    });
    Route::get('/users/edit', function () {
        return view('backend.users.edit');
    });

    Route::get('/products', function () {
        return view('backend.products.index');
    });
    Route::get('/products/add', function () {
        return view('backend.products.add');
    });
    Route::get('/products/edit', function () {
        return view('backend.products.edit');
    });
    Route::get('/category', function () {
        return view('backend.category.index');
    });
    Route::get('/category/add', function () {
        return view('backend.category.add');
    });
    Route::get('/category/edit', function () {
        return view('backend.category.add');
    });
    Route::get('/customers', function () {
        return view('backend.customers.index');
    });
    Route::get('/customers/view', function () {
        return view('backend.customers.view');
    });
    Route::get('/sales', function () {
        return view('backend.reports.sales');
    });
    Route::get('/delivery', function () {
        return view('backend.reports.delivery');
    });
    Route::get('/qoute/view', function () {
        return view('backend.qoute.view');
    });
    Route::get('/qoute/add', function () {
        return view('backend.qoute.add');
    });
    Route::get('/message', function () {
        return view('backend.message.index');
    });
    Route::get('/message/add', function () {
        return view('backend.message.add');
    });


});


/* 
::::::::::::::::::::::::::::::::::::::
        END OF BACKEND
::::::::::::::::::::::::::::::::::::::
*/




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
