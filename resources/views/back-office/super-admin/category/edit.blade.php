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
    <h1>Category</h1>
</div>

<div class="section-body">
<h2 class="section-title">Edit Category - {{ $edit_category->name }}</h2>
<p class="section-lead">This page is just an example for you to create your own page.</p>
<div class="card">
    <div class="card-header">
      <h4>Form Edit</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('back-office.super-admin.category.update', ['category' => $edit_category]) }}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <div class="form-group">
          <label>Parent Category</label>
          <select class="form-control select2" name="category_id">
            <option value="">No Parent</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"  @selected($category->id == $edit_category->category_id)>{{ $category->name }}</option>   
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" value="{{ $edit_category->name }}" required>
        </div>
        <div class="form-group">
          <label>Image</label>
          <input type="file" class="form-control" name="image" accept="image/" id="image">
        </div>
        <div class="form-group">
          <img  id="preview" src="{{ $category->image->url??null }}"  width="100%"  />
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">
            Save
          </button>
        </div>
      </form>
        
    </div>
    <div class="card-footer row">
      
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