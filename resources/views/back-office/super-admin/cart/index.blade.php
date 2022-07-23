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
    <h1>Carts</h1>
  </div>

  <div class="section-body">
    <h2 class="section-title">Carts Page</h2>
    <p class="section-lead">This page showing all Carts  </p>
    <div class="card">
      <div class="card-header">
        <h4>List Cart</h4>
     </div>
      <div class="card-body">
        @foreach ($carts as $usersCarts)
        <h5>
          {{ $usersCarts->name }}
          {{-- {{ $usersCarts[0]->user->name }} --}}
        </h5>
        
        {{ $usersCarts->email }}
        {{-- {{ $usersCarts[0]->user->email }} --}}
        <div class="table-responsive">
            <table class="table table-hover" >
              <thead>
                <tr>
                  <th>Product</th>
                  <th style="width: 10%;">Price</th>
                  <th style="width: 20%;">Size</th>
                  <th style="width: 10%;">Count</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($usersCarts->carts as $cart)
                  <tr>
                      <td >
                          {{ $cart->product->parent->name??$cart->product->name }} <br>
                      </td>
                      <td >
                          $ {{ $cart->product->price??'Price not Set yet' }} <br>
                      </td>
                      <td >
                          {{ $cart->product->size??'One Size' }} <br>
                      </td>
                      <td>
                        {{ $cart->quantity }}
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
        </div>

        <hr>
        <br>
            
        @endforeach
       
      </div>
      <div class="card-footer row">
        {{-- <div class="col-sm-12 col-md-12">
            <div class="dataTables_info">
              Menampilkan total {{ $carts->total() }} data
            </div>
            
          </div> --}}
          <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate ">
              {{ $carts->withQueryString()->onEachSide(2)->links() }}
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