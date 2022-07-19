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
<h2 class="section-title">Manage Image for Product {{ $product->name }}</h2>
<p class="section-lead">This page is just an example for you to create your own page.</p>
@if (session()->has('success-message'))
        <div class="alert alert-success alert-dismissible show fade alert-has-icon">
            <div class="alert-icon"><i class="fas fa-check"></i></div>
            <div class="alert-body">
                <div class="alert-title">Success</div>
                {{ session('success-message') }} 
                <button class="close" data-dismiss="alert">
                <span>&times;</span>
                </button>
            </div>
        </div>
    @endif
<div class="card">
    <div class="card-header">
      <h4>Form Add</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('back-office.super-admin.product.store-image', ['product' => $product]) }}" method="POST" enctype="multipart/form-data" >
            @csrf
                <div class=" form-row">
                    <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" accept="image/" id="image">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            Add
                        </button>
                        <a class="btn btn-primary" href="{{ route('back-office.super-admin.product.index') }}">
                            Finish | Back to Product List
                        </a>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div style="aspect-ratio: 4/3; overflow:hidden;  background: rgb(41, 41, 41); ">
                        <img style="visibility:hidden; height:100%; object-fit: contain ; object-position: center;"  id="preview" src=""  width="100%"  />
                    </div>
                </div>
            </div>
      </form>
        
    </div>
    <div class="card-footer row">
      
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>{{ $product->name }} - Images</h4>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($product->images as $image)
                <div class="col col-lg-3 col-md-6 col-12 mb-3">
                    <div class="shadow-sm ">
                        <div class="carousel-item active " style="aspect-ratio: 4/3; overflow:hidden;  background: rgb(41, 41, 41); ">
                            <img src="{{ $image->url }}" class="d-block w-100" alt="" style="height:100%; object-fit: contain ; object-position: center;;">
                        </div>
                        <div class="card-body p-0">
                            <div class="d-flex  align-items-end justify-content-end p-0">
                                <div class="input-group  justify-content-end p-1">
                                    <form action="{{ route('back-office.super-admin.product.delete-image', ['image' => $image]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
      <div class=" row row-cols-2  row-cols-sm-2 row-cols-md-4 g-3 overflow-auto d-flex">
      {{-- <div class="row"> --}}
        {{-- <div class="col-12 col-md-6 col-lg-4"> --}}
            {{-- @foreach ($product->images as $image)
            <div class="col">
                <div class="shadow-sm ">
                    <div class="carousel-item active " style="aspect-ratio: 4/3; overflow:hidden;  background: rgb(41, 41, 41); ">
                        <img src="{{ $image->url }}" class="d-block w-100" alt="" style="height:100%; object-fit: contain ; object-position: center;;">
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex  align-items-end justify-content-end p-0">
                            <div class="input-group  justify-content-end p-1">
                                <form action="{{ route('back-office.super-admin.product.delete-image', ['image' => $image]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach --}}
        {{-- </div> --}}
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
 image.onchange = evt => {
  const [file] = image.files
  if (file) {
    preview.style.visibility = 'visible';

    preview.src = URL.createObjectURL(file)
  }
}
</script>
    
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