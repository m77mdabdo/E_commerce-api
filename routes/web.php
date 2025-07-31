<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\HomeController ;
use App\Http\Controllers\User\HomeController as UserHomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


//home user

Route::get('/', [UserHomeController::class, 'home'])->name('userHome');


Route::controller(AuthController::class)->group(function () {

    Route::get('register', 'createRegister')->name('register');
    Route::post('register', 'storeRegister')->name('storeRegister');

    Route::get('login', 'createLogin')->name('login');
    Route::post('login', 'storeLogin')->name('storeLogin');

    Route::delete('logout', 'logout')->name('logout');
});


Route::get("home", [HomeController::class, "home"])
    ->middleware(['auth'])
    ->name("home");



//category admin

Route::controller(CategoryController::class)->middleware(['auth', 'IsAdmin'])
    ->group(function () {
        Route::get('categories', 'all')->name('allCategory');
        Route::get('categories/show/{id}', 'show')->name('showCategory');

        // //create
        Route::get('categories/create', 'create')->name('createCategory');
        Route::post('categories', 'store')->name('storeCategory');

        //update
        Route::get('categories/edite/{id}', 'edite')->name('editeCategory');
        Route::put('categories/update/{id}', 'update')->name('updateCategory');

        //delete

        Route::delete("categories/delete/{id}", "delete")->name("deleteCategory");
    });



//products Admin
Route::controller(ProductController::class)->middleware([ 'auth','IsAdmin'])->group(function () {
    Route::get('products', 'all')->name('allProducts');
    Route::get('products/show/{id}', 'show')->name('showProduct');

    Route::get('products/create', 'create')->name('createProduct');
    Route::post('products', 'store')->name('storeProduct');

    Route::get('products/edit/{id}', 'edit')->name('editProduct');
    Route::put('products/edit/{id}', 'update')->name('updateProduct');

    Route::delete('products/delete/{id}', 'delete')->name('deleteProduct');
});



//language

Route::get("change/{lang}",function($lang){


    if($lang == "en"){
        session()->put("lang", "en");
    }else if($lang == "ar"){
        session()->put("lang", "ar");
    }else{
        session()->put("lang", "en");
    }

    return redirect()->back();
});






// products users
Route::prefix('user')->controller(UserProductController::class)->group(function () {
    Route::get('products', 'all')->name('allProductsUser');
    Route::get('products/show/{id}', 'show')->name('showProductUser');

    //add to wishlist
    Route::post('products/addWishList/{id}', 'addWishList')->name('addWishListUser');
    Route::get('wishList', 'wishList')->name('userWishList');
     Route::get('/wishList/remove/{id}','removeFromWishList')->name('removeFromWishListUser');



    //add to cart
    Route::middleware('auth')->group(function () {
        Route::post('addToFav/{id}', 'addToFav')->name('addToFav');
        Route::post('products/addToCart/{id}', 'addToCart')->name('addToCartUser');

        Route::post('products/addToCart/{id}', 'addToCart')->name('addToCartUser');

        Route::get('myCart', 'myCart')->name('userCart');
        Route::get('/cart/remove/{id}','removeFromCart')->name('removeFromCartUser');


     });

    // Route::get('/order-details/{id}','orderDetails')->name('userOrderDetails');


});


//make order
Route::controller(OrderController::class)->group(function () {
    Route::get('orders', 'index')->name('allOrders');
    //show
    Route::get('orders/show/{id}', 'show')->name('showOrder');
    //edit
    Route::get('orders/edit/{id}', 'edit')->name('editOrder');
    Route::put('orders/update/{id}', 'update')->name('updateOrder');
    //delete
    Route::delete('orders/delete/{id}', 'delete')->name('deleteOrder');

    //make order
    Route::post('makeOrder','makeOrder')->name('userMakeOrder')->middleware('auth');
});



// category users

Route::prefix('user')->controller(UserCategoryController::class)->group(function () {
    Route::get('categories', 'all')->name('allCategoryUser');
    Route::get('categories/show/{id}', 'show')->name('showCategoryUser');
    Route::get('categories/create', 'create')->name('createCategoryUser');
    Route::post('categories', 'store')->name('storeCategoryUser');
    Route::delete("categories/delete/{id}", "delete")->name("deleteCategoryUser");
});






