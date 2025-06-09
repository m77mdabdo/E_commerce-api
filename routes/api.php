<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\ApiCategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(ApiCategoryController::class)
    ->group(function () {
        Route::get('categories', 'all')->name('allCategory');
        Route::get('categories/show/{id}', 'show')->name('showCategory');

        // //create

        Route::post('categories', 'store')->name('storeCategory');

        //update

        Route::put('categories/update/{id}', 'update')->name('updateCategory');

        //delete

        Route::delete("categories/delete/{id}", "delete")->name("deleteCategory");
    });

//products
Route::controller(ApiProductController::class)->group(function () {
    Route::get('products', 'all')->name('allProducts');
    Route::get('products/show/{id}', 'show')->name('showProduct');

    Route::post('products', 'store')->name('storeProduct');


    Route::put('products/update/{id}', 'update')->name('updateProduct');

    Route::delete('products/delete/{id}', 'delete')->name('deleteProduct');
});