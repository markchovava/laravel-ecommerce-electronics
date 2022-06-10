<?php
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Http\Response;

use App\Models\Product\Product;

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\PDF\PDFController;



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
Route::get('/login', [ProfileController::class, 'login'])->name('login');
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductPageController::class, 'view'])->name('product.view');

Route::get('/cart/add', [CartController::class, 'add'])->name('cart.add');




Route::middleware(['auth'])->prefix('admin')->group(function(){ 

    /* :::::: Account Profile :::::: */
    Route::prefix('profile')->group(function() {
        Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/password/edit', [ProfileController::class, 'passwordEdit'])->name('password.edit');
        Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    });

    /* :::::: Users :::::: */
    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('/add', [UserController::class, 'add'])->name('admin.users.add');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.users.view');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    });

    /* :::::: Products ::::: */
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::get('/products/view/{id}', [ProductController::class, 'view'])->name('admin.products.view');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
    
     /* :::::: Category ::::: */
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

     /* :::::: Brands ::::: */
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brand');
    Route::get('/brands/add', [BrandController::class, 'add'])->name('admin.brand.add');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::post('/brands/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::get('/brands/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');

    Route::prefix('quote')->group(function() {
        Route::get('/', [QuoteController::class, 'index'])->name('admin.quote');
        Route::get('/add', [QuoteController::class, 'add'])->name('admin.quote.add');
        Route::get('/view/{id}', [QuoteController::class, 'view'])->name('admin.quote.view');
        Route::post('/store', [QuoteController::class, 'store'])->name('admin.quote.store');
        Route::get('/edit/{id}', [QuoteController::class, 'edit'])->name('admin.quote.edit');
        Route::post('/update/{id}', [QuoteController::class, 'update'])->name('admin.quote.update');
        Route::get('/search', [QuoteController::class, 'search'])->name('admin.quote.search');
        Route::get('/delete/{id}', [QuoteController::class, 'delete'])->name('admin.quote.delete');
        Route::get('pdf/{id}', [PDFController::class, 'pdf'])->name('admin.quote.pdf');
    });
});


function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));

    $key = "";
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}




Route::get('/add', function(){
    $shopping_session = RandomString(30);
    // $add = new \App\Models\Cart\Cart ();
    /* $add->create([
        'shopping_session'=> $shopping_session,
        'total' => 1200
    ]); */
    // setcookie('session_id', $shopping_session, time() + (86400 * 7), "/");
    // $session_id = session()->getId(); // Create Session
    // $session_id = session()->flush(); // Delete Dession
    // setcookie('session_id', $shopping_session, time() + (86400 * 7), "/");
    // dd($shopping_session);
    $product_id = 4;
    $cart_item = \App\Models\Cart\CartItem::where('product_id', $product_id)->first();
    if(!empty($cart_item)){
        $cart_item->quantity++;
        $cart_item->save();
    }
    else{
        $cart_item = new \App\Models\Cart\CartItem();
        $cart_item->product_id = $product_id;
        $cart_item->quantity = 1;	
       /*  $cart_item->variation_name = "Color";	
        $cart_item->variation_value = "Red"; */
        $cart_item->save();

    }
    
      
});


Route::get('/show', function(){
    if(isset($_COOKIE['session_id'])){
        /* unset($_COOKIE['session_id']);
        setcookie('session_id', '', time() - 3600, '/'); */
        $cookie = htmlspecialchars($_COOKIE['session_id']); 
        $shop_check = \App\Models\Cart\Cart::where('shopping_session', 'LIKE', '%' . $cookie . '%')->first();
       if(!empty($shop_check)){
            return $cookie . " === " . $shop_check->shopping_session . ", Total is: " . ($shop_check->total / 100);
       }
       
    } else{
        dd('Cookie not set');
    }
    /* unset($_COOKIE['session_id']);
    setcookie('session_id', '', time() - 3600, '/'); */
    //$cookie = htmlspecialchars($_COOKIE['session_id']); 
    // return $cookie;
    //dd($cookie);
});


/*
::::::::::::::::::::::::::::::::::::::
        START OF FRONTEND
::::::::::::::::::::::::::::::::::::::
*/
/* Route::get('/', function () {
    return view('frontend.pages.index');
}); */

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
        $data['products'] = Product::all();
        return view('backend.products.index', $data);
    });
});
