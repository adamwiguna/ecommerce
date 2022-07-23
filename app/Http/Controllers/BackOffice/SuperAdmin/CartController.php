<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        // $carts = Cart::groupBy('user_id')->paginate();
        $carts = User::whereHas('carts')->with('carts')->paginate();

        // dd($carts);

        // dd(Product::select('id')->whereNotNull('price')->get()->random(5));

        return view('back-office.super-admin.cart.index', [
            'carts' => $carts,
        ]);
    }
}
