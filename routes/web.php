<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use PHPUnit\Framework\Attributes\Group;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("redirect", [AuthController::class, "redirect"]);

//category

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



//products
Route::controller(ProductController::class)->middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('products', 'all')->name('allProducts');
    Route::get('products/show/{id}', 'show')->name('showProduct');

    Route::get('products/create', 'create')->name('createProduct');
    Route::post('products', 'store')->name('storeProduct');

    Route::get('products/edit/{id}', 'edit')->name('editProduct');
    Route::put('products/edit/{id}', 'update')->name('updateProduct');

    Route::delete('products/delete/{id}', 'delete')->name('deleteProduct');
});

// Route::get("user", [ProductController::class, "user"]);

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
