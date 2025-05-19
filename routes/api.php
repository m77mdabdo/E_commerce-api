<?php

use App\Http\Controllers\ApiCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::controller(ApiCategoryController::class)->middleware(['auth', 'IsAdmin'])
//     ->group(function () {
//         Route::get('categories', 'all')->name('allCategory');
//         Route::get('categories/show/{id}', 'show')->name('showCategory');

//         // //create
//         Route::get('categories/create', 'create')->name('createCategory');
//         Route::post('categories', 'store')->name('storeCategory');

//         //update
//         Route::get('categories/edite/{id}', 'edite')->name('editeCategory');
//         Route::put('categories/update/{id}', 'update')->name('updateCategory');

//         //delete

//         Route::delete("categories/delete/{id}", "delete")->name("deleteCategory");
//     });
