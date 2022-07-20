<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public function render()
    {
        $currentRouteName = Route::currentRouteName();
        $routeName = 'back-office.super-admin.order.';

        $orders = Order::where('canceled', 0)->where('done', 0)->with(['user', 'products.parent'])->latest()->paginate();
        
        if ($currentRouteName == $routeName.'done' ) {
            $orders = Order::where('done', 1)->with(['user', 'products.parent'])->latest()->paginate();
        }

        if ($currentRouteName == $routeName.'cancel' ) {
            $orders = Order::where('canceled', 1)->with(['user', 'products.parent'])->latest()->paginate();
        }

        return view('livewire.order.index', [
            'orders' => $orders,
        ]);
    }
}
