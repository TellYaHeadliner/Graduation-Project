@extends('layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
    @include('hotel.amenity.scripts.style')
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('hotel.amenity.update',['hotel_id'=>Auth()->user()->id])" type="put" :validate="true">
                <x-input type="hidden" name="id" :value=" Auth()->user()->id " />
                <div class="row justify-content-center">
                    @include('hotel.amenity.forms.edit-left')
                    @include('hotel.amenity.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    <!-- ckfinder js -->
    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/ckeditor/adapters/jquery.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@push('custom-js')
   
@endpush