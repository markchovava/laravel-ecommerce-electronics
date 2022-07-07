<?php
use Illuminate\Support\Facades\Route;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;


use App\Models\Product\Product;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\TagController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
use App\Http\Controllers\Frontend\Checkout\CheckoutAuthController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\BasicInfo\BasicInfoController;
use App\Http\Controllers\Inventory\PurchaseController;
use App\Http\Controllers\Pages\Home\StickerController;
use App\Http\Controllers\Ads\AdsController;
use App\Http\Controllers\Frontend\Category\CategoryPageController;
use App\Http\Controllers\Frontend\Tag\TagPageController;
use App\Http\Controllers\Frontend\Brand\BrandPageController;
use App\Http\Controllers\Frontend\Search\SearchPageController;

//use App\Http\Controllers\PDF\PDFController;



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


Route::get('/', [HomeController::class, 'index'])->name('index');
/* Admin Login & Logout */
Route::get('/admin/login', [ProfileController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('admin.logout');
/* Customer Login and Logout */
Route::get('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login_process'])->name('customer.login.process');
Route::get('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register_process'])->name('customer.register.process');
Route::get('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

/* ::: Single Product Page ::: */
Route::get('/product/{id}', [ProductPageController::class, 'view'])->name('product.view');
Route::post('/product/cart_store', [ProductPageController::class, 'cart_store'])->name('product.cart_store');

/* ::: Search Page ::: */
Route::get('/search', [SearchPageController::class, 'search'])->name('product.search');
/* ::: Category Pages ::: */
Route::get('/category', [CategoryPageController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [CategoryPageController::class, 'view'])->name('category.view');
/* ::: Tag Pages ::: */
Route::get('/tag', [TagPageController::class, 'index'])->name('tag.index');
Route::get('/tag/{id}', [TagPageController::class, 'view'])->name('tag.view');
/* ::: Brand Pages ::: */
Route::get('/brand', [BrandPageController::class, 'index'])->name('brand.index');
Route::get('/brand/{id}', [BrandPageController::class, 'view'])->name('brand.view');

/* :::::: Cart :::::: */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/view', [CartController::class, 'view'])->name('cart.view');
Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

/* Checkout */
Route::get('/checkout/register', [CheckoutAuthController::class, 'register'])->name('checkout.register');
Route::post('/checkout/register', [CheckoutAuthController::class, 'register_process'])->name('checkout.register.process');
Route::get('/checkout/login', [CheckoutAuthController::class, 'login'])->name('checkout.login');
Route::post('/checkout/login', [CheckoutAuthController::class, 'login_process'])->name('checkout.login.process');
Route::middleware(['auth'])->group(function (){
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkout_process'])->name('checkout.process');
});

/* Orders Frontend */
Route::get('/track/order', [OrdersController::class, 'track'])->name('order.track');

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
    
    Route::prefix('customer')->group(function() {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer');
        Route::get('/add', [CustomerController::class, 'add'])->name('admin.customer.add');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('/view/{id}', [CustomerController::class, 'view'])->name('admin.customer.view');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });

    Route::prefix('orders')->group(function() {
        Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
        Route::get('/view/{id}', [OrdersController::class, 'view'])->name('admin.orders.view');
    });

    /* :::::: Products ::::: */
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::get('/products/view/{id}', [ProductController::class, 'view'])->name('admin.products.view');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
    Route::get('/products/serial/{id}', [ProductController::class, 'serial'])->name('admin.products.serial');
    Route::get('/products/image/remove/{id}', [ProductController::class, 'remove_image'])->name('admin.products.remove');
    
     /* :::::: Category ::::: */
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    /* :::::: Tag ::::: */
    Route::prefix('tags')->group(function() {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag');
        Route::get('/add', [TagController::class, 'add'])->name('admin.tag.add');
        Route::post('/store', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::post('/update/{id}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::get('/delete/{id}', [TagController::class, 'delete'])->name('admin.tag.delete');
        Route::get('/search', [TagController::class, 'search'])->name('admin.tag.search');
    });

    
     /* :::::: Brands ::::: */
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brand');
    Route::get('/brands/add', [BrandController::class, 'add'])->name('admin.brand.add');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::post('/brands/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::get('/brands/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');

    Route::prefix('ads')->group(function(){
        Route::get('/', [AdsController::class, 'index'])->name('admin.ad');
        Route::get('/add', [AdsController::class, 'add'])->name('admin.ad.add');
        Route::post('/store', [AdsController::class, 'store'])->name('admin.ad.store');
        Route::get('/edit/{id}', [AdsController::class, 'edit'])->name('admin.ad.edit');
        Route::post('/update/{id}', [AdsController::class, 'update'])->name('admin.ad.update');
        Route::get('/delete/{id}', [AdsController::class, 'delete'])->name('admin.ad.delete');
    });

    /* Homepage top Sticker */
    Route::get('pages/home/sticker', [StickerController::class, 'index'])->name('admin.pages.home.sticker');
    Route::get('pages/home/sticker/add', [StickerController::class, 'add'])->name('admin.pages.home.sticker.add');
    Route::post('pages/home/sticker/store', [StickerController::class, 'store'])->name('admin.pages.home.sticker.store');
    Route::get('pages/home/sticker/edit/{id}', [StickerController::class, 'edit'])->name('admin.pages.home.sticker.edit');
    Route::post('pages/home/sticker/update/{id}', [StickerController::class, 'update'])->name('admin.pages.home.sticker.update');

     /* :::::: Quote ::::: */
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

    /* Inventory */
    Route::prefix('inventory')->group(function() {
        Route::get('/purchase', [PurchaseController::class, 'index'])->name('inventory.purchase');
        Route::get('/purchase/add', [PurchaseController::class, 'add'])->name('inventory.purchase.add');
        Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('inventory.purchase.store');
        Route::get('/purchase/edit/{id}', [PurchaseController::class, 'edit'])->name('inventory.purchase.edit');
        Route::post('/purchase/update/{id}', [PurchaseController::class, 'update'])->name('inventory.purchase.update');
        Route::get('/purchase/view/{id}', [PurchaseController::class, 'view'])->name('inventory.purchase.view');
        Route::get('/purchase/delete/{id}', [PurchaseController::class, 'delete'])->name('inventory.purchase.delete');
        Route::get('/purchase/search/product', [PurchaseController::class, 'search_product'])->name('inventory.purchase.search.product');
        Route::get('/purchase/search/supplier', [PurchaseController::class, 'search_supplier'])->name('inventory.purchase.search.supplier');
    });

    Route::prefix('info')->group(function() {
        Route::get('/', [BasicInfoController::class, 'view'])->name('admin.info');
        Route::get('/edit', [BasicInfoController::class, 'edit'])->name('admin.info.edit');
        Route::post('/update', [BasicInfoController::class, 'update'])->name('admin.info.update');
    });
});




Route::get('/add', function(){
   
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

    $product_images = \App\Models\Product\ProductImage::where('product_id', 2)->get();
    dd(count($product_images));

});


/*
::::::::::::::::::::::::::::::::::::::
        START OF FRONTEND
::::::::::::::::::::::::::::::::::::::
*/
/* Route::get('/', function () {
    return view('frontend.pages.index');
}); */




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
