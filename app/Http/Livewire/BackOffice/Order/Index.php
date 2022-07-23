<?php

namespace App\Http\Livewire\BackOffice\Order;

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

        $orders = Order::whereNull('canceled')->whereNull('done')->with(['user', 'products.parent'])->latest()->paginate();
        
        if ($currentRouteName == $routeName.'done' ) {
            $orders = Order::whereNotNull('done')->with(['user', 'products.parent'])->latest()->paginate();
        }

        if ($currentRouteName == $routeName.'cancel' ) {
            $orders = Order::whereNotNull('canceled')->with(['user', 'products.parent'])->latest()->paginate();
        }

        return view('livewire.back-office.order.index', [
            'orders' => $orders,
        ]);
    }
}
