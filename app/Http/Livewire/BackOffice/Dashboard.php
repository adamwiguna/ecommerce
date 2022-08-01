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
    public $products = [];
    public $lastOrders = [];
    public $monthLables=[];
    public $selectedMonth = 0;
    public $ordersStatistic = [];
    public $sales = [];
    public $dailyLabels = [];
    public $dailyIncome = 0;
    public $dailySales = 0;

    public $periode = 5;

    public $monthFormat = 'F-Y';
    public $dateFormat = 'd-m-Y';

    public $readyToLoad = false;
 
    public function loadOrderStatistic()
    {
        $orders = DB::table('orders')->where('updated_at', '>=', Carbon::now()->subMonth($this->periode))
                            ->select(
                                DB::raw('DATE_FORMAT(updated_at, "%M-%Y") AS year_and_month'), 
                                DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS date'), 
                                DB::raw('count(*) as orders'), 
                                DB::raw('count(is_paid) as count_paid'), 
                                DB::raw('count(*) - (count(is_paid) + count(canceled)) as count_unpaid'), 
                                DB::raw('count(*) - (count(done) + count(canceled) )as count_process'), 
                                DB::raw('count(done) as count_done'), 
                                DB::raw('count(canceled) as count_canceled'), 
                                // DB::raw('(select sum(total) from orders where done IS NOT NULL ) as sum_total_price')
                                DB::raw('sum(case when done is not null then total end) as sum_total_price')
                                // DB::raw('(SELECT sum(total) FROM `orders` where done = "2022-07-30 03:38:01" ) as sum_total_price')
                                // DB::raw('sum(total)  as sum_total_price')
                                )
                            ->groupBy( 
                                DB::raw('date')
                                )
                            ->get();

        $this->sales = [];
        $this->ordersStatistic = [];

        foreach($this->monthLables as $month) {
                $this->ordersStatistic[$month]['unpaid'] = $orders->where('year_and_month', $month)->sum('count_unpaid');
                $this->ordersStatistic[$month]['process'] = $orders->where('year_and_month', $month)->sum('count_process');
                $this->ordersStatistic[$month]['done'] = $orders->where('year_and_month', $month)->sum('count_done');
                $this->ordersStatistic[$month]['canceled'] = $orders->where('year_and_month', $month)->sum('count_canceled');
                $this->ordersStatistic[$month]['total'] = $orders->where('year_and_month', $month)->sum('orders');
                $this->ordersStatistic[$month]['income'] = $orders->where('year_and_month', $month)->sum('sum_total_price');
                $sum = 0;
                // $this->ordersStatistic[$month]['sales'] = count($orders) !== 0 && $orders->has($month) ? 
                //                                                         $orders[$month]->whereNotNull('is_paid')->sum(function ($query) use ($sum) {
                //                                                             $sum = $sum + ($query->products()->sum('order_product.quantity'));
                //                                                             return $sum;
                //                                                         })
                //                                                         : 
                //                                                         0;
                
                $this->sales[] = $orders->where('year_and_month', $month)->sum('sum_total_price');

                foreach ($this->dailyLabels[$month] as $day) {
                            $daySum=0;
                            $this->ordersStatistic[$month]['income_daily'][]= $orders->where('year_and_month', $month)->where('date', $day)->sum('sum_total_price');
                            $this->ordersStatistic[$month]['sales_daily'][]= $orders->where('year_and_month', $month)->where('date', $day)->sum('sum_total_price');
                            // $this->ordersStatistic[$month]['sales_daily'][] = $thisMonthOrders !== null && $thisMonthOrders->has($day) ? 
                            //                                                     $thisMonthOrders[$day]->whereNotNull('is_paid')->sum(function ($query) use ($daySum) {
                            //                                                         $daySum = $daySum + ($query->products()->sum('order_product.quantity'));
                            //                                                         // $daySum = $daySum + ($query->products()->sum('pivot.quantity'));
                            //                                                         return $daySum;
                            //                                                     })
                            //                                                     : 
                            //                                                     0;
                }
        }  
        // dd($this->dailyLabels);
        // dd($this->ordersStatistic);

        $this->sales = array_reverse($this->sales, false);

        // dd($this->ordersStatistic);
        
        // $thisMonth = Carbon::now();
        // $fromMonth = Carbon::now()->subMonth($this->periode);
        // $orders = [];
        // $orders = Order::
        //                 latest()
        //                 ->where('updated_at', '<=', now())
        //                 // ->with('products')
        //                 ->where('updated_at' , '>=', $fromMonth->startOfMonth())
        //                 // ->groupBy(DB::raw("DATE_FORMAT(updated_at, '%m-%Y')"))
        //                 ->get()
        //                 ->groupBy(function($query) {
        //                     $a = Carbon::parse($query->updated_at->toDateTimeString())->format($this->monthFormat);
        //                     return $a;
        //                 })
        //                 ;
        

        // $period = CarbonPeriod::create(now()->subMonth($this->periode),'1 month', now());
        // foreach ($period as $date) {
        //     $monthLables[] =  $date->format($this->monthFormat);
        //     $dailyPeriod = CarbonPeriod::create(Carbon::create($date)->startOfMonth(), '1 day', Carbon::create($date)->endOfMonth());
        // }
        
        // $this->monthLables = array_reverse($monthLables, false);

        // $this->sales = [];
        // $this->ordersStatistic = [];

        // foreach($this->monthLables as $month) {
        //     $this->ordersStatistic[$month]['unpaid'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNull('is_paid')->whereNull('canceled')->whereNull('done')->count() : 0;
        //     $this->ordersStatistic[$month]['process'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNull('on_process')->whereNull('canceled')->count() : 0;
        //     $this->ordersStatistic[$month]['done'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNotNull('done')->count() : 0;
        //     $this->ordersStatistic[$month]['canceled'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNotNull('canceled')->count() : 0;
        //     $this->ordersStatistic[$month]['total'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->count() : 0;
        //     $this->ordersStatistic[$month]['income'] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNotNull('done')->sum('total') : 0;
        //     $sum = 0;
        //     $this->ordersStatistic[$month]['sales'] = count($orders) !== 0 && $orders->has($month) ? 
        //                                                             $orders[$month]->whereNotNull('is_paid')->sum(function ($query) use ($sum) {
        //                                                                 $sum = $sum + ($query->products()->sum('order_product.quantity'));
        //                                                                 return $sum;
        //                                                             })
        //                                                             : 
        //                                                             0;
           
        //     $this->sales[] = count($orders) !== 0 && $orders->has($month) ? $orders[$month]->whereNotNull('done')->sum('total') : 0;

        //     $thisMonthOrders = 
        //         count($orders) !== 0 && $orders->has($month) ? $orders[$month]->groupBy(function($query) {
        //         $a = Carbon::parse($query->updated_at->toDateTimeString())->format($this->dateFormat);
        //         return $a;
        //     }) 
        //     :
        //      null;
                                                                    
            
        //     $dayLables = [];

        //     foreach ($this->dailyLabels[$month] as $day) {
        //         $dayLables[] =  $day;
        //     }

        //     $this->ordersStatistic[$month]['label_daily'] = $dayLables;
        //     // $this->ordersStatistic[$month] =[];
        //     foreach ($dayLables as $day) {
        //         $daySum=0;
        //         $this->ordersStatistic[$month]['income_daily'][]= $thisMonthOrders !== null && $thisMonthOrders->has($day) ? $thisMonthOrders[$day]->whereNotNull('done')->sum('total') : 0;
        //         $this->ordersStatistic[$month]['sales_daily'][] = $thisMonthOrders !== null && $thisMonthOrders->has($day) ? 
        //                                                             $thisMonthOrders[$day]->whereNotNull('is_paid')->sum(function ($query) use ($daySum) {
        //                                                                 $daySum = $daySum + ($query->products()->sum('order_product.quantity'));
        //                                                                 // $daySum = $daySum + ($query->products()->sum('pivot.quantity'));
        //                                                                 return $daySum;
        //                                                             })
        //                                                             : 
        //                                                             0;
        //                                                         }
            
        // }

        $this->lastOrders =null;
        // $this->products =null;
        $this->lastOrders = Order::whereNull(['done', 'canceled'])->latest()->take(5)->get();
        // $this->products = Product::withSum('orders', 'order_product.quantity')->with(['parent', 'images'])->orderBy('orders_sum_order_productquantity', 'desc')->take(5)->get();
    
    }

    public function loadProducts()
    {
        
    }

    protected $listeners = ['selectMonth' => 'updateMonth'];

    public function mount()
    {
        $orders = [];        

        $period = CarbonPeriod::create(now()->subMonth($this->periode),'1 month', now());
        foreach ($period as $date) {
            $monthLables[] =  $date->format($this->monthFormat);
            $dailyPeriod = CarbonPeriod::create(Carbon::create($date)->startOfMonth(), '1 day', Carbon::create($date)->endOfMonth());
            foreach ($dailyPeriod as $dp) {
                $this->dailyLabels[$date->format($this->monthFormat)][] = $dp->format($this->dateFormat);
            }
        }
        
        $this->monthLables = array_reverse($monthLables, false);

        
        foreach($monthLables as $month) {
            $this->ordersStatistic[$month]['unpaid'] =  0;
            $this->ordersStatistic[$month]['process'] = 0;
            $this->ordersStatistic[$month]['done'] =  0;
            $this->ordersStatistic[$month]['canceled'] =  0;
            $this->ordersStatistic[$month]['total'] = 0;
            $this->ordersStatistic[$month]['income'] =  0;
            $sum = 0;
            $this->ordersStatistic[$month]['sales'] =  0;
            $this->sales[] =  0;

            $thisMonthOrders = null;
                                                                    
            
            $dayLables = [];

            foreach ($this->dailyLabels[$month] as $day) {
                $dayLables[] =  $day;
            }

            $this->ordersStatistic[$month]['label_daily'] = $dayLables;

            foreach ($dayLables as $day) {
                $daySum=0;
                $this->ordersStatistic[$month]['income_daily'][]=  0;
                $this->ordersStatistic[$month]['sales_daily'][] = 0;
            }
            
        }
        
        $this->selectedMonth = $this->monthLables[0];
    }

    public function render()
    { 
        // $orders = DB::table('orders')->where('updated_at', '>=', Carbon::now()->subMonth($this->periode))
        //                     ->select(
        //                         // 'done',
        //                         DB::raw('DATE_FORMAT(updated_at, "%M-%Y") AS year_and_month'), 
        //                         DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS date'), 
        //                         DB::raw('count(*) as orders'), 
        //                         DB::raw('count(is_paid) as count_paid'), 
        //                         DB::raw('count(*) - count(is_paid) as count_unpaid'), 
        //                         DB::raw('count(*) - (count(done) + count(canceled) )as count_process'), 
        //                         DB::raw('count(done) as count_done'), 
        //                         DB::raw('count(canceled) as count_canceled'), 
        //                         DB::raw('sum(case when done is not null then total end) as sum_total_price')
        //                         // DB::raw('(select sum(total) from orders where is_paid IS NOT NULL ) as sum_total_price')
        //                         )
        //                     // ->havingRaw('select sum(total) from orders where is_paid IS NOT NULL ) as sum_total_price')
        //                     ->groupBy( 
        //                         // DB::raw('Year(updated_at)'), 
        //                         // DB::raw('Month(updated_at)'), 
        //                         DB::raw('date')
        //                         )
        //                     ->get();
        // dd($orders);

        $products = DB::table('orders')
                        ->selectRaw('product_parent.name as parent_name_product')
                        ->selectRaw('products.size')
                        ->selectRaw('sum(quantity) as sum_quantity')
                        ->join('order_product', 'orders.id', 'order_product.order_id')
                        ->join('products', 'order_product.product_id', 'products.id')
                        ->join('products as product_parent',  'products.product_id', 'product_parent.id')
                        ->whereNotNull('done')
                        ->whereRaw('orders.updated_at > NOW() - INTERVAL 1 week')
                        ->groupByRaw('order_product.product_id')
                        ->orderByRaw('sum_quantity DESC ')
                        ->take(5)
                        ->get();


        dd($products);
        return view('livewire.back-office.dashboard');
    }

    public function updateMonth($index)
    {
        $this->selectedMonth = $this->monthLables[$index];
    }


}
