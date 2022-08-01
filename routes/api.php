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

Route::get('/product/{id}', function ($id) {
    return new ProductResource(Product::where('id', $id)->where('product_id', null)->first());
});
Route::get('/category/{id}/product', [ProductController::class, 'productsInCategory']);
Route::get('/product/best', [ProductController::class, 'best']);
Route::get('/product/new', [ProductController::class, 'new']);
