<?php

namespace App\Http\Livewire\BackOffice;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $monthLables;
    public $selectedMonth;
    public $ordersStatistic;
    public $sales;

    public function mount()
    {
       

        // dd($product);

        $periode = 11;
        $thisMonth = Carbon::now();
        $fromMonth = Carbon::now()->subMonth($periode);
        $orders = Order::latest()->where('updated_at', '<=', now())
                        ->with('products')
                        ->where('updated_at' , '>=', $fromMonth->startOfMonth())
                        ->get()->groupBy(function($query) {
            $a = Carbon::parse($query->updated_at->toDateTimeString())->format('M(y)');
            return $a;
        });

        

        $period = CarbonPeriod::create(now()->subMonth($periode),'1 month', now());
        
        foreach ($period as $date) {
            $monthLables[] =  $date->format('M(y)');
        }
        
        $this->monthLables = array_reverse($monthLables, false);

        
        foreach($monthLables as $month) {
            $this->ordersStatistic[$month]['unpaid'] = $orders->has($month) ? $orders[$month]->whereNull('is_paid')->whereNull('canceled')->whereNull('done')->count() : 0;
            $this->ordersStatistic[$month]['process'] = $orders->has($month) ? $orders[$month]->whereNull('on_process')->whereNull('canceled')->count() : 0;
            $this->ordersStatistic[$month]['done'] = $orders->has($month) ? $orders[$month]->whereNotNull('done')->count() : 0;
            $this->ordersStatistic[$month]['canceled'] = $orders->has($month) ? $orders[$month]->whereNotNull('canceled')->count() : 0;
            $this->ordersStatistic[$month]['total'] = $orders->has($month) ? $orders[$month]->count() : 0;
            $this->ordersStatistic[$month]['income'] = $orders->has($month) ? $orders[$month]->whereNotNull('done')->sum('total') : 0;
            $sum = 0;
            $this->ordersStatistic[$month]['sales'] = $orders->has($month) ? 
                                                                    $orders[$month]->whereNotNull('is_paid')->sum(function ($query) use ($sum) {
                                                                        $sum = $sum + ($query->products->pluck('pivot.quantity')->sum());
                                                                        return $sum;
                                                                    })
                                                                    : 
                                                                    0;
            $this->sales[] = $orders->has($month) ? $orders[$month]->whereNotNull('done')->sum('total') : 0;
        }
        
        $this->selectedMonth = $this->monthLables[0];

    }

    public function render()
    {
        
       $products = Product::withSum('orders', 'order_product.quantity')->with(['parent', 'images'])->orderBy('orders_sum_order_productquantity', 'desc')->take(5)->get();
        // dd($products->first()->images);
       return view('livewire.back-office.dashboard', [
            'orders' => Order::whereNull(['done', 'canceled'])->latest()->take(5)->get(),
            'products' => $products,
       ]);
    }

    public function selectMonth($index)
    {
        // dd($index);
        $this->selectedMonth = $this->monthLables[$index];
        // dd($this->selectedMonth);
    }

    public function test()
    {
        dd('test');
    }
}
