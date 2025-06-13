<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\ApiCategoryController;

use App\Http\Controllers\API\ApiAuthController ;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(ApiCategoryController::class)
    ->group(function () {
        Route::get('categories', 'all')->name('allCategory')->middleware('ApiAuth');
        Route::get('categories/show/{id}', 'show')->name('showCategory')->middleware('ApiAuth');

        // //create

        Route::post('categories', 'store')->name('storeCategory')->middleware('ApiAuth');

        //update

        Route::put('categories/update/{id}', 'update')->name('updateCategory')->middleware('ApiAuth');;

        //delete

        Route::delete("categories/delete/{id}", "delete")->name("deleteCategory")->middleware('ApiAuth');;
    });

//products
Route::controller(ApiProductController::class)->group(function () {
    Route::get('products', 'all')->name('allProducts');
    Route::get('products/show/{id}', 'show')->name('showProduct');

    Route::post('products', 'store')->name('storeProduct')->middleware('ApiAuth');;


    Route::put('products/update/{id}', 'update')->name('updateProduct')->middleware('ApiAuth');;

    Route::delete('products/delete/{id}', 'delete')->name('deleteProduct')->middleware('ApiAuth');;
});

//auth

Route::controller(ApiAuthController::class)->group(function (){
    Route::post('register','register')->name('register');
    Route::post('login','login')->name('login');
    Route::post('logout','logout')->name('logout');
});


