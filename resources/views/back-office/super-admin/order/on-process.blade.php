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
    
    @livewire('back-office.order.index')

  </div>
    
@endsection

@push('js')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush