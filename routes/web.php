<?php



use App\Models\User;
use Laravel\Jetstream\Rules\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Favoretes\FavController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AboutUs\AboutUsController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;


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
Route::get('user/home/{$id}', [UserHomeController::class, 'show'])->name('userHomeShow');


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
Route::controller(ProductController::class)->middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('products', 'all')->name('allProducts');
    Route::get('products/show/{id}', 'show')->name('showProduct');

    Route::get('products/create', 'create')->name('createProduct');
    Route::post('products', 'store')->name('storeProduct');

    Route::get('products/edit/{id}', 'edit')->name('editProduct');
    Route::put('products/edit/{id}', 'update')->name('updateProduct');

    Route::delete('products/delete/{id}', 'delete')->name('deleteProduct');
});



//language

Route::get("change/{lang}", function ($lang) {


    if ($lang == "en") {
        session()->put("lang", "en");
    } else if ($lang == "ar") {
        session()->put("lang", "ar");
    } else {
        session()->put("lang", "en");
    }

    return redirect()->back();
});






// products users
Route::prefix('user')->controller(UserProductController::class)->group(function () {
    Route::get('products', 'all')->name('allProductsUser');
    Route::get('ourProducts', 'ourProducts')->name('ourProductsUser');
    Route::get('/products/category/{id}', 'byCategory')->name('products.byCategory');
    Route::get('products/show/{id}', 'show')->name('showProductUser');

    //add to wishlist
    Route::post('products/addWishList/{id}', 'addWishList')->name('addWishListUser');
    Route::get('wishList', 'wishList')->name('userWishList');
    Route::get('/wishList/remove/{id}', 'removeFromWishList')->name('removeFromWishListUser');



    //add to cart
    Route::middleware('auth')->group(function () {


        Route::post('products/addToCart/{id}', 'addToCart')->name('addToCartUser');

        Route::post('products/addToCart/{id}', 'addToCart')->name('addToCartUser');

        Route::get('myCart', 'myCart')->name('userCart');
        Route::get('/cart/remove/{id}', 'removeFromCart')->name('removeFromCartUser');
    });
});


Route::controller(FavController::class)->middleware(['auth'])->group(function () {
    Route::get('myFav', 'myFav')->name('userFav');
    Route::post('addToFav/{id}', 'addToFav')->name('addToFav');
    Route::delete('favorites/remove/{id}', 'removeFromFavorites')->name('removeFromFavorites');
});


//make order
Route::controller(OrderController::class)->middleware(['auth'])->group(function () {

    Route::get('orders', 'index')->name('allOrders');
    //show
    Route::get('orders/show/{id}', 'show')->name('showOrder');
    //edit
    Route::get('orders/edit/{id}', 'edit')->name('editOrder');
    Route::put('orders/update/{id}', 'update')->name('updateOrder');
    //delete
    Route::delete('orders/delete/{id}', 'delete')->name('deleteOrder');

    //make order
    Route::post('makeOrder', 'makeOrder')->name('userMakeOrder')->middleware('auth');
});


//about us
Route::controller(AboutUsController::class)->group(function () {
    Route::get('aboutUs', 'index')->name('aboutUs');
    Route::get('aboutUs/show', 'show')->name('showAboutUs');
    Route::get('aboutUs/edit/{id}', 'edit')->name('editAboutUs');
    Route::put('aboutUs/update/{id}', 'update')->name('updateAboutUs');
    Route::delete('aboutUs/delete/{id}', 'delete')->name('deleteAboutUs');
});


Route::controller(UserController::class)->middleware(['auth'])->group(function () {

    Route::get('users', 'all')->name('allUsers');
    Route::get('users/show/{id}', 'show')->name('showUser');
    Route::get('create', 'create')->name('createUser');
    Route::post('users', 'store')->name('storeUser');
    Route::get('users/edit/{id}', 'edit')->name('editUser');
    Route::put('users/update/{id}', 'update')->name('updateUser');
    Route::delete('users/delete/{id}', 'delete')->name('deleteUser');
});

//review user
Route::prefix('user')->controller(ReviewController::class)->middleware(['auth'])->group(function () {
    Route::get('reviews', 'index')->name('allReviews');
    Route::get('reviews/show/{id}', 'show')->name('showReview');
    Route::get('reviews/create/{id}', 'create')->name('createReview');
    Route::post('reviews', 'store')->name('storeReview');
});


//review admin
Route::controller(AdminReviewController::class)->middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('reviews', 'index')->name('allReviewsAdmin');
    Route::get('reviews/show/{id}', 'show')->name('showReviewAdmin');
    Route::get('reviews/create', 'create')->name('createReviewAdmin');
    Route::post('reviews', 'store')->name('storeReviewAdmin');
    Route::get('reviews/edit/{id}', 'edit')->name('editReviewAdmin');
    Route::put('reviews/update/{id}', 'update')->name('updateReviewAdmin');
    Route::delete('reviews/delete/{id}', 'destroy')->name('deleteReviewAdmin');
});

//payment

Route::controller(PaymentController::class)->group(function () {
    Route::get('order/{order}/payment', 'create')->name('createPayment');

    Route::post('order/{order}/payment-intent', 'createStripePaymentIntent')->name('stripe.paymentIntent.create');
    Route::get('order/{order}/payment/confirm', 'confirm')->name('stripe.return');
});
