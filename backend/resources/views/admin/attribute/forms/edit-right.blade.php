<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.attribute.delete', $attribute->id) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-eye"></i>{{ __(' Hiển thị không') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="is_active" value="1" :checked="$attribute->is_active === 1" :label="__('Hiển thị không ?')" />
        </div>
    </div>

</div>