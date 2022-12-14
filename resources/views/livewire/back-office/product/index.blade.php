<div>
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
    <div class="card card-primary">
        <div class="card-header">
          <h4>List Product</h4>
          <div class="card-header-action">
            <a href="{{ route('back-office.super-admin.product.create') }}" type="button" class="btn btn-sm btn-primary" ><i class="fa fa-plus" ></i> New Product</a>
            <label class="selectgroup-item">
              <input wire:model="isBestSeller" type="checkbox"  class="selectgroup-input" >
              <span class="selectgroup-button">Best Seller</span>
            </label>
            <label class="selectgroup-item">
              <input  wire:model="isNewArrival" type="checkbox" class="selectgroup-input button" >
              <span class="selectgroup-button">New Arrival</span>
            </label>
          </div>
          <div class="card-header-form ml-5">
            <div class="input-group">
              <input wire:model.debounce.1000ms="search" type="search" class="form-control form-control-sm " placeholder="Search by Name, Category">
              <div class="input-group-btn">
                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
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
                    @foreach ($products as $product)
                   
                      <tr class=" mb-0 pb-0 border-bottom">
                        <td>
                          {{-- {{ $product->is_best_seller }} --}}
                          <button wire:click="isBestSeller({{ $product }})" class="btn {{ $product->is_best_seller?' btn-outline-warning':' btn-outline-light' }} btn-sm  mb-1"  role="button" >
                            <i class="fas fa-crown"></i>
                          </button>  
                          <button wire:click="isNewArrival({{ $product }})" class="btn {{ $product->is_new_arrival?' btn-outline-danger':' btn-outline-light' }} btn-sm  mb-1"  role="button" >
                            <i class="fas fa-tag"></i>
                          </button>  
                          <a class="btn btn-secondary btn-sm small mb-1" data-toggle="collapse" href="#collapseExample{{ $product->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-folder-open"></i>
                            {{-- See All Image --}}
                          </a>  
                          <div class="btn-group dropleft mb-1">
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
        <div class="card-footer row">
          <div class="col-sm-12 col-md-12">
              <div class="dataTables_info">
                Showing {{ $products->total() }} total data
              </div>
              
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="dataTables_paginate ">
                {{ $products->withQueryString()->onEachSide(2)->links() }}
              </div>
            </div>
        </div>
      </div>
    
</div>
