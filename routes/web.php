<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductsTransactionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TypeOfVendorsController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('fronts.home');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'manage'])->name('dashboard');

    Route::prefix('users')->as('users.')->group(function() {
        Route::get('/manage', [UsersController::class, 'manage'])->name('manage');
        Route::post('/image-add', [UsersController::class, 'addImage'])->name('image_add');
        Route::delete('/image-remove/{id}', [UsersController::class, 'removeImage'])->name('image_remove');
    });
    Route::resource('users', UsersController::class);

    Route::prefix('products')->as('products.')->group(function() {
        Route::get('/manage', [ProductsController::class, 'manage'])->name('manage');
        Route::post('/image-add', [ProductsController::class, 'addImage'])->name('image_add');
        Route::delete('/image-remove/{id}', [ProductsController::class, 'removeImage'])->name('image_remove');
    });
    Route::resource('products', ProductsController::class);

    Route::prefix('categories')->as('categories.')->group(function() {
        Route::get('/manage', [CategoriesController::class, 'manage'])->name('manage');
        Route::post('/image-add', [CategoriesController::class, 'addImage'])->name('image_add');
        Route::delete('/image-remove/{id}', [CategoriesController::class, 'removeImage'])->name('image_remove');
    });
    Route::resource('categories', CategoriesController::class);

    Route::prefix('type_of_vendors')->as('type_of_vendors.')->group(function() {
        Route::get('/manage', [TypeOfVendorsController::class, 'manage'])->name('manage');
    });
    Route::resource('type_of_vendors', TypeOfVendorsController::class);

    Route::prefix('product_transaction')->as('product_transaction.')->group(function() {
        Route::get('/manage', [ProductsTransactionController::class, 'manage'])->name('manage');
    });
    
    require __DIR__.'/auth.php';
});

Route::get('/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/vendor/{id}', [HomeController::class, 'showProductsForVendor'])->name('home.showVendor');