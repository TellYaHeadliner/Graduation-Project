@extends('layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('hotel.room_type.update', Auth()->user()->id)" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$room_type->id" />
                <div class="row justify-content-center">
                    @include('hotel.room_types.forms.edit-left')
                    @include('hotel.room_types.forms.edit-right')
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
    @include('hotel.room_types.scripts.scripts')
@endpush