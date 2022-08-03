<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::where('user_id', auth()->user()->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(is_array($request->cart_id), 200);

     
            $carts = Cart::whereIn('id', is_array($request->cart_id) ? $request->cart_id : [$request->cart_id])->get();

        // Check Cart Id
        if ($carts->count() == 0) {
            return response()->json([
                'message' => 'There is no product in cart to create order',
            ], 404);
        }

        //Check Cart owner
        $filtered = $carts->filter(function ($value, $key) {
            return $value->user_id !== auth()->user()->id;
        })->flatten();

        if ($filtered->count() > 0) {
            return response()->json([
                'message' => 'There is cart ids is not in your carts',
                'data' => $filtered,
            ], 409);
        }


        $order = auth()->user()->orders()->create();
        $total = 0;
        foreach ($carts as $key => $cart) {
            $order->products()->attach($order->id, [
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);

            $total = $total + ($cart->quantity * $cart->product->price);
        }

        $order->update([
            'total' => $total,
        ]);

        $carts->each->delete();

        return response()->json([
            'message' => 'Success to create order',
            'data' => new OrderResource($order),
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
