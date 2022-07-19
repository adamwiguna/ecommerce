@extends('back-office.layouts.app')

@push('css-libraries')
<link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success alert-dismissible show fade alert-has-icon">
    <div class="alert-icon"><i class="fas fa-check"></i></div>
    <div class="alert-body">
        <div class="alert-title">Success</div>
        {{ session('message') }} 
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
    </div>
</div>
@endif

<div class="section-header">
    <h1>Order</h1>
  </div>

  <div class="section-body">
    <h2 class="section-title">Waiting For Payment</h2>
    <p class="section-lead">This page showing all unpaid order </p>
    <div class="card">
      <div class="card-header">
        <h4>List Unpaid Order</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" >
              <thead class="">
                <tr>
                  <th>Customer</th>
                  <th style="width:  13%">Total Amount</th>
                  <th style="width:  1%">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                  <tr class="button" data-toggle="collapse" href="#collapseExample{{ $order->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <td>
                        {{ $order->user->name }} <br>
                        {{ $order->user->email }}
                        <div  class="collapse"  id="collapseExample{{ $order->id }}">
                          {{-- <td colspan="2" class=" pr-0"> --}}
                              <table class="table  m-0 ">
                                <thead class=" bg-white bg-primary" >
                                  <th class=" text-white" style="height: 30px;">Product</th>
                                  <th class=" text-white"  style="height: 30px;">Price</th>
                                  <th class=" text-white"  style="height: 30px;">Quantity</th>
                                  <th class=" text-white"  style="height: 30px;">Sub Total</th>
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
                          {{-- </td> --}}
                        </div>
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
                                    <div class="dropdown-title">{{ $order->name ?? 'Unknown' }}</div>
                                    <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.order.edit', ['order' => $order]) }}"><i class="fas fa-edit"></i> Edit </a>
                                    <form action="{{ route('back-office.super-admin.order.destroy', ['order' => $order])  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.order.destroy', ['order' => $order]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    
                    </tr>

                    <div>
                  
                    {{-- <tr  class="collapse"  id="collapseExample{{ $order->id }}">
                      <td colspan="2" class=" pr-0">
                          <table class="table  m-0 ">
                            <thead class=" bg-white bg-primary" >
                              <th class=" text-white" style="height: 30px;">Product</th>
                              <th class=" text-white"  style="height: 30px;">Price</th>
                              <th class=" text-white"  style="height: 30px;">Quantity</th>
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
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                      </td>
                    </tr> --}}
                    </div>
                  @endforeach
              </tbody>
            </table>
          </div>
      </div>
      <div class="card-footer row">
        <div class="col-sm-12 col-md-12">
            <div class="dataTables_info">
              Menampilkan total {{ $orders->total() }} data
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
    
@endsection

@push('js')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush