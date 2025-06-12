<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.season.delete', $season->id) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-toggle"></i>{{ __(' Đang áp dụng') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="status" value="1" checked="{{ $season->status == 1 }}" :label="__('Đang áp dụng ?')" />
        </div>
    </div>

</div>