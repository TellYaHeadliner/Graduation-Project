<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-playstation-circle"></i>
            <span class="ms-2">{{ __('Đăng') }}</span>
        </div>
        <div class="card-body d-flex justify-content-between p-2">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.voucher.delete', $voucher->id) }}" :title="__('Xóa')" />
        </div>
    </div>
       <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-check"></i>{{ __(' Đang áp dụng') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="is_active" value="1" :label="__('Đang áp dụng?')" :checked="$voucher->is_active->value == 1" />
        </div>
    </div>
</div>