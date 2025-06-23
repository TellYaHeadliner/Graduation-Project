<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-check"></i>{{ __(' Trạng thái') }}</span>
        </div>
        <div class="card-body p-2">
            <select name="role" class="form-select">
                @foreach($RoomStatus as $value => $label)
                    <option value="{{ $value }}" {{ $value == 1 ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>


</div>