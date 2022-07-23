@extends('back-office.layouts.app')

@push('css-libraries')
<link rel="stylesheet" href="/node_modules/jqvmap/dist/jqvmap.min.css">
<link rel="stylesheet" href="/node_modules/summernote/dist/summernote-bs4.css">
<link rel="stylesheet" href="/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
@endpush

@section('content')

@livewire('back-office.dashboard')
        
@endsection

@push('js')
{{-- <script src="/assets/js/page/index.js"></script> --}}
@endpush