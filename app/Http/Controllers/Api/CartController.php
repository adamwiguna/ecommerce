<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartResource::collection(auth()->user()->carts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|max:5',
            // 'quantity' => 'required|max:5',
        ]);

        // return response()->json($request->quantity, 200);

        $product = Product::find($request->product_id);

        if ($product->product_id == null) {
            return response()->json([
                'message' => 'Failed to add Product, this Product is not found',
            ], 404);
        }

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();

        if ($cart) {

            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);

        } else {

            if ($request->quantity !== null && $request->quantity < $product->minimum_order) {
                return response()->json([
                    'message' => 'Failed add Product to Cart, Minimum order not reached',
                ], 409);
            }
    
            $cart = auth()->user()->carts()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? $product->minimum_order ?? 1,
            ]);
    
            
        }
        
        return response()->json([
            'message' => 'Success store Product to Cart',
            'data' => $cart,
        ], 200);

    }

    public function quantityIncrement(Cart $cart)
    {
        $cart->increment('quantity');

        return response()->json([
            'message' => 'Success increase quantity',
            'data' => $cart,
        ], 200);
    }

    public function quantityDecrement(Cart $cart)
    {
        
        if ($cart->quantity <= $cart->product->minimum_order) {
            return response()->json([
                'message' => 'Failed decrease quantity, minimum order reached',
            ], 409);
        }

        $cart->decrement('quantity');

        return response()->json([
            'message' => 'Success decrease quantity',
            'data' => new CartResource($cart),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        
        return response()->json([
            'message' => 'Success to delete this product in cart',
            'data' => $cart,
        ], 200);
    }

    public function destroyAll()
    {
        auth()->user()->carts()->delete();

        return response()->json([
            'message' => 'Success to delete all product in cart',
        ], 200);
    }
}
