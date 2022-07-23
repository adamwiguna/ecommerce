<div>
    <div class="card">
        <div class="card-header">
          <h4>List Unpaid Order</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-hover" >
                <thead class="">
                  <tr>
                    <th style="width:  1%">ID</th>
                    <th>Customer</th>
                    <th style="width:  10%">Payment</th>
                    <th style="width:  10%">On Work</th>
                    <th style="width:  10%">Total Amount</th>
                    <th style="width:  1%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="button" data-toggle="collapse" href="#collapseExample{{ $order->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                      <td>{{ $order->id }}</td>
                      <td>
                          {{ $order->user->name }} <br>
                          {{ $order->user->email }}
                          <div  class="collapse"  id="collapseExample{{ $order->id }}">
                            <table class="table  m-0 ">
                              <thead class=" bg-white bg-primary" >
                                <th class=" text-white" style="height: 30px; width:  70%;">Product</th>
                                <th class=" text-white" style="height: 30px; width:  10%;">Price</th>
                                <th class=" text-white" style="height: 30px; width:  10%;">Quantity</th>
                                <th class=" text-white" style="height: 30px; width:  10%;">Sub Total</th>
                              </thead>
                              <tbody>
                                @foreach ($order->products as $product)
                                  <tr  style="height: 30px;">
                                    <td  style="height: 30px;">
                                      {{ $product->parent->name??$product->name }}
                                    </td>
                                    <td  style="height: 30px;">
                                      {{ $product->price }}
                                    </td>
                                    <td  style="height: 30px;">
                                      {{ $product->pivot->quantity }}
                                    </td>
                                    <td  style="height: 30px;">
                                      {{ $product->pivot->quantity * $product->price}}
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </td>
                        <td>
                          @if ($order->is_paid !== null)
                            <div class="badge badge-success">Paid</div>  
                          @else
                            <div class="badge badge-warning">Unpaid</div>  
                          @endif
                        </td>
                        <td>
                          @if ($order->in_process !== null)
                            <div class="badge badge-success">Working</div>  
                          @else
                            <div class="badge badge-warning">Not Yet</div>  
                          @endif
                        </td>
                        <td>
                          $ {{ $order->total }}
                        </td>
                          
                        <td>
                          <div class="btn-group dropleft">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $order->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Detail
                            </button>
                            <div class="dropdown-menu dropleft">
                              <div class="dropdown-title">{{ $order->id ?? 'Unknown' }}</div>
                              @if (request()->routeIs('back-office.super-admin.order.index'))
                              
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
                                
                              @endif
                                
                              @if (request()->routeIs('back-office.super-admin.order.cancel'))
                                <form action="{{ route('back-office.super-admin.order.uncancel', ['order' => $order])  }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                        UnCancel
                                    </button>
                                </form>
                              @endif
                              
                              @if (request()->routeIs('back-office.super-admin.order.done'))
                                <form action="{{ route('back-office.super-admin.order.undone', ['order' => $order])  }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Are You Sure ?');">
                                        UnDone
                                    </button>
                                </form>
                              @endif

                            </div>
                          </div>
                        </td>
                      
                      </tr>
  
                      <div>
                      </div>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="card-footer row">
          <div class="col-sm-12 col-md-12">
              <div class="dataTables_info">
                Showing {{ $orders->total() }} total data
              </div>
              
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="dataTables_paginate ">
                {{ $orders->withQueryString()->onEachSide(2)->links() }}
              </div>
            </div>
        </div>
      </div>
</div>
