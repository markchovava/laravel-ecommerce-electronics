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
use App\Http\Controllers\Ads\AdsController;
use App\Http\Controllers\Contact\ContactPageController;
use App\Http\Controllers\Frontend\Category\CategoryPageController;
use App\Http\Controllers\Frontend\Tag\TagPageController;
use App\Http\Controllers\Frontend\Brand\BrandPageController;
use App\Http\Controllers\Frontend\CustomerQuote\CustomerQuoteCheckoutAuthController;
use App\Http\Controllers\Frontend\CustomerQuote\CustomerQuoteCheckoutController;
use App\Http\Controllers\Frontend\Privacy\PrivacyPageController;
use App\Http\Controllers\Frontend\Search\SearchPageController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Message\MessageReplyController;
use App\Http\Controllers\Miscellaneous\MiscellaneousController;
use App\Http\Controllers\Shipping\ShippingController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Frontend\CustomerQuote\CustomerQuoteController;
use App\Http\Controllers\PDF\PDFController;
use App\Http\Controllers\Role\RoleController;

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

/* :::::: Cart :::::: */
Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/view', [CartController::class, 'view'])->name('cart.view');
    Route::get('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
});
/* :::::: Customer Quote :::::: */
Route::prefix('quote')->group(function() {
    Route::get('/add', [CustomerQuoteController::class, 'add'])->name('quote.add');
    Route::get('/view', [CustomerQuoteController::class, 'view'])->name('quote.view');
    Route::get('/index', [CustomerQuoteController::class, 'index'])->name('quote.index');
    Route::post('/store', [CustomerQuoteController::class, 'store'])->name('quote.store');
    Route::get('/delete/{id}', [CustomerQuoteController::class, 'delete'])->name('quote.delete');
});

/* Customer Quote Checkout */
Route::prefix('customer/checkout')->group(function() {
    Route::get('/register', [CustomerQuoteCheckoutAuthController::class, 'register'])->name('customer.quote.checkout.register');
    Route::post('/register', [CustomerQuoteCheckoutAuthController::class, 'register_process'])->name('customer.quote.checkout.register.process');
    Route::get('/login', [CustomerQuoteCheckoutAuthController::class, 'login'])->name('customer.quote.checkout.login');
    Route::post('/login', [CustomerQuoteCheckoutAuthController::class, 'login_process'])->name('customer.quote.checkout.login.process');
    Route::middleware(['auth'])->group(function (){
        Route::get('/', [CustomerQuoteCheckoutController::class, 'index'])->name('customer.quote.checkout');
        Route::post('/', [CustomerQuoteCheckoutController::class, 'checkout_process'])->name('customer.quote.checkout.process');
        Route::get('/pdf', [PDFController::class, 'quote_pdf'])->name('customer.quote.pdf');
    });
});

Route::get('/privacy', [PrivacyPageController::class, 'index'])->name('privacy.index');

