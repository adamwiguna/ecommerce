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
    <h1>Category</h1>
  </div>

  <div class="section-body">
    <h2 class="section-title">Category Page</h2>
    <p class="section-lead">This page showing all categories  </p>
    <div class="card">
      <div class="card-header">
        <h4>List Category</h4>
        <a href="{{ route('back-office.super-admin.category.create') }}" type="button" class="btn btn-sm btn-primary" ><i class="fa fa-plus" ></i> New Category</a>
         </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" >
              <thead>
                <tr>
                  <th>Name</th>
                  <th style="width:  1%">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                    <tr class=" text-bold text-capitalize" >
                        <td>
                          <a class="btn btn-secondary btn-sm" data-toggle="collapse" href="#collapseExample{{ $category->id }}" role="button" aria-expanded="true" aria-controls="collapseExample">
                            <i class="fas fa-folder-open"></i>
                          </a>
                            {{ $category->name }}
                            <div class="collapse multi-collapse" aria-expanded="true" id="collapseExample{{ $category->id }}">
                              <table class="table m-0">
                                {{-- <thead>
                                  <th>Name</th>
                                  <th style="width:  1%">Action</th>
                                </thead> --}}
                                <tbody>
                                  @foreach ($category->subCategories as $subCategory)
                                    <tr >
                                      <td>
                                        <a class="btn btn-secondary btn-sm" data-toggle="collapse" href="#collapseExample{{ $subCategory->id }}" role="button" aria-expanded="true" aria-controls="collapseExample">
                                          <i class="fas fa-folder-open"></i>
                                        </a>
                                        {{ $subCategory->name }} 
                                        <div class="collapse multi-collapse" id="collapseExample{{ $subCategory->id }}">
                                          <table class="table m-0">
                                            {{-- <thead>
                                              <th>Name</th>
                                              <th style="width:  1%">Action</th>
                                            </thead> --}}
                                            <tbody>
                                              @foreach ($subCategory->subCategories as $subSubCategory)
                                                <tr>
                                                  <td>
                                                      {{ $subSubCategory->name }}
                                                  </td>
                                                  <td style="width:  1%">
                                                    <div class="btn-group dropleft">
                                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $subSubCategory->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Detail
                                                      </button>
                                                      <div class="dropdown-menu dropleft">
                                                          <div class="dropdown-title">{{ $subSubCategory->name ?? 'Unknown' }}</div>
                                                          <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.category.edit', ['category' => $subSubCategory]) }}"><i class="fas fa-edit"></i> Edit </a>
                                                          <form action="{{ route('back-office.super-admin.category.destroy', ['category' => $subSubCategory])  }}" method="POST">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.category.destroy', ['category' => $category]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
                                                                  <i class="fas fa-trash mr-2"></i> Delete
                                                              </button>
                                                          </form>
                                                      </div>
                                                    </div>
                                                  </td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                        </div>
                                      </td>                                    
                                      <td style="width:  1%">
                                        <div class="btn-group dropleft">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $subCategory->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Detail
                                          </button>
                                          <div class="dropdown-menu dropleft">
                                              <div class="dropdown-title">{{ $subCategory->name ?? 'Unknown' }}</div>
                                              <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.category.edit', ['category' => $subCategory]) }}"><i class="fas fa-edit"></i> Edit </a>
                                              <form action="{{ route('back-office.super-admin.category.destroy', ['category' => $subCategory])  }}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.category.destroy', ['category' => $category]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
                                                      <i class="fas fa-trash mr-2"></i> Delete
                                                  </button>
                                              </form>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                        </td>
                        
                        <td>
                            <div class="btn-group dropleft">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $category->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Detail
                                </button>
                                <div class="dropdown-menu dropleft">
                                    <div class="dropdown-title">{{ $category->name ?? 'Unknown' }}</div>
                                    <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.category.edit', ['category' => $category]) }}"><i class="fas fa-edit"></i> Edit </a>
                                    <form action="{{ route('back-office.super-admin.category.destroy', ['category' => $category])  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.category.destroy', ['category' => $category]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                      
                  @endforeach
              </tbody>
            </table>
          </div>
      </div>
      <div class="card-footer row">
        {{-- <div class="col-sm-12 col-md-12">
            <div class="dataTables_info">
              Menampilkan total {{ $categories->total() }} data
            </div>
            
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate ">
              {{ $categories->withQueryString()->onEachSide(2)->links() }}
            </div>
          </div> --}}
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