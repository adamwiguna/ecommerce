<?php

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
    return redirect()->route('login');;
});
Route::get('back-office/login', [App\Http\Controllers\BackOffice\LoginController::class, 'index'])->name('login'); 

Route::prefix('back-office')->name('back-office.')->group(function () {
    Route::post('back-office/login', [App\Http\Controllers\BackOffice\LoginController::class, 'login'])->name('login.auth'); 
    Route::get('logout', [App\Http\Controllers\BackOffice\LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'super.admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
       Route::get('dashboard', [App\Http\Controllers\BackOffice\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');

       Route::resource('category', App\Http\Controllers\BackOffice\SuperAdmin\CategoryController::class);

       Route::resource('product', App\Http\Controllers\BackOffice\SuperAdmin\ProductController::class);
       Route::get('product/{product}/manage-image', [App\Http\Controllers\BackOffice\SuperAdmin\ProductController::class, 'manageImage'])->name('product.manage-image');
       Route::post('product/{product}/manage-image', [App\Http\Controllers\BackOffice\SuperAdmin\ProductController::class, 'storeImage'])->name('product.store-image');
       Route::delete('product/{image}/manage-image', [App\Http\Controllers\BackOffice\SuperAdmin\ProductController::class, 'deleteImage'])->name('product.delete-image');
       
       Route::resource('customer', App\Http\Controllers\BackOffice\SuperAdmin\CustomerController::class);
       Route::resource('order', App\Http\Controllers\BackOffice\SuperAdmin\CustomerController::class);

       Route::get('cart', [App\Http\Controllers\BackOffice\SuperAdmin\CartController::class, 'index'])->name('cart.index');

   });

});
