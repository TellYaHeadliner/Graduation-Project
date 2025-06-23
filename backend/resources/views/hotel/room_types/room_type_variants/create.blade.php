@extends('layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('hotel.room_type_variant.store',['hotel_id'=>Auth()->user()->id,'room_type_id'=>$room_type->id])" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('hotel.room_types.room_type_variants.forms.create-left')
                    @include('hotel.room_types.room_type_variants.forms.create-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    @include('ckfinder::setup')
    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/ckeditor/adapters/jquery.js') }}"></script>
@endpush

@push('custom-js')
    @include('hotel.room_types.room_type_variants.scripts.scripts')
@endpush