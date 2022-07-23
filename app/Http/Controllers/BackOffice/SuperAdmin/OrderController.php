<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.super-admin.order.index');
    }

    public function updateTotal(Order $order)
    {
        $total = $order->products->sum(function ($product){
            return $product->price * $product->pivot->quantity;
        });

        $order->update([
            'total' => $total,
        ]);

        return redirect()->back()->with('success-message', 'Success Recalculate Total Payment Order');
    }

    public function paid(Order $order)
    {
        if (!$order->done == null || !$order->canceled == null) {
            return redirect()->back();
        }

        $this->updateTotal($order);

        $order->update([
            'is_paid' => now(),
        ]);

        return redirect()->back()->with('success-message', 'Success Update Payment Status to Paid');
    }

    public function unpaid(Order $order)
    {
        if (!$order->done == null || !$order->canceled == null) {
            return redirect()->back();
        }

        $order->update([
            'is_paid' => null,
        ]);

        return redirect()->back()->with('success-message', 'Success Update Payment Status to UnPaid');
    }

    public function onProcess(Order $order)
    {
        if (!$order->done == null || !$order->canceled == null) {
            return redirect()->back();
        }

        $order->update([
            'in_process' => now(),
        ]);

        return redirect()->back()->with('success-message', 'Success Update On Work Status to Working');
    }

    public function offProcess(Order $order)
    {
        if (!$order->done == null || !$order->canceled == null) {
            return redirect()->back();
        }

        $order->update([
            'in_process' => null,
        ]);

        return redirect()->back()->with('success-message', 'Success Update On Work Status to Not Yet');
    }

    public function done(Order $order)
    {
        $order->update([
            'done' => now(),
        ]);

        $this->updateTotal($order);

        return redirect()->back()->with('success-message', 'This Order Is DONE, Conglaturaions');
    }
 
    public function cancel(Order $order)
    {
        $order->update([
            'canceled' => now(),
        ]);

        return redirect()->back()->with('success-message', 'This Order Is Canceled');
    }

    public function unCancel(Order $order)
    {
        $order->update([
            'canceled' => null,
        ]);

        return redirect()->back()->with('success-message', 'This Order Is Un-Canceled');
    }

    public function unDone(Order $order)
    {
        // dd($order->id);
        $order->update([
            'done' => null,
        ]);

        return redirect()->back()->with('success-message', 'This Order Is Un-Done');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
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
