<div>
    <form action="{{ route('back-office.super-admin.product.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
          <label>Minimum Order</label>
          <input type="text" class="form-control" name="minimum_order" value="{{ old('minimum_order') }}">
        </div>
        <div class="form-group" wire:ignore>
          <label>Category</label>
          <select class="form-control select2" multiple="" name="category[]" >
            @foreach ($categories as $index => $category)
              <optgroup label="{{ $category->name }}">
                @foreach ($category->subCategories as $subCategory)
                  <optgroup label="{{ $subCategory->name }}">
                      @foreach ($subCategory->subCategories as $sub)
                          <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                      @endforeach
                  </optgroup>
                @endforeach
              </optgroup>
            @endforeach
          </select>
        </div>
        <div class="form-row mb-0 p-0">
            <div class="form-group col-md-3 mb-0 pb-0">
              <label for="size">Size</label>
            </div>
            <div class="form-group col-md-3 mb-0 pb-0">
              <label for="price">Price</label>
            </div>
          </div>
        @foreach ($sizes as $index => $size)
        <div class="form-row">
            <div class="form-group col-md-3">
                <input value="{{ old('size['.$index.']') }}" type="text" name="size[{{ $index }}]" wire:model="sizes.{{ $index }}.size" class="form-control"  placeholder="Size.." >
            </div>
            <div class="form-group col-md-3">
                <input value="{{ old('price['.$index.']') }}" type="number" name="price[{{ $index }}]" wire:model="sizes.{{ $index }}.price" class="form-control" placeholder="Price.." >
            </div>
            <div class="form-group col-md-3">
                <button type="button" wire:click="removeSize({{ $index }})" class="btn btn-danger" >
                    X
                  </button>  
            </div>
        </div>
        @endforeach

        <div class="form-group">
          <button type="button" wire:click="addSize" class="btn btn-secondary" >
            + Add Size
          </button>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">
            Save
          </button>
        </div>
      </form>
      

</div>
