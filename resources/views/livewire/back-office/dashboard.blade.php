<div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title">Order Statistics -
                <div class="dropdown d-inline">
                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">{{ $selectedMonth }}</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                    <li class="dropdown-title">Select Month</li>
                    @foreach ($monthLables as $index => $month)
                    <li wire:click="selectMonth('{{ $index }}'')" ><button wire:click="selectMonth({{ $index }})" class="dropdown-item">{{ $month }}</button></li>
                        
                    @endforeach
                    </ul>
                </div>
                </div>
                <div class="card-stats-items">
                <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $ordersStatistic[$selectedMonth]['unpaid'] }}</div>
                    <div class="card-stats-item-label">Unpaid</div>
                </div>
                <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $ordersStatistic[$selectedMonth]['done'] }}</div>
                    <div class="card-stats-item-label">Done</div>
                </div>
                <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $ordersStatistic[$selectedMonth]['canceled'] }}</div>
                    <div class="card-stats-item-label">Cancel</div>
                </div>
                </div>
            </div>
            <div class="card-icon shadow-primary bg-primary ">
                <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Total Orders</h4>
                </div>
                <div class="card-body">
                    {{ $ordersStatistic[$selectedMonth]['total'] }}
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-chart">
                <canvas id="balance-chart-1" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary ">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Income</h4>
                </div>
                <div class="card-body">
                $ {{ $ordersStatistic[$selectedMonth]['income'] }}
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-chart">
                <canvas id="sales-chart-1" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary ">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Sales</h4>
                </div>
                <div class="card-body">
                    {{ $ordersStatistic[$selectedMonth]['sales'] }}
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
            <div class="card-header">
                <h4>Income</h4>
            </div>
            <div class="card-body">
                <canvas wire:ignore id="myChart" height="158"></canvas>
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card gradient-bottom" wire:ignore>
            <div class="card-header">
                <h4>Top 5 Products</h4>
                <div class="card-header-action dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <li class="dropdown-title">Select Period</li>
                    <li><a href="#" class="dropdown-item">Today</a></li>
                    <li><a href="#" class="dropdown-item">Week</a></li>
                    <li><a href="#" class="dropdown-item active">Month</a></li>
                    <li><a href="#" class="dropdown-item">This Year</a></li>
                </ul>
                </div>
            </div>
            <div class="card-body" id="top-5-scroll">
                <ul class="list-unstyled list-unstyled-border">
                @foreach ($products as $product)
                {{-- @dd($product->parent->images) --}}
                <li class="media">
                    <img class="mr-3 rounded" width="55" src="{{ $product->parent->images->first()->url }}" alt="product">
                    <div class="media-body">
                    <div class="float-right"><div class="font-weight-600 text-muted text-small">{{ $product->orders_sum_order_productquantity }} Sales</div></div>
                    <div class="media-title">{{ $product->parent->name }}</div>
                    <div class="mt-1">
                        <div class="budget-price">
                            <div class="budget-price-label">Size : {{ $product->size }}</div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="64%"></div>
                            <div class="budget-price-label">${{ $product->orders_sum_order_productquantity * $product->price }}</div>
                        </div>
                    </div>
                    </div>
                </li>
                @endforeach               
                </ul>
            </div>
            <div class="card-footer pt-3 d-flex justify-content-center">
                <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Selling Price</div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
            <div class="card-header">
                <h4>Invoices (5 Latest)</h4>
                <div class="card-header-action">
                <a href="{{ route('back-office.super-admin.order.index') }}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Payment</th>
                        <th>On Work</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td class="font-weight-600">
                            {{ $order->user->name }} <br>
                            {{ $order->user->email }} 
                        </td>
                        <td>
                            @if ($order->is_paid == null)
                                <div class="badge badge-warning">Unpaid</div>
                            @else
                                <div class="badge badge-success">Paid</div>
                            @endif
                        </td>
                        <td>
                            @if ($order->in_process == null)
                                <div class="badge badge-warning">Not Yes</div>
                            @else
                                <div class="badge badge-success">On Process</div>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group dropleft">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $order->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Detail
                                </button>
                                <div class="dropdown-menu dropleft">
                                  <div class="dropdown-title">{{ $order->id ?? 'Unknown' }}</div>
                                  
                                    <form action="{{ route('back-office.super-admin.order.update.total', ['order' => $order])  }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Recalculate
                                        </button>
                                    </form>
    
                                    @if ($order->is_paid == 0)
                                      <form action="{{ route('back-office.super-admin.order.update.paid-payment', ['order' => $order])  }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Paid
                                          </button>
                                      </form>
                                    @else
                                      <form action="{{ route('back-office.super-admin.order.update.unpaid-payment', ['order' => $order])  }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Cancel Paid
                                          </button>
                                      </form>
                                    @endif
    
                                    @if ($order->in_process == 0)
                                      <form action="{{ route('back-office.super-admin.order.update.on-process', ['order' => $order])  }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Process Now
                                          </button>
                                      </form>
                                    @else
                                      <form action="{{ route('back-office.super-admin.order.update.off-process', ['order' => $order])  }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Cancel Process
                                          </button>
                                      </form>
                                    @endif
    
                                    <form action="{{ route('back-office.super-admin.order.update.done', ['order' => $order])  }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                          Done
                                        </button>
                                    </form>
                                    <form action="{{ route('back-office.super-admin.order.update.cancel', ['order' => $order])  }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                            Cancel
                                        </button>
                                    </form>
                                    
                                </div>
                              </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            
            "use strict";
    
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @js(array_reverse($monthLables, false)),
                datasets: [{
                        label: 'Sales',
                        data: @js($sales),
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    // {
                    //     label: 'Budget',
                    //     data: [2207, 3403, 2200, 5025, 2302, 4208, 3880, 4880],
                    //     borderWidth: 2,
                    //     backgroundColor: 'rgba(254,86,83,.7)',
                    //     borderWidth: 0,
                    //     borderColor: 'transparent',
                    //     pointBorderWidth: 0 ,
                    //     pointRadius: 3.5,
                    //     pointBackgroundColor: 'transparent',
                    //     pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    // }
                ]
            },
            options: {
                legend: {
                display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                    // display: false,
                    drawBorder: false,
                    color: '#f2f2f2',
                    },
                    ticks: {
                    beginAtZero: true,
                    stepSize: 150000,
                    callback: function(value, index, values) {
                        return '$' + value;
                    }
                    }
                }],
                xAxes: [{
                    gridLines: {
                    display: false,
                    tickMarkLength: 15,
                    }
                }]
                },
            }
            });
    
            var balance_chart = document.getElementById("balance-chart-1").getContext('2d');
    
            var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
            balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
            balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    
            var myChart = new Chart(balance_chart, {
            type: 'line',
            data: {
                labels: ['16-07-2022', '17-07-2022', '18-07-2022', '19-07-2022', '20-07-2022', '21-07-2022', '22-07-2022', '23-07-2022', '24-07-2022', '25-07-2022', '26-07-2022', '27-07-2022', '28-07-2022', '29-07-2022', '30-07-2022', '31-07-2022'],
                datasets: [{
                label: 'Balance',
                data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
                backgroundColor: balance_chart_bg_color,
                borderWidth: 3,
                borderColor: 'rgba(63,82,227,1)',
                pointBorderWidth: 0,
                pointBorderColor: 'transparent',
                pointRadius: 3,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                padding: {
                    bottom: -1,
                    left: -1
                }
                },
                legend: {
                display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                    display: false,
                    drawBorder: false,
                    },
                    ticks: {
                    beginAtZero: true,
                    display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                    drawBorder: false,
                    display: false,
                    },
                    ticks: {
                    display: false
                    }
                }]
                },
            }
            });
    
            var sales_chart = document.getElementById("sales-chart-1").getContext('2d');
    
            var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
            balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
            balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    
            var myChart = new Chart(sales_chart, {
            type: 'line',
            data: {
                labels: ['16-07-2022', '17-07-2022', '18-07-2022', '19-07-2022', '20-07-2022', '21-07-2022', '22-07-2022', '23-07-2022', '24-07-2022', '25-07-2022', '26-07-2022', '27-07-2022', '28-07-2022', '29-07-2022', '30-07-2022', '31-07-2022'],
                datasets: [{
                label: 'Sales',
                data: [70, 62, 44, 40, 21, 63, 82, 52, 50, 31, 70, 50, 91, 63, 51, 60],
                borderWidth: 2,
                backgroundColor: balance_chart_bg_color,
                borderWidth: 3,
                borderColor: 'rgba(63,82,227,1)',
                pointBorderWidth: 0,
                pointBorderColor: 'transparent',
                pointRadius: 3,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                padding: {
                    bottom: -1,
                    left: -1
                }
                },
                legend: {
                display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                    display: false,
                    drawBorder: false,
                    },
                    ticks: {
                    beginAtZero: true,
                    display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                    drawBorder: false,
                    display: false,
                    },
                    ticks: {
                    display: false
                    }
                }]
                },
            }
            });
    
            $("#products-carousel").owlCarousel({
            items: 3,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 5000,
            loop: true,
            responsive: {
                0: {
                items: 2
                },
                768: {
                items: 2
                },
                1200: {
                items: 3
                }
            }
            });
        })

    </script>

</div>
