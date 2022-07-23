@extends('back-office.layouts.app')

@push('css-libraries')
<link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')

<div class="section-header">
    <h1>Sliders</h1>
  </div>
  <div class="section-body">
    <h2 class="section-title">Sliders Page</h2>
    <p class="section-lead">This page showing all Sliders  </p>
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
        <h4>List Image Slider</h4>
        <a href="{{ route('back-office.super-admin.slider.create') }}" type="button" class="btn btn-sm btn-primary" ><i class="fa fa-plus" ></i> New Slide</a>   
    </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" >
              <thead>
                <tr>
                  <th style="width:  40%">Image</th>
                  <th>Name</th>
                  <th>Button</th>
                  <th style="width:  1%">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($sliders as $slider)
                    <tr>
                        <td>
                            {{-- @dd($slider->image()) --}}
                            <img class="m-1" src="{{ $slider->image->url }}" alt="" width="100%"> <br>
                        </td>
                        <td>
                            {{ $slider->name??'' }} <br>
                            {{ $slider->description??'' }}
                        </td>
                        <td>
                            <button class=" btn btn-outline-primary">{{ $slider->button_text??'No Text Yet' }}</button><br>
                            {{ $slider->button_url }}
                        </td>
                        <td>
                            <div class="btn-group dropleft">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $slider->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Detail
                                </button>
                                <div class="dropdown-menu dropleft">
                                    <div class="dropdown-title">{{ $slider->title ?? 'Unknown' }}</div>
                                    <a class="dropdown-item has-icon" href="{{ route('back-office.super-admin.slider.edit', ['slider' => $slider]) }}"><i class="fas fa-edit"></i> Edit </a>
                                    <form action="{{ route('back-office.super-admin.slider.destroy', ['slider' => $slider])  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item btn-sm" href="{{ route('back-office.super-admin.slider.destroy', ['slider' => $slider]) }}" onclick="return confirm('Anda yakin ingin menghapus ini?');">
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
              Menampilkan total {{ $carts->total() }} data
            </div>
            
          </div> --}}
          {{-- <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate ">
              {{ $sliders->withQueryString()->onEachSide(2)->links() }}
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