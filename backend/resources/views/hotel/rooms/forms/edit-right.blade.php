<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('hotel.room.delete', ['hotel_id' => Auth()->user()->id,'id'=>$room->id,'room_type_id'=>$room->room_type_id]) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-check"></i>{{ __(' Trạng thái') }}</span>
        </div>
        <div class="card-body p-2">
            <select name="status" class="form-select">
                @foreach($RoomStatus as $value => $label)
                    <option value="{{ $value }}" {{ $value == $room->status->value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>


</div>