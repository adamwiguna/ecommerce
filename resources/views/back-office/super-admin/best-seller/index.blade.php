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
    <h1>Best Seller - Product</h1>
</div>

<div class="section-body">
<h2 class="section-title">Manage Product Best Seller</h2>
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
      <h4>List Product</h4>
      <a href="{{ route('back-office.super-admin.product.create') }}" type="button" class="btn btn-sm btn-primary" ><i class="fa fa-plus" ></i> New Product</a>
      
    </div>
    <div class="card-body">
       
      <div class="table-responsive">
          <table class="table table-hover table-sm" >
            <thead class=" sticky">
              <tr class="">
                  <th style="width:  1%;"></th>
                  <th style="width:  20%;">Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Minimum Order</th>
                  <th style="width:  15%;">Size</th>
                  <th style="width:  10%;">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products->whereNotNull('is_best_seller') as $product)
               
                  <tr class=" mb-0 pb-0 border-bottom">
                    <td>
                      <a class="btn btn-secondary btn-sm small mb-1" data-toggle="collapse" href="#collapseExample{{ $product->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-folder-open"></i>
                      </a>  
                      <div class="btn-group dropleft">
                        <button class="btn btn-sm btn-dark" type="button" id="dropdownMenuButton{{ $product->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-cogs"></i>
                        </button>
                        <div class="dropdown-menu dropleft">
                            <div class="dropdown-title">{{ $product->name ?? 'Unknown' }}</div>
                            <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.product.manage-image', ['product' => $product]) }}"><i class="fas fa-image"></i> Manage Images </a>
                            <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.product.edit', ['product' => $product]) }}"><i class="fas fa-edit"></i> Edit </a>
                            <form action="{{ route('back-office.super-admin.product.destroy', ['product' => $product])  }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.product.destroy', ['product' => $product]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
                                    <i class="fas fa-trash mr-2"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    </td>
                      <td>
                        @forelse ($product->images as $image)
                            @if ($loop->first)
                         
                              <img src="{{ $image->url }}" alt="" width="100%"> 
                              <hr class="my-1"> 
                            @else
                              <div class="collapse" id="collapseExample{{ $product->id }}">
                                <img src="{{ $image->url }}" alt="" width="100%"> 
                                @if (!$loop->last)
                                  <hr class="my-1">  
                                @endif
                              </div>
                            @endif
                        @empty
                          No Photo
                        @endforelse
                      </td>
                      <td>
                          {{ $product->name }}
                      </td>
                      <td class="pt-0">
                        <ul class="m-0 p-0 ml-3">
                          @forelse ($product->categories as $category)
                          <li>
                            {{ $category->name }}
                          </li>
                          @empty
                            No Category
                          @endforelse
                        </ul>
                      </td>
                      <td>
                        {{ $product->minimum_order??'Not Set' }}
                      </td>
                      <td colspan="2">
                        <table class="table table-sm m-0">
                          @forelse ($product->sizes as $size)
                              <tr>
                                  <td style="width:  60%">
                                    {{ $size->size ?? 'Not Set' }}
                                  </td>
                                  <td style="width:  40%">
                                    $ {{ $size->price ?? 'Not Set' }}
                                  </td>
                              </tr>
                            @empty
                              <tr>
                                  <td style="width:  60%">
                                    {{ $product->size ?? 'Not Set' }}
                                  </td>
                                  <td style="width:  40%">
                                    $ {{ $product->price ?? 'Not Set' }}
                                  </td>
                              </tr>
                            @endforelse
                          </table>
                      </td>
                  </tr>
              
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

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