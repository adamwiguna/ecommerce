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
    public $dailyLabels = [];
    public $dailyIncome;
    public $dailySales;

    protected $listeners = ['selectMonth' => 'updateMonth'];

    public function mount()
    {
        $periode = 5;
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
        // dd($period);
        foreach ($period as $date) {
            // dd($dailyPeriod);
            $monthLables[] =  $date->format('M(y)');
            $dailyPeriod = CarbonPeriod::create(Carbon::create($date)->startOfMonth(), '1 day', Carbon::create($date)->endOfMonth());
            foreach ($dailyPeriod as $dp) {
                $this->dailyLabels[$date->format('M(y)')][] = $dp->format('d-m-Y');
            }
        }
        // dd($this->dailyLabels);
        
        $this->monthLables = array_reverse($monthLables, false);

        // dd($this->monthLables);

        
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

            $thisMonthOrders = $orders->has($month) ? $orders[$month]->groupBy(function($query) {
                $a = Carbon::parse($query->updated_at->toDateTimeString())->format('d-m-Y');
                return $a;
            }) : null;
                                                                    
            // $startDate = $orders[$month][0]->updated_at->startOfMonth();
            // $endDate = $orders[$month][0]->updated_at->endOfMonth();
            // $dayPeriod = CarbonPeriod::create($startDate, ' 1 day', $endDate);
          
            $dayLables = [];
            // dd($this->dailyLabels);
            foreach ($this->dailyLabels[$month] as $day) {
                $dayLables[] =  $day;
            }

            $this->ordersStatistic[$month]['label_daily'] = $dayLables;

            foreach ($dayLables as $day) {
                $daySum=0;
                // $this->ordersStatistic[$month]['income_daily'][$day]= $thisMonthOrders->has($day) ? $thisMonthOrders[$day]->whereNotNull('done')->sum('total') : 0;
                $this->ordersStatistic[$month]['income_daily'][]= $thisMonthOrders !== null && $thisMonthOrders->has($day) ? $thisMonthOrders[$day]->whereNotNull('done')->sum('total') : 0;
                $this->ordersStatistic[$month]['sales_daily'][] = $thisMonthOrders !== null && $thisMonthOrders->has($day) ? 
                                                                    $thisMonthOrders[$day]->whereNotNull('is_paid')->sum(function ($query) use ($daySum) {
                                                                        $daySum = $daySum + ($query->products->pluck('pivot.quantity')->sum());
                                                                        return $daySum;
                                                                    })
                                                                    : 
                                                                    0;
                                                                }
            if ($orders->has($month)) {
            } 
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

    public function updateMonth($index)
    {
        $this->selectedMonth = $this->monthLables[$index];
    }

}
