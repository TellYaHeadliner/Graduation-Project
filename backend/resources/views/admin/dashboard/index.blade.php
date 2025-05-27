@extends('layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
       
    </div>
@endsection

@push('libs-js')
<!-- button in datatable -->
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

@endpush

@push('custom-js')

@include('ckfinder::setup')

@endpush
