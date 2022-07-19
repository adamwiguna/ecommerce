@extends('back-office.layouts.app')

@push('css-libraries')
  <link rel="stylesheet" href="/node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/node_modules/selectric/public/selectric.css">
  <link rel="stylesheet" href="/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endpush

@section('content')

<div class="section-header">
    <h1>Product</h1>
</div>

<div class="section-body">
<h2 class="section-title">Edit Product </h2>
<p class="section-lead">This page is form to edit Product "{{ $product->name }}".</p>
<div class="card">
    <div class="card-header">
      <h4>Form Edit</h4>
    </div>
    <div class="card-body">
      
        @livewire('product.edit', ['product' => $product])
      
        
    </div>
    <div class="card-footer row">
      
    </div>
</div>
</div>
    
@endsection

@push('js')

<script src="/node_modules/cleave.js/dist/cleave.min.js"></script>
<script src="/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
<script src="/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="/node_modules/select2/dist/js/select2.full.min.js"></script>
<script src="/node_modules/selectric/public/jquery.selectric.min.js"></script>
<script src="/assets/js/page/forms-advanced-forms.js"></script>

@endpush