/* 
*   Contact Page 
*/
Route::get('/contact', [ContactPageController::class, 'index'])->name('contact.index');
Route::post('/contact/store', [ContactPageController::class, 'store'])->name('contact.store');
/* 
*   Admin Login & Logout 
*/
Route::get('/admin/login', [ProfileController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('admin.logout');
/* Customer Login and Logout */
Route::prefix('customer')->group(function() {
    Route::get('/login', [CustomerAuthController::class, 'login'])->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login_process'])->name('customer.login.process');
    Route::get('/register', [CustomerAuthController::class, 'register'])->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register_process'])->name('customer.register.process');
    Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});

/* Payment */
Route::middleware(['auth'])->prefix('payment')->group(function (){
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
});
    Route::post('payment/update', [PaymentController::class, 'update'])->name('payment.update');


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

/* Checkout */
Route::prefix('checkout')->group(function() {
    Route::get('/register', [CheckoutAuthController::class, 'register'])->name('checkout.register');
    Route::post('/register', [CheckoutAuthController::class, 'register_process'])->name('checkout.register.process');
    Route::get('/login', [CheckoutAuthController::class, 'login'])->name('checkout.login');
    Route::post('/login', [CheckoutAuthController::class, 'login_process'])->name('checkout.login.process');
    Route::middleware(['auth'])->group(function (){
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/', [CheckoutController::class, 'checkout_process'])->name('checkout.process');
    });
});


/* Orders Frontend */
Route::prefix('order')->group(function() {
    Route::get('/track', [OrdersController::class, 'track'])->name('order.track');
    Route::get('/order/email', [OrdersController::class, 'order_email'])->name('order.email');
});


Route::middleware(['auth'])->prefix('admin')->group(function(){ 
    
    /* :::::: Profile :::::: */
    Route::middleware(['isOperator'])->prefix('profile')->group(function() {
        Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/password/edit', [ProfileController::class, 'passwordEdit'])->name('password.edit');
        Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    });

    /* :::::: Users :::::: */
    Route::middleware(['isAdmin'])->prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('/add', [UserController::class, 'add'])->name('admin.users.add');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.users.view');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    });

    /* :::::: Roles :::::: */
    Route::middleware(['isModerator'])->prefix('role')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/add', [RoleController::class, 'add'])->name('admin.role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::get('/view/{id}', [RoleController::class, 'view'])->name('admin.role.view');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::get('/search', [RoleController::class, 'search'])->name('admin.role.search');
    });
    
    /* :::::: Customer ::::: */
    Route::middleware(['isEditor'])->prefix('customer')->group(function() {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer');
        Route::get('/search', [CustomerController::class, 'search'])->name('admin.customer.search');
        Route::get('/add', [CustomerController::class, 'add'])->name('admin.customer.add');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('/view/{id}', [CustomerController::class, 'view'])->name('admin.customer.view');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });

    /* :::::: Orders ::::: */
    Route::middleware(['isOperator'])->prefix('orders')->group(function() {
        Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
        Route::get('/view/{id}', [OrdersController::class, 'view'])->name('admin.orders.view');
        Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('admin.orders.edit');
        Route::post('/update/{id}', [OrdersController::class, 'update'])->name('admin.orders.update');
        Route::get('/product/search', [OrdersController::class, 'search_product'])->name('admin.orders.search.product');
        Route::get('/delete/{id}', [OrdersController::class, 'delete'])->name('admin.orders.delete');
        Route::get('/search', [OrdersController::class, 'search'])->name('admin.orders.search');
    });

    /* :::::: Products ::::: */
    Route::middleware(['isModerator'])->prefix('/products')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/search', [ProductController::class, 'search'])->name('admin.products.search');
        Route::get('/add', [ProductController::class, 'add'])->name('admin.products.add');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::get('/view/{id}', [ProductController::class, 'view'])->name('admin.products.view');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::get('/serial/{id}', [ProductController::class, 'serial'])->name('admin.products.serial');
        Route::get('/image/remove/{id}', [ProductController::class, 'remove_image'])->name('admin.products.remove');
    });

     /* :::::: Category ::::: */
     Route::middleware(['isEditor'])->prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/search', [CategoryController::class, 'search'])->name('admin.category.search');
        Route::get('/add', [CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
     });
   
    /* :::::: Tag ::::: */
    Route::middleware(['isEditor'])->prefix('tags')->group(function() {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag');
        Route::get('/search', [TagController::class, 'search'])->name('admin.tag.search');
        Route::get('/add', [TagController::class, 'add'])->name('admin.tag.add');
        Route::post('/store', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::post('/update/{id}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::get('/delete/{id}', [TagController::class, 'delete'])->name('admin.tag.delete');
        Route::get('/search', [TagController::class, 'search'])->name('admin.tag.search');
    });
    
     /* :::::: Brands ::::: */
    Route::middleware(['isEditor'])->prefix('brands')->group(function(){
        Route::get('/', [BrandController::class, 'index'])->name('admin.brand');
        Route::get('/search', [BrandController::class, 'search'])->name('admin.brand.search');
        Route::get('/add', [BrandController::class, 'add'])->name('admin.brand.add');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    });

    /* :::::: Adverts ::::: */
    Route::middleware(['isEditor'])->prefix('ads')->group(function(){
        Route::get('/', [AdsController::class, 'index'])->name('admin.ad');
        Route::get('/add', [AdsController::class, 'add'])->name('admin.ad.add');
        Route::post('/store', [AdsController::class, 'store'])->name('admin.ad.store');
        Route::get('/edit/{id}', [AdsController::class, 'edit'])->name('admin.ad.edit');
        Route::post('/update/{id}', [AdsController::class, 'update'])->name('admin.ad.update');
        Route::get('/delete/{id}', [AdsController::class, 'delete'])->name('admin.ad.delete');
    });

    /* ::::::Shipping ::::: */
    Route::middleware(['isEditor'])->prefix('shipping')->group(function(){
        Route::get('/', [ShippingController::class, 'edit'])->name('admin.shipping');
        Route::post('/update', [ShippingController::class, 'update'])->name('admin.shipping.update');
    });

    /* :::::: Message ::::: */
    Route::middleware(['isEditor'])->prefix('message')->group(function(){
        Route::get('/', [MessageController::class, 'index'])->name('admin.message.all');
        Route::get('/unread', [MessageController::class, 'unread'])->name('admin.message.unread');
        Route::get('/read', [MessageController::class, 'read'])->name('admin.message.read');
        Route::get('/view/{id}', [MessageController::class, 'view'])->name('admin.message.view');
        Route::get('/add', [MessageController::class, 'add'])->name('admin.message.add');
        Route::get('/delete/{id}', [MessageController::class, 'delete'])->name('admin.message.delete');
        /* Reply Message */
        Route::post('/reply/send', [MessageReplyController::class, 'send'])->name('admin.message.send');
    });

     /* :::::: Quote ::::: */
    Route::middleware(['isEditor'])->prefix('quote')->group(function() {
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

     /* :::::: Inventory ::::: */
    Route::middleware(['isEditor'])->prefix('inventory')->group(function() {
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

     /* :::::: Info ::::: */
    Route::middleware(['isEditor'])->prefix('info')->group(function() {
        Route::get('/', [BasicInfoController::class, 'view'])->name('admin.info');
        Route::get('/edit', [BasicInfoController::class, 'edit'])->name('admin.info.edit');
        Route::post('/update', [BasicInfoController::class, 'update'])->name('admin.info.update');
    });
     /* :::::: ZWL ::::: */
    Route::middleware(['isEditor'])->prefix('zwl')->group(function() {
        Route::get('/edit', [MiscellaneousController::class, 'zwl_edit'])->name('admin.zwl.edit');
        Route::post('/store', [MiscellaneousController::class, 'zwl_store'])->name('admin.zwl.store');
    });

});



/* Testing */
Route::get('/add', function(){
    // 
});

Route::get('/show', function(){
    $c = ['Audi', 'Benz', 'Chrysler'];
    $d = implode(', ', $c);
   $b = '';
   for($i = 0; $i < 10; $i++){
    $b .= '<b>' . $i . '</b><br>';
   }
   $a = $b . '<br>' . $d . "<br>The end.";
   //$e = explode('<br>', $a);

   return $a;
});




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
