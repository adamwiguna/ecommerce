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
       Route::prefix('order')->name('order.')->group(function () {
           Route::get('index', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'index'])->name('index');
           Route::put('index/{order}/paid-payment', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'paid'])->name('update.paid-payment');
           Route::put('index/{order}/unpaid-payment', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'unpaid'])->name('update.unpaid-payment');
           Route::put('index/{order}/on-process', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'onProcess'])->name('update.on-process');
           Route::put('index/{order}/off-process', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'offProcess'])->name('update.off-process');
           Route::put('index/{order}/done', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'done'])->name('update.done');
           Route::put('index/{order}/cancel', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'cancel'])->name('update.cancel');

           Route::get('cancel', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'index'])->name('cancel');
           Route::put('cancel/{order}', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'unCancel'])->name('uncancel');
           Route::get('done', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'index'])->name('done');
           Route::put('done/{order}', [App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class, 'unDone'])->name('undone');
           
       });
       Route::resource('order', App\Http\Controllers\BackOffice\SuperAdmin\OrderController::class)->except('index');

       Route::get('cart', [App\Http\Controllers\BackOffice\SuperAdmin\CartController::class, 'index'])->name('cart.index');

   });

});
