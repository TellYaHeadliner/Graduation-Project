<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete
                data-route="{{ route('hotel.combo_service.delete', ['hotel_id' => Auth()->user()->id, 'combo_id' => $combo_service->combo_id, 'hotel_service_id' => $combo_service->hotel_service_id]) }}"
                :title="__('Xóa')" />
        </div>
    </div>


</div>