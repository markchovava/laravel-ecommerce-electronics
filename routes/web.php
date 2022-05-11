<?php

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
Route::prefix('/admin')->group(function(){
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
