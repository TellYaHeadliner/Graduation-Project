@extends('layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">{{ __('Danh sách Lớp') }}</h2>
                </div>
                <div class="card-body">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h2 class="mb-0">{{ __('Thông tin Lớp học') }}</h2>
                            </div>
                            <div class="row card-body">    
                                <!-- name -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('Tên Lớp') }}:</label>
                                    </div>
                                </div>
                    
                                <!-- desc -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('Mô tả') }}:</label>
                                        <textarea name="desc" class="ckeditor visually-hidden">{{ old('desc') }}</textarea>
                                    </div>
                                </div>
                    
                                <hr />

                                <div class="col-12 col-md-12">
                                    <div class="mb-3">
                                        {{-- <label class="control-label">{{ __('Hình ảnh') }}:</label> --}}
                                        <x-input-image-ckfinder name="image" showImage="image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
<!-- button in datatable -->
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

@endpush

@push('custom-js')

@include('ckfinder::setup')

@endpush
