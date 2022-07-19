<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::get()->groupBy('user_id');

        // dd($carts);

        // dd(Product::select('id')->whereNotNull('price')->get()->random(5));

        return view('back-office.super-admin.cart.index', [
            'carts' => $carts,
        ]);
    }
}
