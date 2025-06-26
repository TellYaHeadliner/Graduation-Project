<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete
                data-route="{{ route('hotel.room_type.delete', ['hotel_id' => Auth()->user()->id, 'id' => $room_type->id]) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-plus"></i>{{ __('Thêm phòng mới') }}</span>
        </div>
        <div class="card-body p-2">
            <x-link :href="route('hotel.room.create', ['hotel_id' => Auth()->user()->id, 'room_type_id' => $room_type->id])" class="btn btn-primary"><i
                    class="ti ti-plus"></i>{{ __('Thêm Phòng') }}</x-link>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-check"></i>{{ __(' Đang hoạt động') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="status" value="1" :checked="$room_type->status->value == 1" :label="__('Đang hoạt động?')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-library-photo"></i>{{ __('Thư viện ảnh') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="gallery" type="multiple" :value="$room_type->gallery" />
        </div>
    </div>


</div>