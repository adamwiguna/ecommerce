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
    <h1>Slider</h1>
</div>

<div class="section-body">
<h2 class="section-title">Add New Slide</h2>
<p class="section-lead">This page is showing form to add new Slide.</p>
<div class="card">
    <div class="card-header">
      <h4>Form Create</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('back-office.super-admin.slider.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
          <label>Button Name</label>
          <input type="text" class="form-control" name="button_text">
        </div>
        <div class="form-group">
          <label>Button Link</label>
          <input type="text" class="form-control" name="button_url">
        </div>
        <div class="form-group">
          <label>Image</label>
          <input type="file" class="form-control" name="image" accept="image/" id="image">
        </div>
        <div class="form-group">
          <img style="visibility:hidden"  id="preview" src=""  width="100%"  />
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