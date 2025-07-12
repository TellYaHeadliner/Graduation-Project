@extends('layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.hotel.updateHotelApproval')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$hotel->id" />
                <div class="row justify-content-center">
                    @include('admin.hotel.hotel_approval.forms.edit-left')
                    @include('admin.hotel.hotel_approval.forms.edit-right')
                </div>
            </x-form>
            <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content rounded-3 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold text-danger">
                                <i class="ti ti-alert-circle me-2"></i> {{ __('Bạn có chắc?') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>

                        <div class="modal-body">
                            <p class="mb-3">
                                {{ __('Nếu bạn tiếp tục, khách sạn này sẽ bị từ chối khỏi hệ thống.') }}
                            </p>

                            <x-form id="modalFormDelete" action="#" type="delete">
                                <div class="mb-3">
                                    <label for="reason" class="form-label fw-semibold">
                                        <i class="ti ti-message-dots me-1"></i> {{ __('Lý do từ chối') }}
                                    </label>
                                    <x-input name="reason" id="reason" :value="old('reason')"
                                        placeholder="{{ __('Nhập lý do từ chối') }}" />
                                </div>

                                <div class="d-flex justify-content-end gap-2 pt-2">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        {{ __('Hủy') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="ti ti-ban me-1"></i> {{ __('Từ chối') }}
                                    </button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
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
    @include('admin.hotel.scripts.style')
@endpush