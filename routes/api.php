<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product/{product}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/product', [App\Http\Controllers\Api\ProductController::class, 'index']);


Route::get('/category/{id}/product', [App\Http\Controllers\Api\ProductController::class, 'productsInCategory']);

Route::prefix('category')->group(function () {
   Route::get('/', [App\Http\Controllers\Api\CategoryController::class, 'index']); 
   Route::get('/parent', [App\Http\Controllers\Api\CategoryController::class, 'parent']); 
   Route::get('/{category}', [App\Http\Controllers\Api\CategoryController::class, 'show']); 
});

Route::get('/verify/{keyName}/{KeyEmail}', [App\Http\Controllers\Api\Auth\VerifyEmailController::class, 'verify']); 
Route::prefix('auth')->group(function () {
    Route::post('register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'store']);
    Route::post('password-reset-link', [App\Http\Controllers\Api\Auth\PasswordResetController::class, 'passwordResetLink']);
    Route::post('update-password', [App\Http\Controllers\Api\Auth\PasswordResetController::class, 'updatePassword']);
    Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::put('cart/{cart}/quantity-increment', [App\Http\Controllers\Api\CartController::class, 'quantityIncrement']);
    Route::put('cart/{cart}/quantity-decrement', [App\Http\Controllers\Api\CartController::class, 'quantityDecrement']);
    Route::delete('cart/delete-all', [App\Http\Controllers\Api\CartController::class, 'destroyAll']);
    Route::apiResource('cart', App\Http\Controllers\Api\CartController::class);

    Route::prefix('order')->group(function () {
       Route::get('/', [App\Http\Controllers\Api\OrderController::class, 'index']); 
       Route::post('/', [App\Http\Controllers\Api\OrderController::class, 'store']); 
    });

});

Route::get('/product/best', [ProductController::class, 'best']);
Route::get('/product/new', [ProductController::class, 'new']);
