<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-check"></i>{{ __(' Trạng thái') }}</span>
        </div>
        <div class="card-body p-2">
            <select name="status" class="form-select">
                @foreach($BookingStatus as $value => $label)
                    @if($label === "Đã hoàn tiền")
                        @continue
                    @endif
                    <option value="{{ $value }}" {{ $value == $booking->status->value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>